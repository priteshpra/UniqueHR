<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PropertyInventory extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/report_model');
        $this->load->model('admin/common_model');
        $this->load->model('admin/visitor_model');
        $this->load->model('admin/feedback_model');
        $this->load->model('admin/userfeedback_model');
        $this->load->model('admin/opportunity_model');
        $this->load->model('admin/sites_model');
        $this->load->model('admin/employee_model');

        $this->load->helper("phpmailerautoload");

        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",57,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();
        }
    }

    public function index() 
    {
        $data = $res = array();
        $data['Role'] = $this->report_model->ReportRole();
        if($this->UserRoleID == -2 || $this->UserRoleID == -1){
            $data['data'] = $this->common_model->getEmployee();
        }
        else{
            $data['data'] = $this->employee_model->getemployeeBYIDList($this->session->userdata['UserID']);
        }

        $data['projects'] = $this->common_model->getProjectByRoleID($this->UserRoleID); 
        $this->load->view('admin/includes/header');
        $this->load->view('admin/report/propertyinventory/list', $data);
        $data['page_level_js'] = $this->load->view('admin/report/propertyinventory/list_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($per_page_record = 10, $page_number = 1) 
    {
        $result = array();
        $result['per_page_record'] = $per_page_record;
        $result['page_number'] = $page_number;

        $offset = ($page_number-1)*$per_page_record;

        $project_id = $this->input->post('ProjectID');

        $where = $project_id > 0 ? ' WHERE sssm_property.ProjectID = '. $project_id : '';
        
        $sql = "SELECT sssm_property.PropertyID, sssm_property.PropertyNo, sssm_customerproperty.CustomerPropertyID, sssm_customerproperty.IsHold, sssm_customerproperty.CustomerFirstName, sssm_customerproperty.CustomerLastName, sssm_customerproperty.CustomerMobileNo, sssm_project.Title FROM sssm_property
        INNER JOIN sssm_project ON sssm_property.ProjectID = sssm_project.ProjectID
        LEFT JOIN sssm_customerproperty ON sssm_property.PropertyID = sssm_customerproperty.PropertyID
        $where
        ORDER BY sssm_property.PropertyID ASC";

        $rowcount = $this->db->query($sql)->num_rows();

        $sql .= " LIMIT $offset, $per_page_record";
        $result['data_araay'] = $this->db->query($sql)->result();

        if(!isset($result['data_araay'][0]))
            $result['total_records'] = 0;
        else{
           $result['total_records'] = $rowcount;
        }
        
        $pagination = $this->load->view('admin/includes/ajax_list_pagination',$result,TRUE);
        
        $ajax_listing = $this->load->view('admin/report/propertyinventory/ajax_listing', $result,TRUE);
        if($result['total_records'] != 0)
            echo json_encode(array('a'=>$ajax_listing, 'b'=>$pagination));
        else
             echo json_encode(array('a'=>'<tr><td colspan="9" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b'=>''));
    }

    public function export_to_excel() {
        $project_id = $this->input->post('ProjectID');
        $where = $project_id > 0 ? ' WHERE sssm_property.ProjectID = '. $project_id : '';

        //load our new PHPExcel library
        $this->load->library('excel');
        
        $sql = "SELECT sssm_property.PropertyID, sssm_property.PropertyNo, sssm_customerproperty.CustomerPropertyID, sssm_customerproperty.IsHold, sssm_customerproperty.CustomerFirstName, sssm_customerproperty.CustomerLastName, sssm_customerproperty.CustomerMobileNo, sssm_project.Title FROM sssm_property
        INNER JOIN sssm_project ON sssm_property.ProjectID = sssm_project.ProjectID
        LEFT JOIN sssm_customerproperty ON sssm_property.PropertyID = sssm_customerproperty.PropertyID
        $where
        ORDER BY sssm_property.PropertyID ASC";

        $result['data_array'] = $this->db->query($sql)->result();
        
        $fields = array("Property No", "Project Name", "Customer Name", "Mobile","Status",);
        
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Export Data');

        $this->excel->setActiveSheetIndex(0);
        //Set Header Style
        $col = 0;
        foreach ($fields as $field) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords($field));
            $col++;
        }

        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;

        foreach ($result['data_array'] as $rr => $data) {
            $status = '';

            if($data->CustomerPropertyID > 0) {
                if($data->IsHold ==  1) {
                    $color_class = 'orange';
                    $status = 'Hold';
                } else {
                    $color_class = 'red';
                    $status = 'Sold';
                }
            } else {
                $color_class = 'green';
                $status = 'Available';
            }

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data->PropertyNo);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data->Title);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data->CustomerFirstName . ' ' . $data->CustomerLastName);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data->CustomerMobileNo);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $status);
            $row++;
            $SerialNo++;
        }

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'PropertyInventory.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
}
