<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Terminalcrm extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Postilion_model', '', TRUE);
  }

  function index()
  {
    $terms = $this->Postilion_model->term_monitor_crm($this->session->userdata('logged_user_name'));

    $tmpl = array(
        'table_open'    => '<table class="table table-bordered table-striped table-hover nowrap" id="dt_terminal_crm" width="100%">',
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
                                // 'No', 
                                'ATM ID', 
                                'ATM Name', 
                                'Condition', 
                                'Mode', 
                                'Amount 50', 
                                '%',
                                'Amount 100',
                                '%',
                                'Problem',
                                'Faulty', 
                                'Views');


    $i = 0; $recno = 0;
    $str_condition = '';
    foreach ($terms as $term) 
    {
        $recno++;
                if ($recno > $i) {
                    $mode = explode('|', $term->miscellaneous);
                    if ($term->value_bars!=NULL && trim($term->value_bars, ' ')!='') {
                        $valuebar = explode('|', $term->value_bars);
                        $nominal = explode('~', $valuebar[0]);
                        $nominal100 = explode('~', $valuebar[2]);
                        $totalamount = explode('~', $valuebar[1]);
                        $totalamount100 = explode('~', $valuebar[3]);

                    } else {
                        $nominal[0] = '0';
                        $nominal100[0] = '0';
                        $totalamount[0] = '0';
                        $totalamount[1] = '0';
                        $totalamount100[0] = '0';
                        $totalamount100[1] = '0';
                    }
                    if ($this->config->item('realtime_version') == '4') {
                        switch ($term->condition) {
                            case "0":
                                $str_condition = 'OK';
                                break;
                            case "1":
                                $str_condition = array('data' => 'CRITICAL', 'style' => 'background:red;font-weight: bold;color:black');
                                break;
                            case "2":
                                $str_condition = array('data' => 'SUSPECT', 'style' => 'background:yellow;font-weight: bold;color:black');
                                break;
                        }
                    }                    
                    if ($this->config->item('realtime_version') == '5') {
                        switch ($term->worst_event_severity) {
                            case "0":
                                $str_condition = 'OK';
                                break;
                            case "1":
                                $str_condition = array('data' => 'CRITICAL', 'style' => 'background:red;font-weight: bold;color:black');
                                break;
                            case "2":
                                $str_condition = array('data' => 'SUSPECT', 'style' => 'background:yellow;font-weight: bold;color:black');
                                break;
                        }
                    }

                $problem = ''; 

                // $result=$this->Postilion_model->terminal_problem($term->id)->result();
                //     foreach ($result as $v){
                //         //$v->status_flm;
                //         $problem=$v->problem;
                //         //echo $v['title'];
                //     }

                $faulty = ''; 

                // $result1=$this->Postilion_model->terminal_faulty($term->id)->result();
                //     foreach ($result1 as $v){
                //         //$v->status_flm;
                //         $faulty=$v->faulty;
                //         //echo $v['title'];
                //     }

    				// Penyusunan data baris per baris
                    //$cell = array('data' => $term->id, 'class' => 'col-first');
                    $cell8 = anchor('postilion/terminal_monitor_detail/'.$term->id,'<i class="fa fa-eye"></i>',array('class'=>'table-actions', 'rel'=>'tooltip', 'data-placement'=>'top', 'data-original-title'=>'view'));

                    //$cell8 = '<div class="btn-group"><a class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View"><i class="gicon-eye-open"></i></a></div>';
        $persen50 = (floatval(str_replace('IDR',' ',$totalamount[1])) / 260000000) * 100;
        $persen100 = (floatval(str_replace('IDR',' ',$totalamount100[1])) / 520000000) * 100;
        //die($persen50);
        //$persen50 = '<font color="red">'.$persen50.'</font>';

        if((round($persen50,2) < 20) || (round($persen50,2) > 90))  {
            $str_condition_denom_50 = array('data' => round($persen50,2).' %', 'style' => 'background:red;font-weight: bold;color:black');
        }elseif(((round($persen50,2) > 20) && (round($persen50,2) < 25)) || ((round($persen50,2) > 85) && (round($persen50,2) < 90)))  {
            $str_condition_denom_50 = array('data' => round($persen50,2).' %', 'style' => 'background:yellow;font-weight: bold;color:black');
        }else{
            $str_condition_denom_50 = round($persen50,2).' %';
        }

        if((round($persen100,2) < 20) || (round($persen100,2) > 90))  {
            $str_condition_denom_100 = array('data' => round($persen100,2).' %', 'style' => 'background:red;font-weight: bold;color:black');
        }elseif(((round($persen100,2) > 20) && (round($persen100,2) < 25)) || ((round($persen100,2) > 85) && (round($persen100,2) < 90)))  {
            $str_condition_denom_100 = array('data' => round($persen100,2).' %', 'style' => 'background:yellow;font-weight: bold;color:black');
        }else{
            $str_condition_denom_100 = round($persen100,2).' %';
        }



                    $this->table->add_row(
                                            // ++$i, 
                                            $term->id, 
                                            str_replace('_', ' ', $term->short_name), 
                                            $str_condition, 
                                            $mode[0], 
                                            //number_format(str_replace('IDR',' ',$nominal[0])),  
                                            number_format(str_replace('IDR',' ',$totalamount[1])),
                                            $str_condition_denom_50,
                                            //number_format(str_replace('IDR',' ',$nominal100[0])), 
                                            number_format(str_replace('IDR', ' ',$totalamount100[1])),
                                            $str_condition_denom_100,
                                            $problem,
                                            $faulty,
                                            $cell8);
    				//$this->table->add_row(++$i, $term->id, str_replace('_', ' ', $term->short_name), $str_condition, $cell8);                    
                }
    }

    $data = array(
      'title'               => 'Monitoring-Cardless',
      'header_view'         => 'header_view',
      'content_view'        => 'terminal/cardless',
      'sub_header_title'    => 'Terminal Monitoring',
      'header_title'        => 'CARDLESS',
      'username'            => $this->session->userdata('logged_full_name'),
      'lastlogin'           => $this->session->userdata('logged_last_login'),
      'table'               => $this->table->generate(),
  );

    $this->load->view('template', $data);
  }

  public function get_datetime_server()
  {
        echo date('Y-m-d H:i:s');
  }

  public function ajax_get_history_offline($term_id){
    $data = $this->vModal->get_data_offline_history($term_id);
    echo json_encode($data);
  }

}
