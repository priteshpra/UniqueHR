<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonial extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/testimonial_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",4,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (@$this->cur_module->is_view != 1) {
            show_404();
        }
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $array['pagenames'] = getPageCombobox();
        $this->load->view('admin/testimonial/list', $array);
        $data['page_level_js'] = $this->load->view('admin/testimonial/list_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1)
    {
        $res = array();
        $res['per_page_record'] = $per_page_record;
        $res['page_number'] = $page_number;
        $res['cms'] = $this->testimonial_model->listData($per_page_record, $page_number);
        if (empty($res['cms']))
            $res['total_records'] = 0;
        else
            $res['total_records'] = $res['cms'][0]->rowcount;

        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/testimonial/ajax_listing', $res, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="4" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'b' => ''));
        unset($res);
    }

    public function add()
    {
        try {
            if (@$this->cur_module->is_insert == 0)
                show_404();
            $data = $res = array();

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Content', 'Content', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $url = site_url("admin/testimonial/add");
                    $config = array(
                        "max_width" => TESTIMONIAL_MAX_WIDTH,
                        "max_height" => TESTIMONIAL_MAX_HEIGHT,
                        'max_size' => TESTIMONIAL_MAX_SIZE,
                        'path' => TESTIMONIAL_UPLOAD_PATH,
                        'allowed_types' => TESTIMONIAL_ALLOWED_TYPES,
                        'tpath' => TESTIMONIAL_THUMB_UPLOAD_PATH,
                        'twidth' => TESTIMONIAL_THUMB_MAX_WIDTH,
                        'theight' => TESTIMONIAL_THUMB_MAX_HEIGHT
                    );

                    $data = $this->input->post();
                    $data['Image'] = FileUploadURL("Image", "editImageURL", $config, '', $url);

                    $res = $this->testimonial_model->insert($data);

                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/testimonial');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/testimonial/add');
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/testimonial/add');
                }
            }
            $this->load->view('admin/includes/header');
            $data['page_name'] = 'add';
            $data['loading_button'] = getLoadingButton();
            $data['pagenames'] = getPageCombobox();
            $this->load->view('admin/testimonial/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/testimonial/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data, $res);
        } catch (Exception $e) {
            echo $e->getMessage();

            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent(),
                "IPAddress" => GetIP()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    public function edit($ID = NULL)
    {
        try {
            if (@$this->cur_module->is_edit == 0)
                show_404();
            $data = $res = array();
            if ($this->input->post()) {

                $this->load->library('form_validation');
                $this->form_validation->set_rules('Content', 'Content', 'trim|required');

                if ($this->form_validation->run() == TRUE) {
                    $url = site_url("admin/testimonial/edit" . $ID);
                    $config = array(
                        "max_width" => TESTIMONIAL_MAX_WIDTH,
                        "max_height" => TESTIMONIAL_MAX_HEIGHT,
                        'max_size' => TESTIMONIAL_MAX_SIZE,
                        'path' => TESTIMONIAL_UPLOAD_PATH,
                        'allowed_types' => TESTIMONIAL_ALLOWED_TYPES,
                        'tpath' => TESTIMONIAL_THUMB_UPLOAD_PATH,
                        'twidth' => TESTIMONIAL_THUMB_MAX_WIDTH,
                        'theight' => TESTIMONIAL_THUMB_MAX_HEIGHT
                    );

                    $data = $this->input->post();
                    $data['Image'] = FileUploadURL("Image", "editImageURL", $config, '', $url);
                    $data['ID'] = $ID;
                    $res = $this->testimonial_model->update($data);
                    if (@$res->ID) {
                        redirect($this->config->item('base_url') . 'admin/testimonial');
                    } else {
                        $error_array = array(
                            "error_message" => $res->Message,
                            "method_name" => $res->Method,
                            "Type" => "Admin",
                            "User_Agent" => getUserAgent()
                        );
                        $this->common_model->insertAdminError($error_array);
                        $this->session->set_flashdata('posterror', label('please_try_again'));
                        redirect($this->config->item('base_url') . 'admin/testimonial/edit/' . $ID);
                    }
                } else {
                    $this->session->set_flashdata('posterror', label('required_field'));
                    redirect($this->config->item('base_url') . 'admin/testimonial/edit/' . $ID);
                }
            }

            $this->load->view('admin/includes/header');
            $data['page_name'] = 'edit/' . $ID;
            $data['cms'] = $this->testimonial_model->getCmsByID($ID);
            $data['loading_button'] = getLoadingButton();
            $data['pagenames'] = getPageCombobox(@$data['cms']->BlogID);
            $this->load->view('admin/testimonial/add_edit', $data);
            $res['page_level_js'] = $this->load->view('admin/testimonial/add_edit_js', NULL, TRUE);
            $this->load->view('admin/includes/footer', $res);
            unset($data, $res);
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent(),
                "IPAddress" => GetIP()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }

    function changeStatus()
    {
        try {
            if ($this->cur_module->is_status == 0) {
                echo json_encode(array('result' => 'error', 'message' => label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->testimonial_model->changeStatus($this->input->post());
                if ($res) {
                    $message = ($this->input->post('status') == 1) ? label('status_active') : label('status_inactive');
                    echo json_encode(array('result' => 'success', 'message' => $message));
                } else {
                    echo json_encode(array('result' => 'error', label('please_try_again')));
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $error_array = array(
                "error_message" => $e->getMessage(),
                "method_name" => __CLASS__ . '->' . __FUNCTION__,
                "Type" => "Admin",
                "User_Agent" => getUserAgent()
            );
            $this->common_model->insertAdminError($error_array);
        }
    }
}
