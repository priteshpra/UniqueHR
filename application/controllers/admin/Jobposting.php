<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jobposting extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",49,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if (@$this->cur_module->is_view != 1) {
            show_404();
        }
        $this->load->model('admin/jobposting_model');
    }

    public function index()
    {
        $array = $data = array();
        $this->load->view('admin/includes/header');
        $array['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        $this->load->view('admin/jobposting/list', $array);
        $data['page_level_js'] = $this->load->view('admin/jobposting/list_js', NULL, TRUE);
        $data['footer']['add_link'] = $this->config->item('base_url') . 'admin/jobposting/add';
        $data['footer']['listing_page'] = 'yes';
        $this->load->view('admin/includes/footer', $data);
        unset($array, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1)
    {
        $res = array();
        $res['per_page_record'] = $PageSize;
        $res['page_number'] = $CurrentPage;
        $res['data_array'] = $this->jobposting_model->ListData($PageSize, $CurrentPage);
        if (isset($res['data_array'][0]->Message))
            $res['total_records'] = 0;
        else
            $res['total_records'] = @$res['data_array'][0]->rowcount;
        $res['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($res['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $res, TRUE);
            $ajax_listing = $this->load->view('admin/jobposting/ajax_listing', $res, TRUE);
            echo json_encode(array('listing' => $ajax_listing, 'pagination' => $pagination));
        } else
            echo json_encode(array('listing' => '<tr><td colspan="3" style="text-align: center;">' . label('no_records_found') . '</td></tr>', 'pagination' => ''));
        unset($res);
    }

    public function add()
    {
        if (@$this->cur_module->is_insert == 0)
            show_404();
        $data = $res = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Title', 'Title', 'trim|required');
            $this->form_validation->set_rules('Industry', 'Industry', 'trim|required');
            $this->form_validation->set_rules('Experience', 'Experience', 'trim|required');
            $this->form_validation->set_rules('Location', 'Location', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $url = site_url("admin/jobposting/add");
                $config = array(
                    "max_width" => JOBPOST_MAX_WIDTH,
                    "max_height" => JOBPOST_MAX_HEIGHT,
                    'max_size' => JOBPOST_MAX_SIZE,
                    'path' => JOBPOST_UPLOAD_PATH,
                    'allowed_types' => JOBPOST_ALLOWED_TYPES,
                    'tpath' => JOBPOST_THUMB_UPLOAD_PATH,
                    'twidth' => JOBPOST_THUMB_MAX_WIDTH,
                    'theight' => JOBPOST_THUMB_MAX_HEIGHT
                );

                $data = $this->input->post();
                $data['FilePath'] = FileUploadURL("FilePath", "editImageURL", $config, '', $url);
                $res = $this->jobposting_model->Insert($data);
                if (@$res->ID) {
                    redirect(site_url('admin/jobposting'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $res->Message);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/jobposting/add'));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/jobposting/add'));
            }
        }
        $this->load->view('admin/includes/header');
        $data['page_name'] = 'add';
        $data['loading_button'] = getLoadingButton();
        $this->load->view('admin/jobposting/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/jobposting/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function edit($ID = NULL)
    {
        $data = $res = array();
        $data['data'] = $this->jobposting_model->GetByID($ID);
        if (@$this->cur_module->is_edit == 0)
            show_404();
        if (@$data['data']->Message) {
            $this->session->set_flashdata('posterror', label('record_not_found'));
            redirect(site_url('admin/jobposting'));
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Title', 'Title', 'trim|required');
            $this->form_validation->set_rules('Industry', 'Industry', 'trim|required');
            $this->form_validation->set_rules('Experience', 'Experience', 'trim|required');
            $this->form_validation->set_rules('Location', 'Location', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $url = site_url("admin/jobposting/edit" . $ID);
                $config = array(
                    "max_width" => JOBPOST_MAX_WIDTH,
                    "max_height" => JOBPOST_MAX_HEIGHT,
                    'max_size' => JOBPOST_MAX_SIZE,
                    'path' => JOBPOST_UPLOAD_PATH,
                    'allowed_types' => JOBPOST_ALLOWED_TYPES,
                    'tpath' => JOBPOST_THUMB_UPLOAD_PATH,
                    'twidth' => JOBPOST_THUMB_MAX_WIDTH,
                    'theight' => JOBPOST_THUMB_MAX_HEIGHT
                );

                $data = $this->input->post();
                $data['FilePath'] = FileUploadURL("FilePath", "editImageURL", $config, '', $url);
                $data['ID'] = $ID;
                $res = $this->jobposting_model->Update($data);
                if (@$res->ID) {
                    redirect(site_url('admin/jobposting'));
                } else {
                    $msg = label('please_try_again');
                    if (@$res->Message) {
                        $arr = explode('~', $res->Message);
                        $msg = @$arr[1];
                    }
                    $this->session->set_flashdata('posterror', $msg);
                    redirect(site_url('admin/jobposting/edit/' . $ID));
                }
            } else {
                $this->session->set_flashdata('posterror', label('required_field'));
                redirect(site_url('admin/jobposting/edit/' . $ID));
            }
        }

        $this->load->view('admin/includes/header');
        $data['page_name'] = 'edit/' . $ID;
        $data['loading_button'] = getLoadingButton();

        $this->load->view('admin/jobposting/add_edit', $data);
        $res['page_level_js'] = $this->load->view('admin/jobposting/add_edit_js', NULL, TRUE);
        $this->load->view('admin/includes/footer', $res);
        unset($data, $res);
    }

    public function export_to_excel()
    {
        if ($this->cur_module->is_export == 0)
            show_404();
        $array = array();
        $fields = array(
            "Rno" => "Sr No",
            "CategoryID" => "CategoryID",
            "Title" => "Title"
        );

        $this->load->library('excel');
        $array['data'] = $this->jobposting_model->ListData(-1, 1);
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');
        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($fields as $key => $field) {
            $column = PHPExcel_Cell::stringFromColumnIndex($col);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field))
                ->getStyle($column . "1")->getFont()->setBold(true);
            $col++;
        }
        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
        if (!empty($array['data'])) {
            foreach ($array['data'] as $rr => $data) {
                if (@$data->Message) {
                    break;
                }
                $col = 0;
                foreach ($fields as $key => $field) {
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$key);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Category.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function changeStatus()
    {
        try {
            if ($this->cur_module->is_status == 0) {
                echo json_encode(array('result' => 'error', 'message' => label('not_eligible_for_change')));
                die;
            }
            if ($this->input->post()) {
                $res = $this->jobposting_model->changeStatus($this->input->post());
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

    public function combobox()
    {
        if ($this->input->get()) {
            $json = array();
            $_POST['Title'] = ($this->input->get('q') == "") ? '' : $this->input->get('q');
            $_POST['Status'] = 1;
            $data = $this->jobposting_model->ListData(10, 1);
            foreach ($data as $key => $value) {
                if (@$value->Message)
                    break;
                $json[] = ['id' => $value->CategoryID, 'text' => $value->Title];
            }
            echo json_encode($json);
        }
    }
}
