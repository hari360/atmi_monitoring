<?php

class Postilion_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
        $this->db_temp = $this->load->database('old_posti', TRUE);
    }

    function term_monitor_offset($username) {
        $query = $this->db->query("exec get_terminal_monitor ?", $username);
        return $query->result();
    }

    function term_monitor_offset_temp($username) {
        $query = $this->db_temp->query("exec get_terminal_monitor_temp ?", $username);
        return $query->result();
    }

    function get_terminal_offline_front($id){
        $query = $this->db->query("exec get_mode_terminal '".$id."'");
        return $query;
    }

    function all_terminal() {
        $query = $this->db->query("exec get_dashboard_all_terminal");
        return $query->num_rows();
    }

    public function save($data,$tbl)
    {
        $this->db->insert('tbl_flm', $data);
        return $this->db->insert_id();
    }

    function term_monitor_crm($user_term) {
        $query = $this->db->query("exec get_terminal_crm ?", $user_term);
        return $query->result();
    }

    function get_data_flm_slm($term_id){
        $query = $this->db->query("exec get_data_flm_slm ?", $term_id);
        return $query->result();
    }

    function get_status_flm_slm($value_id,$status) {
        $this->db->select('status_'.$status);
        $this->db->from('tbl_'.$status);
        $this->db->where('terminal_id', $value_id);
        $this->db->order_by("date_insert", "asc");
        return $this->db->get()->result();
    }

}
