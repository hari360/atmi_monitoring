<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Mpdf\Mpdf;

class Reportiso extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Postilion_model', '', TRUE);
    $this->load->model('Log_model', '', TRUE);
    $this->load->library('csvparser');
  }


  function get_table_log(){
        $terms = $this->Log_model->get_terminal_crm();

        $tmpl = array(
        'table_open'    => '<table class="table table-bordered table-striped table-hover nowrap" id="dt_terminal_log_crm" width="100%">',
        'thead_open'            => '<thead>',
        'thead_close'           => '</thead>',
        'heading_row_start'   => '<tr>',
        'heading_row_end'     => '</tr>',
        'heading_cell_start'  => '<th>',
        'heading_cell_end'    => '</th>',
        'row_alt_start'  => '<tr>',
        'row_alt_end'    => '</tr>'
        );
        $this->table->set_template($tmpl);
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading(
        '',
        'ATM ID',
        'Terminal Name'
        );

        foreach ($terms as $term) {

        $cell_extends = array('class' => 'details-control', 'title' => $term->short_name );

        $this->table->add_row(
            $cell_extends,
            $term->id,
            $term->short_name
        );

        }
  }

  function index()
  {  
    $data = array(
        'title'               => 'Report ISO',
        'header_view'         => 'header_view',
        'content_view'        => 'report/reportiso',
        'sub_header_title'    => 'Report Tools',
        'header_title'        => 'ISO REPORTING',
        'username'            => $this->session->userdata('logged_full_name'),
        'lastlogin'           => $this->session->userdata('logged_last_login'),
    );


    $this->load->view('template', $data);
  }

  public function upload_files($id_upload)
    {
        $config = array(
            'upload_path'   => './uploads',
            'allowed_types' => 'csv',            
        );

        $this->load->library('upload', $config);

        $images = array();
        $success_json = array();
        $failed_json = array();

        if (!empty($_FILES['file_csv']['name'][0])) {
            $files = $_FILES['file_csv'];
            $title = "";

            foreach ($files['name'] as $key => $image) {
                $_FILES['file_csv[]']['name']= $files['name'][$key];
                $_FILES['file_csv[]']['type']= $files['type'][$key];
                $_FILES['file_csv[]']['tmp_name']= $files['tmp_name'][$key];
                $_FILES['file_csv[]']['error']= $files['error'][$key];
                $_FILES['file_csv[]']['size']= $files['size'][$key];
    
                $fileName = $title .'_'. $image;
    
                $images[] = $fileName;
    
                $config['file_name'] = $fileName;
    
                $this->upload->initialize($config);
    
                if ($this->upload->do_upload('file_csv[]')) {
                    $this->upload->data();
                    
                $result =   $this->csvparser->parse_file($_FILES['file_csv[]']['tmp_name']);
                // var_dump($result);
                // die();
                // $data['csvData'] =  $result;

                // $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
                // foreach($file_data as $row)
                // {
                // $data[] = array(
                //     'first_name' => $row["First Name"],
                //         'last_name'  => $row["Last Name"],
                //         'phone'   => $row["Phone"],
                //         'email'   => $row["Email"]
                // );
                // }
                // $this->csv_import_model->insert($data);
                $now = DateTime::createFromFormat('U.u', number_format(microtime(true), 3, '.', ''));
                $local = $now->setTimeZone(new DateTimeZone('Asia/Jakarta'));
                $data = array();
                foreach($result as $row)
                {
                    $data[] = array(
                            'id_upload'             => $id_upload,
                            'terminal_id'           => $row["terminal_id"],
                            'terminal_name'         => $row["terminal_name"],
                            'terminal_city'         => $row["terminal_city"],
                            'location'              => $row["location"],
                            'user_create'           => $this->session->userdata('logged_user_name'),
                            // 'date_insert'           => date("Y-m-d H:i:s"),
                            'date_insert'           => substr($local->format("Y-m-d H:i:s.u"),0,23),
                            'upload_file'           => $fileName,
                            'upload_status'         => 'submitted'
                    );
                }

                $this->Postilion_model->insert_from_csv($data);
                    $success_json[]=$fileName;
                } else {
                    $failed_json[]=$fileName.$this->upload->display_errors();
                    // var_dump($failed_json);
                    //die($this->upload->display_errors());
                    // return false;
                }
            }
        }       

        
        $result_json = array(
            'success_get'=>$success_json,
            'failed_get'=>$failed_json
        );

        echo json_encode($result_json);
        //return $images;
    }

    // public function get_status_uplaod(){

    //     $this->csv_import_model->insert($data);
    //     echo json_encode($result_json);
    // }

    public function ajax_get_data_upload()
  {
      // $draw = intval($this->input->get("draw"));
      // $start = intval($this->input->get("start"));
      // $length = intval($this->input->get("length"));

      // $data = $this->Postilion_model->get_faulty_term_temp();
       header('Content-Type: application/json');
      // echo json_encode($data);
      


      $id_upload = $this->input->get('extra_search');
      $draw = intval($this->input->get("draw"));
      // $start = intval($this->input->get("start"));
      // $length = intval($this->input->get("length"));


      $query = $this->Postilion_model->get_data_upload($id_upload);


      $data = [];


      foreach($query as $r) {
           $data[] = array(
                $r->terminal_id,
                $r->terminal_name,
                $r->terminal_city,
                $r->location,
                $r->date_insert,
                $r->upload_status,
                $r->user_create,
                $r->upload_file
           );
      }

      $result = array(
               "draw" => $draw,
                 //"recordsTotal" => $query->num_rows(),
                 //"recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );


      echo json_encode($result);
      exit();

  }

  function excel()
  
		{
            //die('test');
			// $this->load->model('siswa_model');
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet()->setTitle("Title");;
			$sheet->setCellValue('A2', 'PT. Alto Network');
			$sheet->setCellValue('A3', 'Transaction Type : All');
			$sheet->setCellValue('A4', 'Report Activity (Batch 2333)');

            $sheet->setCellValue('A6', 'Seq. Number');
            $sheet->setCellValue('B6', 'Terminal ID');
            $sheet->setCellValue('C6', 'PAN');
            $sheet->setCellValue('D6', 'Issuer');
            $sheet->setCellValue('E6', 'Beneficiary');
            $sheet->setCellValue('F6', 'Date');
            $sheet->setCellValue('G6', 'Time');
            $sheet->setCellValue('H6', 'Type Trans');
            $sheet->setCellValue('I6', 'Amount Req');
            $sheet->setCellValue('J6', 'Amount Rsp');
            $sheet->setCellValue('K6', 'Tran Fee');
            $sheet->setCellValue('L6', 'Proc Fee');
            $sheet->setCellValue('M6', 'Routing');
            $sheet->setCellValue('N6', 'Description');
			
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(20);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setWidth(15);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getColumnDimension('G')->setWidth(15);
            $sheet->getColumnDimension('H')->setWidth(15);
            $sheet->getColumnDimension('I')->setWidth(15);
            $sheet->getColumnDimension('J')->setWidth(15);
            $sheet->getColumnDimension('K')->setWidth(15);
            $sheet->getColumnDimension('M')->setAutoSize(true);
            $sheet->getColumnDimension('N')->setAutoSize(true);
			// $siswa = $this->siswa_model->getAll();
			// $no = 1;
			// $x = 2;
			// foreach($siswa as $row)
			// {
			// 	$sheet->setCellValue('A'.$x, $no++);
			// 	$sheet->setCellValue('B'.$x, $row->nama);
			// 	$sheet->setCellValue('C'.$x, $row->kelas);
			// 	$sheet->setCellValue('D'.$x, $row->jenis_kelamin);
			// 	$sheet->setCellValue('E'.$x, $row->alamat);
			// 	$x++;
			// }
			$writer = new Xlsx($spreadsheet);
            ob_end_clean();
			$filename = 'laporan-siswa';
			
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
		}

        function pdf(){
            // $mpdf = new Mpdf();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML('<h1>Hello world!</h1>');
            // $mpdf->Output();
            $mpdf->Output('files/filename.pdf', \Mpdf\Output\Destination::FILE);
            //$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::DOWNLOAD);
        }

}
