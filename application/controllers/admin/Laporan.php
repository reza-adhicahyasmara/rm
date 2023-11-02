<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_rekam_medis');
    }

    function rekam_medis(){
        $id_level = $this->session->userdata['id_level'];  

        if($id_level == '1'){
            $this->template->load('layoutbackend', 'admin/laporan_rekam_medis/body', NULL);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_laporan_rekam_medis(){
        $data['status'] = $this->input->post('status');
        $data['rekam_medis'] = $this->Mod_rekam_medis->get_all_rekam_medis()->result();
        $this->load->view('admin/laporan_rekam_medis/load_laporan', $data);
    }

    function riwayat(){
        $id_level = $this->session->userdata['id_level'];  

        if($id_level == '1'){
            $data['data_rm'] = $this->Mod_rekam_medis->get_all_rekam_medis()->result();
            $this->template->load('layoutbackend', 'admin/laporan_riwayat/body', $data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_laporan_riwayat(){
        $no_remed = $this->input->post('no_remed');
        $data['pasien'] = $this->Mod_rekam_medis->get_rekam_medis($no_remed)->row_array();
        $data['riwayat'] = $this->Mod_rekam_medis->get_riwayat($no_remed)->result();
        $this->load->view('admin/laporan_riwayat/load_laporan', $data);
    }

}
