<?php

class Log_model extends CI_Model {

    var $v_term = 'v_term';

    function __construct()
    {
        parent::__construct();
    }

    function get_terminal() {
        return $this->db->get($this->v_term)->result();         
    }

    function get_data_offline_history($entity_name) {
        $query = $this->db->query("exec get_data_offline_history ?",urldecode($entity_name));
        return $query->result();   
    }

}