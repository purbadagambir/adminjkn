<?php

use phpDocumentor\Reflection\Types\This;

class Antrean extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        cekLogin();
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('antrean/topbar');
        $this->load->view('antrean/v_client');
    }

    public function insert()
    {
        $request = file_get_contents("php://input");
        $data = json_decode($request);

        try {
            $host = ANTREAN_WS . 'antrean/add';
            $response = $this->connectBPJS('post', $host, '', $data);
            $receive = json_decode($response);
            if (($receive->metadata->code) == 200) {
                var_dump($receive);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $receive->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>'
                );
            }
        } catch (\Throwable $th) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $th->getMessage() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>'
            );
        }
    }

    public function delete()
    {
        $request = file_get_contents("php://input");

        $kodebooking = $this->input->post('kodebooking');
        $keterangan = $this->input->post('keterangan');
        $data = json_decode($request);


        if (!strlen($kodebooking) == 12) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Fail ! </strong> Kode Booking harus 12 Digit <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>'
            );
            return;
        }

        if (strlen($keterangan) < 3) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Fail ! </strong> KAlasan pembatalan harus dimasukkan minimal 3 karakter! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>'
            );
            return;
        }

        // Note : state 0 = BATAL ANTRIAN
        $batal['state'] = 0;
        $batal['note'] = $keterangan;
        $batal['kodebooking'] = $kodebooking;
        $batal['username'] = $this->session->userdata('id');


        try {
            $host = ANTREAN_WS . 'antrean/batal';
            $response = $this->connectBPJS('POST', $host, '', json_encode($batal));
            $data = json_decode($response);

            if ($data->metadata->code == 200) {
                //$this->db->update('appointments', $batal, $where);
                $response = $this->loadService(JKN_WS . 'antrean/batal', 'POST', $this->requestHeader(), json_encode($batal));
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses ! </strong> Kode Booking Antrean : ' . $kodebooking . ' berhasil di batalkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>'
                );
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Fail ! </strong> KAlasan pembatalan harus dimasukkan minimal 3 karakter! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>'
                );
            }
        } catch (\Throwable $th) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Fail ! </strong> ' . $th->getMessage() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>'
            );
        }
        redirect('appointment');
    }

    public function updateTaskBPJS()
    {
        $data['kodebooking'] = $this->input->post('kodebooking');
        $data['taskid'] = $this->input->post('taskid');
        $data['waktu'] = $this->input->post('waktu');

        $postdata = json_encode($data);
        $response = $this->connectBPJS('POST', ANTREAN_WS . 'antrean/updatewaktu', '', $postdata);
        echo $response;
    }

    public function getListTask($id)
    {
        $head['header'] = 'Doctor Schedules';
        $request['kodebooking'] = $id;
        $postdata = json_encode($request);
        $data['list'] = $this->connectBPJS('POST', ANTREAN_WS . 'antrean/getlisttask', '', $postdata);

        $this->load->view('templates/header', $head);
        userRole();
        $this->load->view('v_task_info', $data);
        $this->load->view('templates/footer');
    }
}
