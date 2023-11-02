<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekammedis extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        $this->load->model('Mod_pasien', "rekam");
        $this->load->model('Mod_rekam');

        

        // backButtonHandle();
    }

    function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $data = [
                'rekam' => $this->rekam->getRekamMedis()->result(),
                'pasien' => $this->rekam->getPasien(),
            ];
            $this->template->load('layoutbackend', 'aksesmenu/rekammedis', $data);
        }
    }

    public function addRekamMedis()
    {

        $config['upload_path']          = './assets/dokumen/';
        $config['allowed_types']        = 'gif|jpg|png|pdf';
        $config['max_size']             = 1024;
        $config['encrypt_name']         = TRUE;


        $no_remed = $this->input->post('no_remed');
        $nik = $this->input->post('nik');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $diagnosa = $this->input->post('diagnosa');
        


        // proses upload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('dokumen')) {
            $dokumen = NULL;
        } else {
            $doc = array('upload_data' => $this->upload->data());
            $dokumen = $doc["upload_data"]["file_name"];
        }

        // //cek nik dulu
        $resultRekam = $this->rekam->getRekamMedis($nik);
        if ($resultRekam->num_rows() > 0) {
            //ketika id nya sudah
            if ($dokumen != ""){
                if (file_exists(FCPATH . "assets/dokumen/" . $resultRekam->row()->dokumen)){
                    unlink(FCPATH . "assets/dokumen/" . $resultRekam->row()->dokumen);
                }
                $dc = $dokumen;
            }else {
                $dc = $resultRekam->row()->dokumen;
            }
            $data = [
                "tgl_akhir" => $tgl_akhir,
                "diagnosa" => $diagnosa,
                "dokumen" => $dc,
            ];
            
            

            $this->db->update('rekam_medis', $data, ["no_remed" => $resultRekam->row()->no_remed]);
        } else {
            $data = [
                "nik" => $nik,
                "tgl_awal" => $tgl_awal,
                "tgl_akhir" => $tgl_akhir,
                "diagnosa" => $diagnosa,
                "dokumen" => $dokumen,
            ];

            $this->db->insert('rekam_medis', $data);
        }

        $data = [
            "status" => true
        ];

        echo json_encode($data);

        //cek semua rekam medis

        
        $this->rekam->cekAllRekam(4);

    }

    public function delete(){
        // $id = 9;
        $id = $this->input->post('id');
        $remed = $this->db->get_where('rekam_medis', ["no_remed" => $id])->row();
        
        if (file_exists(FCPATH . "assets/dokumen/" . $remed->dokumen)){
            unlink(FCPATH . "assets/dokumen/" . $remed->dokumen);
        }

        $this->db->delete('rekam_medis', ['no_remed' => $id]);

        $data = [
            "status" => true,
        ];


        echo json_encode($data);
    }

    public function update()
    {

        
        $config['upload_path']          = './assets/dokumen/';
        $config['allowed_types']        = 'gif|jpg|png|pdf';
        $config['max_size']             = 1024;
        $config['encrypt_name']         = TRUE;

        
        $nik = $this->input->post('id_user');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $diagnosa = $this->input->post('diagnosa');



        // proses upload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('dokumen')) {

            $dokumen = $this->input->post('dokumenLama');
        } else {
            $doc = array('upload_data' => $this->upload->data());
            if (file_exists(FCPATH . "assets/dokumen/" . $this->input->post('dokumenLama'))){
                unlink(FCPATH . "assets/dokumen/" . $this->input->post('dokumenLama'));
            }
            $dokumen = $doc["upload_data"]["file_name"];
        }

        // //cek nik dulu
        $resultRekam = $this->rekam->getRekamMedis($nik);
        if ($resultRekam->num_rows() > 0) {
            $data = [
                "tgl_awal" => $tgl_awal,
                "tgl_akhir" => $tgl_akhir,
                "diagnosa" => $diagnosa,
                "dokumen" => $dokumen,
            ];

            $this->db->update('rekam_medis', $data, ["no_remed" => $resultRekam->row()->no_remed]);
        } else {
            $data = [
                "nik" => $nik,
                "tgl_awal" => $tgl_awal,
                "tgl_akhir" => $tgl_akhir,
                "diagnosa" => $diagnosa,
                "dokumen" => $dokumen,
            ];

            $this->db->insert('rekam_medis', $data);
        }

        $data = [
            "status" => true
        ];

        echo json_encode($data);

        //cek semua rekam medis
       
        $this->rekam->cekAllRekam(4);

    }

    public function edituser($id)
    {
            
            $data = $this->rekam->getRekamMedis("",$id)->row();
            echo json_encode($data);
        
    }

    public function viewuser()
    {
            $id = $this->input->post('id');
            $table = $this->input->post('table');
            $data['table'] = $table;
            $data['data_field'] = $this->db->field_data($table);
            $data['data_table'] = $this->Mod_rekam->view_user($id)->result_array();
            $this->load->view('admin/view_remed', $data);
    }

    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_rekam->get_datatables();
        
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;

        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $nomor++;
            $row[] = $user->no_remed;
            $row[] = $user->nik;
            $row[] = $user->nama;
            $row[] = $user->tgl_awal;
            $row[] = $user->tgl_akhir;
            $row[] = $user->diagnosa;
            $row[] = $user->dokumen;
            $row[] = ($user->status == 1) ? "<span class='badge badge-success'>Pasien Aktif</span>" : "<span class='badge badge-danger'>Tidak Aktif</span>";
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mod_rekam->count_all(),
                        "recordsFiltered" => $this->Mod_rekam->count_filtered(),
                        "data" => $data,
                );

                
        //output to json format
        echo json_encode($output);
    }
    
}
/* End of file Controllername.php */
