<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sites extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",23,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        $this->load->model('admin/config_model');
        $this->load->model('admin/visitor_model');
        $this->load->model('admin/sites_model');
        $this->configdata = $this->config_model->getConfig();
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1)
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;
        $result['visitorsites'] = $this->sites_model->listData($per_page_record, $page_number);
        if (isset($result['visitorsites'][0]->Message))
            $result['total_records'] = 0;
        else
            $result['total_records'] = $result['visitorsites'][0]->rowcount;

        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/user/sites/ajax_listing', $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="13" style="text-align: center;">' . label('no_records_found') . ' </td></tr>', 'b' => ''));
    }

    function changeStatus()
    {
        try {
            if ($this->input->post()) {
                $res = $this->sites_model->changeStatus($this->input->post());
                if ($res) {
                    $message = ($this->input->post('status') == 1) ? label('status_active') : label('status_inactive');
                    echo json_encode(array('result' => 'success', 'message' => $message));
                } else {
                    echo json_encode(array('result' => 'error', label('please_try_again')));
                }
            }
        } catch (Exception $e) {
            echo json_encode(array('result' => 'error', 'message' => $e->getMessage()));
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function test()
    {
        //sendSMS('9825185013',"Dear Amit Thank you for visit Shreeya Amalga. We are happy to see you again at Amalga. Pleaste fill free to connect with us. 9913641111");
        //sendSMS('8849046847',"Dear Amit, Thank you for visit Shreeya Amalga. We are happy to see you again at Saggi. Please feel free to connect with us. 9913641111");
        $sms_text = sendSMS('9825185013', 'Dear Amit, Thank you for visit Shreeya Amalga. We are happy to see you again at our Saggi. Please feel free to connect with us. 9913641111');
    }
    public function add($VisitorID = 0)
    {
        try {
            if ($VisitorID == 0)
                show_404();
            /*if(@$this->cur_module->is_insert == 0)
                        show_404();*/

            $data = $array = array();
            if ($this->input->post()) {

                $this->load->library('form_validation');
                $this->form_validation->set_rules('Budget', 'Budget', 'trim|required');
                if ($this->form_validation->run() == TRUE) {
                    $data = $this->input->post();
                    $res = $this->sites_model->insert($data);
                    if (@$res->ID) {
                        $sites = $this->sites_model->getByID(@$res->ID);
                        $data = $this->input->post();
                        $data['visitor'] = $this->visitor_model->getByID($data['VisitorID']);

                        //$msg_body="Hello ".$data['visitor']->FirstName.", Thanks for the visit at ".@$sites->ProjectTitle.". We would like to see you again. Team SHREEYA MOB  +91 99136 41111, +91 87589 91111";
                        //$msg_body="Dear ".$data['visitor']->FirstName.", Thank you for visit ".@$sites->ProjectTitle.". We are happy to see you again at ".@$sites->ProjectTitle.". Please fill free to connect with us. 9913641111";
                        //$msg_body="Dear ".$data['visitor']->FirstName." Thank you for visit Shreeya Amalga. We are happy to see you again at Amalga. Pleaste fill free to connect with us. 9913641111";
                        $msg_body = "Dear " . $data['visitor']->FirstName . ", Thank you for visit Shreeya Amalga. We are happy to see you again at our " . @$sites->ProjectTitle . ". Please feel free to connect with us. 9913641111";

                        $MobNo = $data['visitor']->MobileNo;
                        sendSMS($MobNo, $msg_body);

                        $data['ReminderTime']     = (isset($data['ReminderTime']))    ? $data['ReminderTime'] . ":00"  : '00:00:00';
                        $str = date(DATE_FORMAT, strtotime($data['ReminderDate'])) . " " . $data['ReminderTime'];
                        $VR_data['ReminderDate']     = (isset($data['ReminderDate'])) ? GetDateTimeInFormat($str, DATE_TIME_FORMAT, DATABASE_DATE_TIME_FORMAT)  : DEFAULT_DATE;
                        $VR_data['VisitorID'] = $data['VisitorID'];
                        $VR_data['EntryDate']     = @$this->input->post('EntryDate');
                        $VR_data['EntryTime']     = @$this->input->post('EntryTime');
                        $VR_data['Message'] = str_replace('.', '', label('api_msg_followup_new_visitor')) . '(' . $data['visitor']->FirstName . ' ' . $data['visitor']->LastName . ').';
                        $reminder = $this->visitor_model->updateVisitorReminder($VR_data);

                        redirect($this->config->item('base_url') . 'admin/user/visitor/details/' . $VisitorID);
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/user/sites/add/' . $VisitorID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/user/sites/add/' . $VisitorID);
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add/' . $VisitorID;
            $data['loading_button'] = getLoadingButton();
            $data['ChannelPartner'] = getChanelPartner();
            $data['employee'] = getEmployee($this->session->userdata['UserID']);
            $data['projects'] = getProject(0, -1, $this->UserRoleID);
            $data['VisitorID'] = $VisitorID;
            $this->load->view('admin/user/sites/add_edit', $data);
            $array['page_level_js'] = $this->load->view('admin/user/sites/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $array);
            unset($data, $array);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMonth(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
    public  function edit($ID = 0)
    {
        if ($ID == 0) {
            show_404();
            die;
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Budget', 'Budget', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post();
                $data['ID'] = $ID;
                $res = $this->sites_model->update($data);
                if (@$res->ID) {
                    redirect($this->config->item('base_url') . 'admin/user/visitor/details/' . @$data['VisitorID']);
                } else {
                    $error_array = array(
                        "error_message" => $res->Message,
                        "method_name" => $res->Method,
                        "Type" => "Admin",
                        "User_Agent" => getUserAgent()
                    );
                    $this->common_model->insertAdminError($error_array);
                    $this->session->set_flashdata('posterror', label('please_try_again'));
                    redirect($this->config->item('base_url') . 'admin/user/sites/add/' . @$data['visitor']->VisitorID);
                }
            } else {
                echo validation_errors();
                exit;
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect($this->config->item('base_url') . 'admin/user/sites/add/' . @$data['visitor']->VisitorID);
            }
        } else {

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['visitor'] = $this->sites_model->getByID($ID);
            $data['VisitorID'] = @$data['visitor']->VisitorID;
            if (empty($data['visitor'])) {
                $this->session->set_flashdata('posterror', label('record_not_found'));
                redirect($this->config->item('base_url') . 'admin/user/visitor/');
            }
            $data['ChannelPartner'] = getChanelPartner(@$data['visitor']->ChanelPartnerID);
            $data['loading_button'] = getLoadingButton();
            $data['employee'] = getEmployee(@$data['visitor']->EmployeeID);
            $data['projects'] = getProject(@$data['visitor']->ProjectID, -1, $this->UserRoleID);
            $this->load->view('admin/user/sites/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/user/sites/add_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data, $res);
        }
    }
}