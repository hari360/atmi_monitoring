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

    public function update($where, $data)
    {
        $this->db->update('tbl_flm', $data, $where);
        return $this->db->affected_rows();
    }

    function update_status_flm($term_id)
    {
        $data = array(
                'status_flm' => 'OK',  
                'date_time_ok' => date('Y-m-d H:i:s'),
            );
        $this->db->update('tbl_flm', $data, array('terminal_id' => $term_id));
    }

    function update_status_slm($where, $status_flm_slm)
    {
        $data = array(
                $status_flm_slm => 'OK',  
                'date_time_ok' => date('Y-m-d H:i:s'),
            );
        $this->db->update('tbl_slm', $data, array('terminal_id' => $where));
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
        $this->db->select('date_insert');
        $this->db->from('tbl_'.$status);
        $this->db->where('terminal_id', $value_id);
        $this->db->order_by("date_insert", "asc");
        return $this->db->get()->result();
    }

    function get_card_retain(){
        return $this->db->get('v_card_retain')->result();
    }

    function get_offline_term(){
        return $this->db->get('v_terminal_offline')->result();
    }

    function get_closed_term(){
        return $this->db->get('v_terminal_closed')->result();
    }

    function get_inservice_term(){
        return $this->db->get('v_terminal_inservice')->result();
    }

    function get_faulty_term(){
        return $this->db->get('v_terminal_faulty')->result();
    }

    function get_terminal_saldo_detail(){
        return $this->db->get('v_terminal_saldo_min')->result();
    }
    

    // function get_time_saldo() {
    //     $query = $this->db->query("exec sp_history_saldo_gettime");
    //     return $query->row();
    // }

    function get_terminal_saldo() {
        $query = $this->db->query("exec sp_history_saldo_getall");
        return $query->result();
    }
}
