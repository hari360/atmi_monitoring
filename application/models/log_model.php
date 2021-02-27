<?php

class Log_model extends CI_Model {

    var $v_term = 'v_term';
    var $v_term_crm = 'v_term_crm';

    function __construct()
    {
        parent::__construct();
    }

    function get_terminal() {
        return $this->db->get($this->v_term)->result();         
    }

    function get_terminal_crm() {
        return $this->db->get($this->v_term_crm)->result();         
    }

    function get_data_offline_history($entity_name) {
        $query = $this->db->query("exec get_data_offline_history ?",urldecode($entity_name));
        return $query->result();   
    }

    function get_data_offline_history_crm($entity_name) {
        $query = $this->db->query("exec get_data_offline_history_crm ?",urldecode($entity_name));
        return $query->result();   
    }

}