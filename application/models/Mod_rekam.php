<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_rekam extends CI_Model {

	var $table = 'rekam_medis';
	var $column_order = array('id_remed','no_remed','rekam_medis.nik', 'nama', 'tgl_awal','tgl_akhir', 'diagnosa', 'dokumen', "umur_berkas","status");
	var $column_search = array('id_remed','no_remed','rekam_medis.nik','nama', 'tgl_akhir', 'diagnosa', 'dokumen' , "umur_berkas", "status"); 
	var $order = array('rekam_medis.nik' => 'desc'); // default order 


    private function _get_datatables_query($term = '')
    {
    	
        $this->db->join('pasien', 'pasien.nik = rekam_medis.nik');
        $this->db->like("rekam_medis.nik", $term);
        $this->db->or_like("pasien.nama", $term);
        $this->db->or_like("rekam_medis.tgl_awal", $term);
        $this->db->or_like("rekam_medis.tgl_akhir", $term);
        $this->db->or_like("rekam_medis.diagnosa", $term);


        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term);
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get("rekam_medis");
        return $query->result();
    }

    function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term);
        $query = $this->db->get("rekam_medis");
        return $query->num_rows();
    }

    public function count_all()
    {
        
        $this->db->from('rekam_medis');
        return $this->db->count_all_results();
    }

    function view_user($id)
    {   
        $this->db->join('pasien', 'pasien.nik = rekam_medis.nik');
        $this->db->where('no_remed',$id);
        return $this->db->get('rekam_medis');
    }
    

}