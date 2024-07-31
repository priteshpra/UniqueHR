<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admindashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",1,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();

        if(@$this->cur_module->is_view != 1){
            show_404();
        }

        $this->load->library('session');
    }

    public function index() {

        $tommorow = date("m-d", strtotime('today'));

        $sql = "SELECT ss_vendor.FirstName, ss_vendor.LastName, ss_vendor.BirthDate, sssm_user.UserType, sssm_user.MobileNo, sssm_user.EmailID FROM sssm_user
            INNER JOIN ss_vendor ON sssm_user.UserId = ss_vendor.UserID
            WHERE DATE_FORMAT(BirthDate, '%m-%d') = '".$tommorow."'
            
            UNION
            
            SELECT sssm_chanelpartner.FirstName, sssm_chanelpartner.LastName, sssm_chanelpartner.BirthDate, sssm_user.UserType, sssm_user.MobileNo, sssm_user.EmailID FROM sssm_user
            INNER JOIN sssm_chanelpartner ON sssm_user.UserId = sssm_chanelpartner.UserID
            WHERE DATE_FORMAT(BirthDate, '%m-%d') = '".$tommorow."'
            
            UNION
            
            SELECT sssm_admindetails.FirstName, sssm_admindetails.LastName, sssm_admindetails.BirthDate, 'Employee' AS UserType, sssm_admindetails.MobileNo, sssm_admindetails.EmailID FROM sssm_admindetails
            WHERE DATE_FORMAT(BirthDate, '%m-%d') = '".$tommorow."' AND sssm_admindetails.RoleID != -1 AND sssm_admindetails.RoleID != -2";
        
        $birthdays = $this->db->query($sql)->result_array();

        $sql = "SELECT ss_vendor.FirstName, ss_vendor.LastName, ss_vendor.AnniversaryDate, sssm_user.UserType, sssm_user.MobileNo, sssm_user.EmailID FROM sssm_user
            INNER JOIN ss_vendor ON sssm_user.UserId = ss_vendor.UserID
            WHERE DATE_FORMAT(AnniversaryDate, '%m-%d') = '".$tommorow."'
            
            UNION
            
            SELECT sssm_chanelpartner.FirstName, sssm_chanelpartner.LastName, sssm_chanelpartner.AnniversaryDate, sssm_user.UserType, sssm_user.MobileNo, sssm_user.EmailID FROM sssm_user
            INNER JOIN sssm_chanelpartner ON sssm_user.UserId = sssm_chanelpartner.UserID
            WHERE DATE_FORMAT(AnniversaryDate, '%m-%d') = '".$tommorow."'
            
            UNION
            
            SELECT sssm_admindetails.FirstName, sssm_admindetails.LastName, sssm_admindetails.AnniversaryDate, 'Employee' AS UserType, sssm_admindetails.MobileNo, sssm_admindetails.EmailID FROM sssm_admindetails
            WHERE DATE_FORMAT(AnniversaryDate, '%m-%d') = '".$tommorow."' AND sssm_admindetails.RoleID != -1 AND sssm_admindetails.RoleID != -2";
        
        $anniversaries = $this->db->query($sql)->result_array();

        $data = array();
        $this->load->view('admin/includes/header');
        $data['Dashboard'] = $this->common_model->GetDashboard($this->input->post());
        $data['birthdays'] = $birthdays;
        $data['anniversaries'] = $anniversaries;
        $this->load->view('admin/admindasboard/index', $data);
        $data['page_level_js'] = $this->load->view('admin/admindasboard/index_js',$data, TRUE);
        $this->load->view('admin/includes/footer', $data);
    }
    
    public function ajax_dashboard(){
        if($this->input->post()){
            $data = array();
            $data['FilterType'] = $this->input->post('FilterType');
            $data['Dashboard'] = $this->common_model->GetDashboard($this->input->post());
            $this->load->view('admin/admindasboard/ajax_listing',$data);
        }
    }

}
