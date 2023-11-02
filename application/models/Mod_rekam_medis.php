<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_rekam_medis extends CI_Model {

    function get_all_rekam_medis(){ 
        $this->db->select('rekam_medis.*, pasien.*');
        $this->db->join('pasien', 'pasien.nik = rekam_medis.nik', 'left');
        $this->db->order_by('no_remed ASC');
        return $this->db->get('rekam_medis'); 
    }

    function get_rekam_medis($no_remed){ 
        $this->db->select('rekam_medis.*, pasien.*');
        $this->db->join('pasien', 'pasien.nik = rekam_medis.nik', 'left');
        $this->db->where('rekam_medis.no_remed', $no_remed);
        $this->db->order_by('no_remed ASC');
        return $this->db->get('rekam_medis'); 
    }
    
    function get_riwayat($no_remed){ 
        $this->db->select('riwayat_rm.*, rekam_medis.*, pasien.*, tbl_user.*, poli.*');
        $this->db->join('rekam_medis', 'rekam_medis.no_remed = riwayat_rm.no_remed', 'left');
        $this->db->join('pasien', 'pasien.nik = rekam_medis.nik', 'left');
        $this->db->join('tbl_user', 'tbl_user.id_user = riwayat_rm.id_user', 'left');
        $this->db->join('poli', 'poli.id_poli = riwayat_rm.id_poli', 'left');
        $this->db->where('riwayat_rm.no_remed', $no_remed);
        $this->db->order_by('riwayat_rm.tanggal_pemeriksaan ASC');
        return $this->db->get('riwayat_rm'); 
    }
    
    function get_riwayat_rm($id_riwayat_rm){ 
        $this->db->select('*');
        $this->db->where('id_riwayat_rm', $id_riwayat_rm);
        return $this->db->get('riwayat_rm'); 
    }
    
    function insert_riwayat_rekam_medis($data){
        $this->db->insert('riwayat_rm', $data);
    }

    function update_rekam_medis($no_remed, $data){
        $this->db->where('no_remed', $no_remed);
        $this->db->update('rekam_medis', $data);
    }

}