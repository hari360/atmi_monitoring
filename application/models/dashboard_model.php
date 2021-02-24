<?php

class Dashboard_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
        $this->db_temp = $this->load->database('old_posti', TRUE);
    }

    function status_dashboard($userid) {
        $query = $this->db->query("exec get_status_dashboard ?", $userid);
        return $query->result();
    }

    function status_dashboard_crm($userid) {
        $query = $this->db->query("exec get_status_dashboard_crm ?", $userid);
        return $query->result();
    }

}
