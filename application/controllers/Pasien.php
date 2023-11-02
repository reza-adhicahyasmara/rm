<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pasien extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_user');
        $this->load->model('Mod_pasien');

    }

    public function index()
    {
        $this->load->helper('url');


        $data['user'] = $this->Mod_pasien->getAll();        
        $this->template->load('layoutbackend', 'aksesmenu/pasien', $data);
    }

    public function ajax_list()
    {

        
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_pasien->get_datatables();
        
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;

        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $nomor++;
            $row[] = $user->nik;
            $row[] = $user->nama;
            $row[] = $user->JK;
            $row[] = $user->tgl_lahir;  
            $row[] = $user->alamat;
            $row[] = $user->pekerjaan;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mod_pasien->count_all(),
                        "recordsFiltered" => $this->Mod_pasien->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     public function insert()
    {
       // var_dump($this->input->post('username'));
        $this->_validate();
        $nik = $this->input->post('nik');

        $cek = $this->Mod_pasien->cekNik($nik);
        if($cek->num_rows() > 0){
            echo json_encode(array("error" => "Nik Sudah Ada!!"));
        }else{
            
            $save  = array(
                'nik' => $this->input->post('nik'),
                'nama' => $this->input->post('nama'),
                'JK'  => $this->input->post('jk'),
                'tgl_lahir'  => $this->input->post('tgl'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'alamat' => $this->input->post('alamat')
            );

            $this->Mod_pasien->insertPasien("pasien", $save);
            echo json_encode(array("status" => TRUE));
        
        }
    }

    public function viewuser()
    {
            $id = $this->input->post('id');
            $table = $this->input->post('table');
            $data['table'] = $table;
            $data['data_field'] = $this->db->field_data($table);
            $data['data_table'] = $this->Mod_pasien->view_user($id)->result_array();
            $this->load->view('admin/view_pasien', $data);
        
    }

    public function edituser($id)
    {
            
            $data = $this->Mod_pasien->getUser($id);
            echo json_encode($data);
        
    }


    public function update()
    {
       

        $this->_validate();
        $nik = $this->input->post('nik');
        $id_user = $this->input->post('id_user');

        if ($nik == $id_user){
            $cek = false;
        }else {
            $tes = $this->Mod_pasien->cekNik($nik);
            $cek = $tes->num_rows() > 0;
        }

       

        if($cek){
            echo json_encode(array("error" => "Nik Sudah Ada!!"));
        }else{
            
            $save  = array(
                'nik' => $this->input->post('nik'),
                'nama' => $this->input->post('nama'),
                'JK'  => $this->input->post('jk'),
                'tgl_lahir'  => $this->input->post('tgl'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'alamat' => $this->input->post('alamat')
            );

            $this->Mod_pasien->updateUser($id_user, $save);
            echo json_encode(array("status" => TRUE));
        
        }
            
        
        
    }

    public function delete(){
        $id = $this->input->post('id');
        
        $this->Mod_pasien->deleteUsers($id, 'pasien');
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    public function reset(){
        $id = $this->input->post('id');
        $data = array(
            'password'  => get_hash('password')
        );
        $this->Mod_user->reset_pass($id, $data);
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    public function download()
        {
            
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Username');
            $sheet->setCellValue('C1', 'Full name');
            $sheet->setCellValue('D1', 'password');
            $sheet->setCellValue('E1', 'level');
            $sheet->setCellValue('F1', 'Image');
            $sheet->setCellValue('G1', 'Active');

            $user = $this->Mod_user->getAll()->result();
            $no = 1;
            $x = 2;
            foreach($user as $row)
            {
                $sheet->setCellValue('A'.$x, $no++);
                $sheet->setCellValue('B'.$x, $row->username);
                $sheet->setCellValue('C'.$x, $row->full_name);
                $sheet->setCellValue('D'.$x, $row->password);
                $sheet->setCellValue('E'.$x, $row->nama_level);
                $sheet->setCellValue('F'.$x, $row->image);
                $sheet->setCellValue('F'.$x, $row->is_active);
                $x++;
            }
            $writer = new Xlsx($spreadsheet);
            $filename = 'laporan-User';
            
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
            header('Cache-Control: max-age=0');
    
            $writer->save('php://output');
        }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nik') == '')
        {
            $data['inputerror'][] = 'nik';
            $data['error_string'][] = 'Nik is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('jk') == '')
        {
            $data['inputerror'][] = 'jk';
            $data['error_string'][] = 'Gender is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('tgl') == '')
        {
            $data['inputerror'][] = 'tgl';
            $data['error_string'][] = 'Please Select Date';
            $data['status'] = FALSE;
        }

        if($this->input->post('pekerjaan') == '')
        {
            $data['inputerror'][] = 'pekerjaan';
            $data['error_string'][] = 'Work is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('alamat') == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'alamat is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}