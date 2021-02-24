<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Dashboard_model', '', TRUE);
  }

  function index()
  {
    $data = array(
      'title'               => 'Monitoring-Dashboard',
      'header_view'         => 'header_view',
      'content_view'        => 'home/dashboard',
      'sub_header_title'    => '',
      'header_title'        => 'DASHBOARD',
      'username'            => $this->session->userdata('logged_full_name'),
      'lastlogin'           => $this->session->userdata('logged_last_login'),
    );

    $get_status_dashboard = $this->Dashboard_model->status_dashboard($this->session->userdata('logged_user_name'));
    $get_status_dashboard_crm = $this->Dashboard_model->status_dashboard_crm($this->session->userdata('logged_user_name'));

    foreach ($get_status_dashboard as $get_status) {

      switch ($get_status->status_term) {
        case "all_terminal":
          $data['all_terminal'] = $get_status->count_trx;
          break;
        case "off_line":
          $data['offline'] = $get_status->count_trx;
          break;
        case "closed":
          $data['close'] = $get_status->count_trx;
          break;
        case "in_service":
          $data['inservice'] = $get_status->count_trx;
          break;
        case "card_retain":
          $data['cardretain'] = $get_status->count_trx;
          break;
        case "saldo_min":
          $data['saldomin'] = $get_status->count_trx;
          break;
        case "faulty":
          $data['faulty'] = $get_status->count_trx;
          break;
      }

      foreach ($get_status_dashboard_crm as $get_status) {

        switch ($get_status->status_term) {
          case "all_terminal":
            $data['all_terminal_crm'] = $get_status->count_trx;
            break;
          case "off_line":
            $data['offline_crm'] = $get_status->count_trx;
            break;
          case "closed":
            $data['close_crm'] = $get_status->count_trx;
            break;
          case "in_service":
            $data['inservice_crm'] = $get_status->count_trx;
            break;
          case "card_retain":
            $data['cardretain_crm'] = $get_status->count_trx;
            break;
          // case "saldo_min":
          //   $data['saldomin_crm'] = $get_status->count_trx;
          //   break;
          case "faulty":
            $data['faulty_crm'] = $get_status->count_trx;
            break;
        }
      }

      $data['tranidle'] = 23;
      // $data['tranidle_crm'] = 23;

    }
    $this->load->view('template', $data);
  }

  function restricted_screen()
  {

    $data = array(
      'title'     =>  $this->title,
      'subtitle'  =>  '<p><a href="' . base_url() . 'dashboard">Dashboard</a></p>',
      'h2_title'  =>  'Restricted Screen',
      'username'  =>  $this->session->userdata('logged_user'),
      'main_view' =>  'main/main',
      'message'   =>  'Oops! Sorry, an error has occured. Access forbidden.',
    );
    $this->load->view('template', $data);
  }

}
