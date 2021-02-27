<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Offline extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Postilion_model', '', TRUE);
  }

  function detail(){
    $tmpl = array(
        'table_open'    => '<table class="table table-bordered table-striped table-hover" id="dt_offline" width="100%">',
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
                'No', 
                'ATM ID', 
                'ATM Name', 
                'Mode', 
                'Start Time', 
                'Duration', 
                'kelola'
      );
  
      $offline_data = $this->Postilion_model->get_offline_term();
      // $terms_2 = $this->Postilion_model->term_monitor_offset_temp($this->session->userdata('logged_user_name'));
  
      $i = 0;
      foreach ($offline_data as $data_offline)
      {
        
        $this->table->add_row(++$i, 
                              $data_offline->id, 
                              $data_offline->short_name,
                              $data_offline->status,
                              $data_offline->start_time,
                              $data_offline->duration,
                              $data_offline->kelola
                            );  
  
      }  

      $data = array(
        'title'               => 'Status Terminal',
        'header_view'         => 'header_view',
        'content_view'        => 'offline/detail',
        'sub_header_title'    => 'Terminal Detail',
        'header_title'        => 'TERMINAL STATUS',
        'username'            => $this->session->userdata('logged_full_name'),
        'lastlogin'           => $this->session->userdata('logged_last_login'),
        'table_offline'       => $this->table->generate(),
      );

      $this->detail_closed();
      $data['table_closed'] = $this->table->generate();

      $this->detail_inservice();
      $data['table_inservice'] = $this->table->generate();

      $this->detail_idle();
      $data['table_idle'] = $this->table->generate();

      $this->load->view('template', $data);

  }

  function detail_closed(){
    $tmpl = array(
        'table_open'    => '<table class="table table-bordered table-striped table-hover" id="dt_closed" width="100%">',
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
                    'No', 
                    'ATM ID', 
                    'ATM Name', 
                    'Mode', 
                    'Kelola'
      );
  
      $closed_data = $this->Postilion_model->get_closed_term();
      // $terms_2 = $this->Postilion_model->term_monitor_offset_temp($this->session->userdata('logged_user_name'));
  
      $i = 0;
      foreach ($closed_data as $data_closed)
      {
        
        $this->table->add_row(++$i, 
                              $data_closed->id, 
                              $data_closed->short_name,
                              $data_closed->mode,
                              $data_closed->kelola
                            );  
  
      }  

    //   $data = array(
    //     'title'               => 'Status Terminal',
    //     'header_view'         => 'header_view',
    //     'content_view'        => 'offline/detail',
    //     'sub_header_title'    => 'Terminal Detail',
    //     'header_title'        => 'TERMINAL STATUS',
    //     'username'            => $this->session->userdata('logged_full_name'),
    //     'lastlogin'           => $this->session->userdata('logged_last_login'),
    //     'table_closed'       => $this->table->generate(),
    //   );

    //   $this->load->view('template', $data);

  }

  function detail_inservice(){
    $tmpl = array(
        'table_open'    => '<table class="table table-bordered table-striped table-hover" id="dt_inservice" width="100%">',
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
                    'No', 
                    'ATM ID', 
                    'ATM Name', 
                    'Mode', 
                    'Kelola'
      );
  
      $inservice_data = $this->Postilion_model->get_inservice_term();
  
      $i = 0;
      foreach ($inservice_data as $data_inservice)
      {
        
        $this->table->add_row(++$i, 
                              $data_inservice->id, 
                              $data_inservice->short_name,
                              $data_inservice->mode,
                              $data_inservice->kelola
                            );  
  
      }  


  }

  function detail_idle(){
    $tmpl = array(
        'table_open'    => '<table class="table table-bordered table-striped table-hover" id="dt_term_idle" width="100%">',
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
                    'No', 
                    'ATM ID', 
                    'ATM Name', 
                    'Mode', 
                    'Kelola'
      );
  
      $idle_data = $this->Postilion_model->get_time_saldo();
  
      $i = 0;
      foreach ($idle_data as $data_term_idle)
      {
        
        $this->table->add_row(++$i, 
                              $data_term_idle->id, 
                              $data_term_idle->short_name,
                              $data_term_idle->mode,
                              $data_term_idle->kelola
                            );  
  
      }  


  }

}