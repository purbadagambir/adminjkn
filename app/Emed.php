<?php

use phpDocumentor\Reflection\Types\Array_;

class Emed
{
    private $dbh;

    private $option = [
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    function __construct()
    {
        $tns = '(DESCRIPTION =
                 (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.8.3)(PORT = 1521))
                     (CONNECT_DATA =
                         (SERVER = DEDICATED)
                         (SERVICE_NAME = xePDB1)
                     ))';

        $option = [
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->dbh = new PDO('oci:dbname=' . $tns, 'BUNDA', 'ORACLE', $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getPatienDataRm($opt, $data)
    {
        if ($opt == 1) {
            $sql = "Select contact_no,rm_no,name,sex,dob,nik,social_no 
                    from patients 
                    where rm_no like ?";
        } elseif ($opt == 2) {
            $sql = "Select contact_no,rm_no,name,sex,dob,nik,social_no 
                    from patients 
                    where upper(name) like ?";
        } else {
            $metadata['code'] = 201;
            $metadata['message'] = 'Opsi pencarian kosong';
            echo json_encode(array('metadata' => $metadata));
            return;
        }
        $data_param = '%' . strtoupper($data) . '%';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindparam(1, $data_param);
        $stmt->execute();

        $row = $stmt->fetchAll();

        if (count($row) > 0) {
            $metadata['code'] = 200;
            $metadata['message'] = 'Ok';
            $result = array(
                'metadata' => $metadata,
                'list' => $row
            );
        } else {
            $metadata['code'] = 201;
            $metadata['message'] = 'No Data Found';
            $result = array(
                'metadata' => $metadata
            );
        }
        return json_encode($result);
    }

    public function quesData()
    {
        $stmt = $this->dbh->query('SELECT COUNT(1) as jumlah FROM CASE_ORDERS
                                    WHERE STATUS_NO IN(2,3,4) AND
                                    TRUNC(ORDER_DATE) = TRUNC(SYSDATE)')->fetch();

        $metadata['code'] = 200;
        $metadata['message'] = 'Ok';
        $result = array(
            'metadata' => $metadata,
            'list' => $stmt
        );
        return json_encode($result);
    }

    public function admissionData()
    {
        $stmt = $this->dbh->query('SELECT COUNT(1) as jumlah FROM CASE_ORDERS
                                    WHERE STATUS_NO IN(5)')->fetch();

        $metadata['code'] = 200;
        $metadata['message'] = 'Ok';
        $result = array(
            'metadata' => $metadata,
            'list' => $stmt
        );
        return json_encode($result);
    }

    public function appoinmentData()
    {
        $stmt = $this->dbh->query('SELECT COUNT(1) as JUMLAH 
                                    FROM APPOINTMENTS
                                    WHERE TRUNC(APPOINTMENT_DATE) = TRUNC(SYSDATE)')->fetch();

        $metadata['code'] = 200;
        $metadata['message'] = 'Ok';
        $result = array(
            'metadata' => $metadata,
            'list' => $stmt
        );
        return json_encode($result);
    }

    public function selectAppointment()
    {
        $stmt = $this->dbh->query("SELECT A.KODE_BOOKING,A.APPOINTMENT_DATE,A.SOCIAL_NO,B.RM_NO,B.NAME AS PASIEN, JADWAL, REGISTERED,C.NAME AS DPJP,
                                            ESTIMASI_DILAYANI,NOTE,SEQUENCE_NO,D.INISIAL_ANTRIAN||A.SEQUENCE_NO AS NO_ANTREAN,NO_REFERENSI,REGISTERED
                                    FROM APPOINTMENTS A, V_PATIENTS B, DOCTORS C, BPJS_DPJP D
                                    WHERE A.SOCIAL_NO=B.SOCIAL_NO(+) AND
                                        A.DOCTOR_NO=C.CONTACT_NO AND
                                        C.CONTACT_NO=D.CONTACT_NO AND
                                        REGISTERED='N' AND
                                        TRUNC(A.APPOINTMENT_DATE) BETWEEN TRUNC(SYSDATE) AND TRUNC(SYSDATE+2)
                                    ORDER BY ESTIMASI_DILAYANI");

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($row) > 0) {
            $metadata['code'] = 200;
            $metadata['message'] = 'Ok';
            $result = array(
                'metadata' => $metadata,
                'response' => $row
            );
        } else {
            $metadata['code'] = 201;
            $metadata['message'] = 'No data Found';
            $result = array(
                'metadata' => $metadata,
                'response' => 'No Data found'
            );
        }
        return json_encode($result);
    }

    public function doctorData()
    {
        $stmt = $this->dbh->query('SELECT contact_no,name
                                    FROM DOCTORS
                                    ORDER BY NAME')->fetchAll();

        $metadata['code'] = 200;
        $metadata['message'] = 'Ok';
        $result = array(
            'metadata' => $metadata,
            'list' => $stmt
        );
        return json_encode($result);
    }

    public function insertBPJS_DPJP($param)
    {
        $data = json_decode($param);

        $sql = "SELECT COUNT(1) AS JML FROM BPJS_DPJP WHERE KODE_DPJP=:KODE_DPJP";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':KODE_DPJP', $data->response->kodedokter);
        $stmt->execute();
        $row = $stmt->fetch();

        if ($row['JML'] == 0) {
            $sql = "INSERT INTO BPJS_DPJP (KODE_DPJP, NAMA_DPJP, CONTACT_NO, NAMA_RUANGAN, INISIAL_ANTRIAN) 
                    VALUES (?,?,?,?,?) ";
            try {
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindparam(1, $data->response->kodedokter);
                $stmt->bindparam(2, $data->response->namadokter);
                $stmt->bindparam(3, $data->response->doctor_no);
                $stmt->bindparam(4, $data->response->namaruangan);
                $stmt->bindparam(5, $data->response->inisialantrian);
                $stmt->execute();
                $metadata['code'] = 200;
                $metadata['message'] = 'Insert To E-Med Success ';
                $result = array(
                    'metadata' => $metadata
                );
                $response = json_encode($result);
            } catch (\Throwable $th) {
                $metadata['code'] = 201;
                $metadata['message'] =  $th->getMessage();
                $result = array(
                    'metadata' => $metadata,
                );
                $response = json_encode($result);
            }
        } elseif ($row['JML'] == 1) {
            $sql = "UPDATE BPJS_DPJP 
                    SET  NAMA_DPJP=:NAMA_DPJP,
                         CONTACT_NO=:CONTACT_NO, 
                         NAMA_RUANGAN=:NAMA_RUANGAN,
                         INISIAL_ANTRIAN=:INISIAL_ANTRIAN 
                    WHERE KODE_DPJP=:KODE_DPJP";
            try {
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindparam(':KODE_DPJP', $data->response->kodedokter, PDO::PARAM_INT);
                $stmt->bindparam(':NAMA_DPJP', $data->response->namadokter, PDO::PARAM_STR);
                $stmt->bindparam(':CONTACT_NO', $data->response->doctor_no, PDO::PARAM_STR);
                $stmt->bindparam(':NAMA_RUANGAN', $data->response->namaruangan, PDO::PARAM_STR);
                $stmt->bindparam(':INISIAL_ANTRIAN', $data->response->inisialantrian, PDO::PARAM_STR);
                $stmt->execute();
                $metadata['code'] = 200;
                $metadata['message'] = 'Update E-Med Data Success ';
                $result = array(
                    'metadata' => $metadata
                );
                $response = json_encode($result);
            } catch (\Throwable $th) {
                $metadata['code'] = 201;
                $metadata['message'] = $param . '-' . $th->getMessage();
                $result = array(
                    'metadata' => $metadata,
                );
                $response = json_encode($result);
            }
        }
        return $response;
    }

    public function insertBPJS_DPJP_SCHEDULES($param)
    {
        $data = $param;
        $i = 0;
        $tanggal = strtotime(date('d-m-Y'));
        $delete = 'N';

        foreach ($data->response as $value) :
            # Delete Jadwal By Poli;
            $i++;
            if ($delete == 'N') {
                $sqlDelete = "DELETE BPJS_DPJP_SCHEDULES WHERE KODE_POLI = ? ";
                $stmt = $this->dbh->prepare($sqlDelete);
                $stmt->execute(array($value->kodepoli));
                if ($stmt) {
                    $delete = 'Y';
                }
            }

            $sql_ins = "INSERT INTO BPJS_DPJP_SCHEDULES (KODE_DOKTER, NAMADOKTER, KODE_POLI, NAMAPOLI, HARI, JADWAL, JAMBUKA, JAMTUTUP, NAMAHARI,
                                    KAPASITASPASIEN, KAPASITASPASIENJKN, KAPASITASPASIENNONJKN, CREATEDATE, LASTUPDATE)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
            try {
                $stmt = $this->dbh->prepare($sql_ins);
                $stmt->bindparam(1, $value->kodedokter);
                $stmt->bindparam(2, $value->namadokter);
                $stmt->bindparam(3, $value->kodepoli);
                $stmt->bindparam(4, $value->namapoli);
                $stmt->bindparam(5, $value->hari);
                $stmt->bindparam(6, $value->jadwal);
                $stmt->bindparam(7, $value->jambuka);
                $stmt->bindparam(8, $value->jamtutup);
                $stmt->bindparam(9, $value->namahari);
                $stmt->bindparam(10, $value->kapasitaspasien);
                $stmt->bindparam(11, $value->kapasitaspasienjkn);
                $stmt->bindparam(12, $value->kapasitaspasiennonjkn);
                $stmt->bindparam(13, $tanggal);
                $stmt->bindparam(14, $tanggal);
                $stmt->execute();

                $metadata['code'] = 200;
                $metadata['message'] = 'Insert Jadwal Dokter To E-Med Success';
            } catch (\Throwable $th) {
                $metadata['code'] = 201;
                $metadata['message'] = $value->kodedokter . '-' .  $th->getMessage();
            }
        endforeach;
        $reponse['count'] = count($data->response);
        $reponse['inserted'] = $i;
        return json_encode(array('metadata' => $metadata, 'response' => $reponse));
    }

    public function deleteJadwal($dpjp, $jadwal)
    {
        $sql = " DELETE BPJS_DPJP_SCHEDULES 
                        WHERE KODE_DOKTER=? AND 
                              JADWAL=?";
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array($dpjp, $jadwal));

            $metadata['code'] = 200;
            $metadata['message'] =  'Delete Sukses';
            $result = array(
                'metadata' => $metadata,
            );
            $response = json_encode($result);
        } catch (\Throwable $th) {
            $metadata['code'] = 201;
            $metadata['message'] = 'Kode DPJP : ' . $dpjp . '-' . $th->getMessage();
            $result = array(
                'metadata' => $metadata,
            );
            $response = json_encode($result);
        }
        return $response;
    }

    public function insertAppointment($param)
    {
        $data = json_decode($param);
        $response = '';
        $i = 0;

        if ($data->metadata->code == 200) {
            if ($data->response != null) {
                foreach ($data->response as $appt) :
                    $i++;
                    $sql = "SELECT COUNT(1) AS JML FROM APPOINTMENTS WHERE KODE_BOOKING=:KODE_BOOKING";
                    $stmt = $this->dbh->prepare($sql);
                    $stmt->bindParam(':KODE_BOOKING', $appt->kodebooking, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();

                    if ($row['JML'] == 0) {
                        $sql_dokter = "SELECT CONTACT_NO FROM BPJS_DPJP WHERE KODE_DPJP=:KODE_DPJP";
                        $stmt_dokter = $this->dbh->prepare($sql_dokter);
                        $stmt_dokter->bindValue(':KODE_DPJP', $appt->kodedokter, PDO::PARAM_STR);
                        $stmt_dokter->execute();
                        $row_dokter = $stmt_dokter->fetch();

                        $sql_patient = "SELECT CONTACT_NO FROM PATIENTS WHERE RM_NO=?";
                        $stmt_patient = $this->dbh->prepare($sql_patient);
                        $stmt_patient->execute(array($appt->nopeserta));
                        $row_patient = $stmt->fetch();

                        // $sql = "INSERT INTO APPOINTMENTS (APPOINMENT_NO, APPOINTMENT_DATE, DOCTOR_NO, SEQUENCE_NO, KODE_BOOKING, JADWAL, ESTIMASI_DILAYANI,PATIENT_NO,SOCIAL_NO, NOTE) 
                        //         VALUES (:APPOINMENT_NO,:APPOINTMENT_DATE,:DOCTOR_NO,:SEQUENCE_NO,:KODE_BOOKING,:JADWAL,:ESTIMASI_DILAYANI,:PATIENT_NO,:SOCIAL_NO,:NOTE) ";

                        $sql = "INSERT INTO APPOINTMENTS (APPOINMENT_NO, APPOINTMENT_DATE, DOCTOR_NO, SEQUENCE_NO, KODE_BOOKING, JADWAL, ESTIMASI_DILAYANI,PATIENT_NO,SOCIAL_NO, NOTE, TIPE_BOOKING) 
                                 VALUES (?,TO_DATE(?,'dd-mm-yyyy hh24:mi:ss'),?,?,?,?,?,?,?,?,?) ";
                        try {
                            $tanggalperiksa = date('d-m-Y', $appt->tanggalperiksa);
                            $stmt = $this->dbh->prepare($sql);
                            $stmt->execute(array($appt->kodebooking, $tanggalperiksa, $row_dokter['CONTACT_NO'], $appt->angkaantrean, $appt->kodebooking, $appt->jampraktek, $appt->estimasidilayani, $row_patient['CONTACT_NO'], $appt->nopeserta, $appt->nomorreferensi, $appt->tipe_booking));
                        } catch (\Throwable $th) {
                            $metadata['code'] = 201;
                            $metadata['message'] = 'Kode Booking : ' . $appt->kodebooking . $th->getMessage();
                            $result = array(
                                'metadata' => $metadata,
                            );
                            $response = json_encode($result);
                            return $response;
                        }
                    } elseif ($row['JML'] == 1) {
                        if ($appt->state == 0) {
                            $sql = "DELETE APPOINTMENTS WHERE KODE_BOOKING=:KODE_BOOKING";
                            try {
                                $stmt = $this->dbh->prepare($sql);
                                $stmt->bindparam(':KODE_BOOKING', $appt->kodebooking, PDO::PARAM_STR);
                                $stmt->execute();
                            } catch (\Throwable $th) {
                                $metadata['code'] = 201;
                                $metadata['message'] = $param . '-' . $th->getMessage();
                                $result = array(
                                    'metadata' => $metadata,
                                );
                                $response = json_encode($result);
                                return $response;
                            }
                        }
                    }
                endforeach;
            }
            $metadata['code'] = 200;
            $metadata['message'] = $i . ' Data Inserted to E-Med';
            $result = array(
                'metadata' => $metadata,
            );
            $response = json_encode($result);
        } else {
            $metadata['code'] = 201;
            $metadata['message'] = 'No Data found';
            $result = array(
                'metadata' => $metadata,
            );
            $response = json_encode($result);
        }
        return $response;
    }

    public function deleteAppointment($param)
    {
        $data = json_decode($param);

        $sql = "DELETE APPOINTMENTS WHERE KODE_BOOKING=:KODE_BOOKING";
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindparam(':KODE_BOOKING', $data->kodebooking, PDO::PARAM_STR);
            $stmt->execute();

            $metadata['code'] = 200;
            $metadata['message'] =  'OK';
            $result = array(
                'metadata' => $metadata,
            );
            $response = json_encode($result);
        } catch (\Throwable $th) {
            $metadata['code'] = 201;
            $metadata['message'] = $param . '-' . $th->getMessage();
            $result = array(
                'metadata' => $metadata,
            );
            $response = json_encode($result);
        }
        return $response;
    }

    public function patientInfo()
    {
        $stmt = $this->dbh->query('SELECT X.NAME,JUMLAH
                                   FROM DOCTORS X, (SELECT ADMIT_DOCTOR_NO,COUNT(1) AS JUMLAH
                                                        FROM CASE_ORDERS
                                                        WHERE STATUS_NO IN(2,3,4) AND
                                                              TRUNC(ORDER_DATE)=TRUNC(SYSDATE)
                                                        GROUP BY  ADMIT_DOCTOR_NO) Y
                                    WHERE X.CONTACT_NO=Y. ADMIT_DOCTOR_NO')->fetchAll();

        $metadata['code'] = 200;
        $metadata['message'] = 'Ok';
        $result = array(
            'metadata' => $metadata,
            'list' => $stmt
        );

        return json_encode($result);
    }

    public function TaskData()
    {
        $sql = "SELECT KODE_BOOKING,NO_ANTREAN,INISIAL_ANTREAN,TO_CHAR(START_DATE,'DD-MM-YYYY HH24:MI:SS') AS START_DATE,
                TO_CHAR(END_DATE,'DD-MM-YYYY HH24:MI:SS') AS END_DATE,SEND_TO_JKN,B.NAME, RESPONSE_MESSAGE
                        FROM ANTREAN A, TASKS B
                        WHERE A.TASK_ID=B.TASK_ID AND
                            TRUNC(A.START_DATE) = TRUNC(SYSDATE) 
                        ORDER BY START_DATE";
        $stmt = $this->dbh->query($sql)->fetchAll();

        $metadata['code'] = 200;
        $metadata['message'] = 'Ok';
        $data['list'] = $stmt;
        $result = array(
            'metadata' => $metadata,
            'response' => $data
        );
        return json_encode($result);
    }

    public function TaskTime()
    {
        $taskid = $this->input->post('task_id');

        $sql = 'SELECT A.TASK_ID,B.NAME,KODE_BOOKING,ORDER_NO,DOCTOR_NO,START_DATE,END_DATE
                FROM ANTREAN A, TASKS B
                WHERE A.TASK_ID=:TASK_ID AND
                    A.TASK_ID=B.TASK_ID';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':TASK_ID', $taskid, PDO::PARAM_STR);
        $stmt->fetchAll();

        $metadata['code'] = 200;
        $metadata['message'] = 'Ok';
        $data['list'] = $stmt;
        $result = array(
            'metadata' => $metadata,
            'response' => $data
        );
        return json_encode($result);
    }

    public function selectPatient($nokartu = '')
    {
        $sql = "SELECT COUNT(1) as jml FROM PATIENTS
                WHERE SOCIAL_NO=:SOCIAL_NO";

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':SOCIAL_NO', $nokartu, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row;
    }

    public function insertPatient($data = null)
    {
        $value = json_decode($data);

        try {
            $contactno = $this->dbh->query('SELECT SEQ_CONTACT_NO.NEXTVAL AS CONTACTNO FROM DUAL')->fetch();

            $insert_contact = "INSERT INTO CONTACTS (CONTACT_NO,NAME,ADDRESS1,PHONE_MOBILE1,ASPATIENT) VALUES
                            (?,?,?,?,'Y')";
            $stmt = $this->dbh->prepare($insert_contact);
            $stmt->bindValue(1, $contactno['CONTACTNO']);
            $stmt->bindValue(2, $value->nama);
            $stmt->bindValue(3, $value->alamat);
            $stmt->bindValue(4, $value->nohp);
            $stmt->execute();

            $insert_patient = "INSERT INTO PATIENTS (CONTACT_NO,NAME,RM_NO,SOCIAL_NO,REGISTERED_DATE,DOB,SEX,NIK) VALUES
        (?,?,?,?,SYSDATE,?,?,?)";
            $stmt = $this->dbh->prepare($insert_patient);
            $stmt->bindValue(1, $contactno['CONTACTNO']);
            $stmt->bindValue(2, $value->nama);
            $stmt->bindValue(3, $value->norm);
            $stmt->bindValue(4, $value->nomorkartu);
            $stmt->bindValue(5, $value->tanggallahir);
            $stmt->bindValue(6, $value->jeniskelamin);
            $stmt->bindValue(7, $value->nik);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function selectPatientJKN($data = null)
    {
        $periode = json_decode($data);
        $awal = date('d-m-Y', strtotime($periode->awal));
        $akhir = date('d-m-Y', strtotime($periode->akhir));

        $stmt = $this->dbh->prepare("SELECT A.*,TO_CHAR(C.ORDER_DATE,'dd-mm-yy hh24:mi:ss') AS JAM_MASUK, TO_CHAR(B.END_DATE,'dd-mm-yy hh24:mi:ss') AS JAM_PULANG,  
									D.*, E.NAME AS DPJP, ROUND((B.END_DATE - C.ORDER_DATE) * (24*60)) AS SELISIH
									FROM APPOINTMENTS A, ANTREAN B, CASE_ORDERS C, V_PATIENTS D, DOCTORS E
									WHERE A.APPOINMENT_NO=B.KODE_BOOKING AND
										  B.ORDER_NO=C.ORDER_NO AND
										  B.TASK_ID=5 AND
										  TRUNC(APPOINTMENT_DATE) BETWEEN TO_DATE(:TGL1,'DD-MM-YYYY') AND TO_DATE(:TGL2,'DD-MM-YYYY') AND
										  A.TIPE_BOOKING='JKN' AND
										  C.PATIENT_NO=D.CONTACT_NO AND
										  A.DOCTOR_NO=E.CONTACT_NO
                                    ORDER BY C.ORDER_DATE");

        $stmt->bindParam(':TGL1', $awal, PDO::PARAM_STR);
        $stmt->bindParam(':TGL2', $akhir, PDO::PARAM_STR);
        try {
            $stmt->execute();
            $row = $stmt->fetchAll();
            if (count($row) > 0) {
                $metadata['code'] = 200;
                $metadata['message'] = 'Ok';
                $result = array(
                    'metadata' => $metadata,
                    'response' => $row
                );
            } else {
                $metadata['code'] = 201;
                $metadata['message'] = 'No data found';
                $result = array(
                    'metadata' => $metadata,
                    'response' => count($row) . ' No data found'
                );
            }
            return json_encode($result);
        } catch (\Throwable $th) {
            $metadata['code'] = 500;
            $metadata['message'] = 'Error';
            $result = array(
                'metadata' => $metadata,
                'response' => 'Error : ' . $th
            );
            return json_encode($result);
        }
    }


    public function SelectKontrol()
    {
        $stmt = $this->dbh->query("SELECT A.*,TELP
                                    FROM BPJS_SURAT_KONTROL A, BPJS_PESERTA C
                                    WHERE A.NO_KARTU=C.NO_KARTU(+) AND
                                          A.TGL_RENCANA_KONTROL > SYSDATE
                                    ORDER BY A.TGL_RENCANA_KONTROL, NAMA_DOKTER");

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($row) > 0) {
            $metadata['code'] = 200;
            $metadata['message'] = 'Ok';
            $result = array(
                'metadata' => $metadata,
                'response' => $row
            );
        } else {
            $metadata['code'] = 201;
            $metadata['message'] = 'No data Found';
            $result = array(
                'metadata' => $metadata,
                'response' => 'No Data found'
            );
        }
        return json_encode($result);
    }

    public function InsertWaMessage($data = null)
    {
        $value = json_decode($data);

        try {

            $insert_contact = "INSERT INTO WA_MESSAGE_HISTORIES (MESSAGE_ID, REFERENCE_ID, WA_ID, MESSAGE_BODY, SEND_DATE, SEND_STATUS, MESSAGE_STATUS) VALUES
                            (?,?,?,?,?,?,?)";
            $stmt = $this->dbh->prepare($insert_contact);
            $stmt->bindValue(1, '-1');
            $stmt->bindValue(2, $value->reference_id);
            $stmt->bindValue(3, $value->wa_id);
            $stmt->bindValue(4, $value->message_body);
            $stmt->bindValue(5, $value->send_date);
            $stmt->bindValue(6, $value->send_status);
            $stmt->bindValue(7, $value->message_status);
            $stmt->execute();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
