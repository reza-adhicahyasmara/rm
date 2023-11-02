<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_rekam_medis');
    }

    function index(){
        $id_level = $this->session->userdata['id_level'];  

        if($id_level == '1'){
            $data['data_rm'] = $this->Mod_rekam_medis->get_all_rekam_medis()->result();
            $this->template->load('layoutbackend', 'admin/laporan/body', $data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_laporan(){
        $no_remed = $this->input->post('no_remed');
        $data['pasien'] = $this->Mod_rekam_medis->get_rekam_medis($no_remed)->row_array();
        $data['riwayat'] = $this->Mod_rekam_medis->get_riwayat($no_remed)->result();
        $this->load->view('admin/laporan/load_laporan', $data);
    }

}
