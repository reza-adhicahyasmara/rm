<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Rekam_medis extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_rekam_medis');
    }

    function index(){
        $id_level = $this->session->userdata['id_level'];  

        if($id_level == '6'){
            $data['data_rm'] = $this->Mod_rekam_medis->get_all_rekam_medis()->result();
            $this->template->load('layoutbackend', 'dokter/rekam_medis/body', $data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_rekam_medis(){
        $no_remed = $this->input->post('no_remed');
        $data['pasien'] = $this->Mod_rekam_medis->get_rekam_medis($no_remed)->row_array();
        $data['riwayat'] = $this->Mod_rekam_medis->get_riwayat($no_remed)->result();
        $this->load->view('dokter/rekam_medis/load_rekam_medis', $data);
    }

    
    function tambah_rekam_medis(){
        $no_remed = $this->input->post('no_remed');
        $id_user = $this->input->post('id_user');     
        $id_poli = $this->input->post('id_poli');     
        $tanggal_pemeriksaan = $this->input->post('tanggal_pemeriksaan');             
        $tanggal_masuk = $this->input->post('tanggal_masuk');           
        $tanggal_keluar = $this->input->post('tanggal_keluar');               
        $diagnosis = $this->input->post('diagnosis');                     

        
        $config['upload_path'] = './assets/dokumen/';
        $config['allowed_types'] = 'pdf';
        $this->upload->initialize($config);
        $this->load->library('image_lib', $config);


        if($this->upload->do_upload('file')){  
            $data = array('upload_data' => $this->upload->data());
            $dokumen = $data['upload_data']['file_name'];
        }else{
            $dokumen = "";  
        }

        echo 1;                 
        $data  = array( 
            'no_remed'              => $no_remed,
            'id_user'               => $id_user,
            'id_poli'               => $id_poli,
            'tanggal_pemeriksaan'   => $tanggal_pemeriksaan,
            'tanggal_masuk'         => $tanggal_masuk,
            'tanggal_keluar'        => $tanggal_keluar,
            'diagnosis'             => $diagnosis,
            'dokumen'               => $dokumen,
        );
        $this->Mod_rekam_medis->insert_riwayat_rekam_medis($data); 
    }


    function view_pdf_riwayat(){
        $id_riwayat_rm = $this->input->post('id_riwayat_rm');
        $data['riwayat'] = $this->Mod_rekam_medis->get_riwayat_rm($id_riwayat_rm)->row_array();
        $this->load->view('dokter/rekam_medis/view_pdf', $data);
    }

}
