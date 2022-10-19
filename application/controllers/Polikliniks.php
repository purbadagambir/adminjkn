<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Polikliniks extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
    }

    public function index()
    {
        #getDataPoli($ppk)
        $data['header'] = 'Poliklinik';
        $data['list'] = $this->loadService(JKN_WS . 'poliklinik/getDataPoli/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
        $this->load->view('templates/header', $data);
        userRole();
        $this->load->view('v_poliklinik');
        $this->load->view('templates/footer');
    }
    public function ruangan()
    {
        $data['header'] = 'Ruangan Poliklinik';
        $data['list'] = $this->m_poliklinik->selectall();
        $this->load->view('templates/header', $data);
        userRole();
        $this->load->view('v_ruangan');
        //$this->load->view('templates/footer');
    }

    public function ruanganinsert()
    {
        $data['id'] = $this->input->post('id_ruangan');
        $data['nama'] = $this->input->post('nama_ruangan');
        $res = json_decode($this->m_poliklinik->insert($data));
        if ($res->response == true) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong> Insert data Ruangan Poli selesai<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
        }

        redirect('polikliniks/ruangan');
    }

    public function ruangandelete()
    {
        $where['id'] = $this->input->post('id-delete');
        $res = json_decode($this->m_poliklinik->delete($where));
        if ($res->response == true) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong> Insert data Ruangan Poli selesai<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
        }

        redirect('polikliniks/ruangan');
    }

    public function getDatapoliklinik()
    {
        # getDataPoliHfis($ppk)
        $response = $this->loadService(JKN_WS . 'poliklinik/getDataPoliHfis/' . $this->session->userdata('ppk'), 'GET', $this->requestHeader(), '');
        $res = json_decode($response);
        if ($res->metadata->code == 200) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong> Download data poli selesai<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $res->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	  </button>
        	</div>'
            );
        }
        //redirect('polikliniks');
    }

    public function getDataPoliHfis($ppk = PPK)
    {
        try {
            $host = ANTREAN_WS . 'ref/poli';
            $response = $this->connectBPJS('GET', $host, '');
            $data = json_decode($response);
            //var_dump($response);
            // echo $response;
            if ($data->metadata->code == 1) {
                $return = json_decode($this->loadService(JKN_WS . 'poliklinik/insert/' . $this->session->userdata('ppk'), 'POST', $this->requestHeader(),  $response));
                // $return = json_decode($sendtows);
                //var_dump($return);
                if ($return->metadata->code == 200) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success ! </strong>' . $return->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>'
                    );
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal ! </strong>' . $data->metadata->message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
        //redirect('polikliniks');
    }
}
