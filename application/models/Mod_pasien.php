<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_pasien extends CI_Model {

	var $table = 'pasien';
	var $column_order = array('nik','nama','JK','tgl_lahir', 'alamat', 'pekerjaan',);
	var $column_search = array('nik','nama','JK','tgl_lahir', 'alamat', 'pekerjaan'); 
	var $order = array('nik' => 'desc'); // default order 

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($term = '')
    {
    	$this->db->select('*');
        $this->db->from('pasien');
        $this->db->like('pasien.nama',$term);
        $this->db->or_like('pasien.nik',$term);
        $this->db->or_like('pasien.JK',$term);
        $this->db->or_like('pasien.tgl_lahir',$term);
        $this->db->or_like('pasien.alamat',$term);
        $this->db->or_like('pasien.pekerjaan',$term);

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
        $query = $this->db->get();
        return $query->result();
    }


    public function getPasien(){
        return $this->db->get('pasien')->result();
    }

    function count_filtered()
    {
        $term = $_REQUEST['search']['value']; 
        $this->_get_datatables_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        
        $this->db->from('pasien');
        return $this->db->count_all_results();
    }

    function view_user($id)
    {   
        $this->db->where('nik',$id);
        return $this->db->get('pasien');
    }

    function getAll()
    {   
        $this->db->select('*');
        return $this->db->get('pasien');
    }

    function cekNik($username)
    {
        $this->db->where("nik",$username);
        return $this->db->get("pasien");
    }

    function insertPasien($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function getUser($id)
    {   
        $this->db->where("nik", $id);
        return $this->db->get("pasien")->row();
    }

    function updateUser($id, $data)
    {
        $this->db->where('nik', $id);
		$this->db->update('pasien', $data);
    }
    

    function deleteUsers($id, $table)
    {
        $this->db->where('nik', $id);
        $this->db->delete($table);
    }

    function userlevel()
    {
       return $this->db->order_by('id_level ASC')
                        ->get('tbl_userlevel')
                        ->result();
    }

    function getImage($id)
    {
        $this->db->select('image');
        $this->db->from('tbl_user');
        $this->db->where('id_user', $id);
        return $this->db->get();
    }
    
    function reset_pass($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('tbl_user', $data);
    }

    public function getRekamMedis($nik = '', $id = ''){
        if ($nik != ''){
            $this->db->where('rekam_medis.nik', $nik);
        }
        if($id != ''){
            $this->db->where('rekam_medis.no_remed', $id);
        }
        return $this->db
            ->join('pasien', 'pasien.nik = rekam_medis.nik')
            ->get("rekam_medis");
    }


    public function hitungUmur($date)
    {
        $firstDate = new DateTime($date);
        $today = new DateTime("today");
        if ($firstDate > $today) { 
            exit("0 tahun 0 bulan 0 hari");
        }
        $y = $today->diff($firstDate)->y;
        return $y;
    }

    public function cekAllRekam($umurMax = 2){
        $dataRekam = $this->getRekamMedis()->result();

        foreach ($dataRekam as $data){
            $umurRekam = $this->hitungUmur($data->tgl_akhir);
            if ($umurRekam > $umurMax){
                $save = [
                    "umur_berkas" => $umurRekam,
                    "status" => 0
                ];

                $this->db->update('rekam_medis', $save, ["no_remed" => $data->no_remed]);
            } else {
                $save = [
                    "umur_berkas" => $umurRekam,
                    "status" => 1
                ];
                $this->db->update('rekam_medis', $save, ["no_remed" => $data->no_remed]);
            }
            
        }
    }
}