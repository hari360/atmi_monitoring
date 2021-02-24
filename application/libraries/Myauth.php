<?php if( ! defined('BASEPATH')) exit('Akses langsung tidak diperkenankan');

class Myauth
{
    var $CI = NULL;
    var $_valid = NULL;
    
    public function __construct()
    {
        $this->CI =& get_instance();    
        $this->CI->load->database();
        $this->CI->load->library('session');
        $this->CI->load->library('form_validation');
        $this->_valid = $this->CI->form_validation;
        $this->_wrapper = $this->CI->config->item('public_view');
    }
    
    public function login($page)
    {
        $this->restrict(TRUE);
        
        if($page == "")
        {
            $page = $this->_wrapper;
        }
        
        $config = array(
                        array(
                            'field' => 'username'
                            ,'label'=> 'Nama'
                            ,'rules'=> 'trim|required|xss_clean|min_length[2]|max_length[20]'
                            )
                        ,array(
                            'field' => 'password'
                            ,'label'=> 'Password'
                            ,'rules'=> 'trim|required|min_length[6]'
                            )
                        );
        $this->_valid->set_rules($config);

        if( $this->_valid->run() !== FALSE AND ($this->CI->input->post('submit_login') != FALSE || $this->CI->input->post('v_submit_login') == 'posting'))
        {
            
            $login = array('user'=>$this->CI->input->post('username')
                        ,'pass'=>$this->CI->input->post('password')
                        );
                        
            if($this->_validate_login($login))
            {
                $this->redirect();
            }
        }
        $data = array('page_title' => 'Halaman Login'
                    ,'page_content' => 'login'
                    );
        
        $this->CI->load->view($page,$data);
    }
    
    private function _validate_login($login = NULL)
    {
        $this->CI->load->helper('array');
        if( ! isset($login) && ! is_array($login))
        {
            return FALSE;
        }
        
        if(count($login) != 2)
        {
            return FALSE;
        }
        $this->CI->db->select('user_name');
        $this->CI->db->select('full_name');
        $this->CI->db->select('email');
        $this->CI->db->select('last_login');
        $this->CI->db->select('avatar');
        $this->CI->db->select('prefix_atm');
        $this->CI->db->from('v_user_login');
  		$this->CI->db->where('user_name', $login['user']);
        $this->CI->db->where('password', md5($login['pass']));
  		$this->CI->db->where('status_active', '1');
        $query = $this->CI->db->get();
        // die($this->CI->db->last_query());

        if($query->num_rows() > 0)
        {
            $prefix_access = array();
            foreach($query->result() as $val)
            {
                $v_user_name        = $val->user_name;
                $v_full_name        = $val->full_name;
                $v_last_login       = $val->last_login;
                $prefix_access[]    = $val->prefix_atm;
            }
            $this->CI->session->set_userdata('logged_user_name',$v_user_name);
            $this->CI->session->set_userdata('logged_full_name', $v_full_name);
            $this->CI->session->set_userdata('logged_last_login', $v_last_login);  
            $this->CI->session->set_userdata('logged_prefix_access', $prefix_access);    
            
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function logged_in()
    {
        if($this->CI->session->userdata('logged_user_name') == "")
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    public function logout()
    {
        $this->CI->session->sess_destroy();
        redirect('login/form');
    }

    public function redirect()
    {
        if($this->CI->session->userdata('redirector') == "")
        {
            redirect('dashboard');
        }
        else
        {
            redirect($this->CI->session->userdata('redirector'));
        }
    }
    
    public function redirect_restrict()
    {
        redirect($this->CI->config->item('restrict_view'));
    }

    public function restrict($logged_out = FALSE)
    {

        if($logged_out AND $this->logged_in())
        {
            $this->redirect();
        }
        
        if( ! $logged_out AND ! $this->logged_in())
        {
            $this->CI->session->set_userdata('redirector',$this->CI->uri->uri_string());
            redirect('login/form','location');
        }
    }
    
    public function restrict_level($level)
    {
        if( TRUE == $this->check_level($level))
        {
            $this->redirect_restrict();
        }
    }

    public function check_level($level = "1")
    {
        $cookie = substr($this->CI->session->userdata('logged_user_level'),3);
        if($cookie != $level)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
