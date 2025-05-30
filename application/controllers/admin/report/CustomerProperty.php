<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CustomerProperty extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/report_model');
        $this->load->model('admin/CustomerPropertyReport_model');
        $tmp =  $this->db->query("CALL usp_A_GetRoleModuleByID(" . $this->UserRoleID . ",47,0)");
        $tmp->next_result();
        $this->cur_module = $tmp->row();
        if(@$this->cur_module->is_view != 1){
            show_404();
        }
    }

    public function index() 
    {
        $data = $res = array();
        
        if($this->input->post()){
            $div = $this->input->post('FilterDiv');
            $data['FilterType'] = $data[$div] = $this->input->post('FilterType');
            $data['ReportType'] = $div;
        }else{
            $data['ReportType'] = 'Visitor';
            $data['FilterType'] = $data['Visitor'] = 'Daily';
        }

        if($this->ProjectID == -1)
        {
            $data['Project'] = getProject(0,-1,$this->UserRoleID);
        }
        else
        {
            $data['Project'] = getProject($this->ProjectID,-1,$this->UserRoleID,0,1);
        }
        
        $data['Role'] = $this->report_model->ReportRole();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/report/customerpropertyreport/list', $data);
        $data['page_level_js'] = $this->load->view('admin/report/customerpropertyreport/list_js', $data, TRUE);
        $this->load->view('admin/includes/footer', $data);
        unset($res, $data);
    }

    public function ajax_listing($PageSize = 10, $CurrentPage = 1) {
        $result = array();
        $result['per_page_record'] = $PageSize;
        $result['page_number'] = $CurrentPage;
        $result['data_array'] = $this->CustomerPropertyReport_model->listData($PageSize, $CurrentPage);
        $div = $this->input->post('ReportType');
        if (empty($result['data_array']))
            $result['total_records'] = 0;
        else
            $result['total_records'] = @$result['data_array'][0]->rowcount;
        $result['view_modal_popup'] = $this->load->view('admin/includes/view_modal_popup', NULL, TRUE);
        if ($result['total_records'] != 0) {
            $pagination = $this->load->view('admin/includes/ajax_list_pagination', $result, TRUE);
            $ajax_listing = $this->load->view('admin/report/customerpropertyreport/Ajax_'.$div, $result, TRUE);
            echo json_encode(array('a' => $ajax_listing, 'b' => $pagination));
        } else
            echo json_encode(array('a' => '<tr><td colspan="12" style="text-align: center;">'. label('no_records_found') .' </td></tr>', 'b' => ''));
        unset($result);
    }
   
    public function export_to_excel() {
        $array = array();

        $this->load->library('excel');
        $div = $this->input->post('ReportType');
        $array['data'] = $this->CustomerPropertyReport_model->listData(-1,1);

        if($div=="Visitor"){
            $dynamicfilename='Verified';
            $fields = array(
                "SrNo"=>"SrNo",
                "PropertyNo"=>"Property No",
                "SerialNo"=>"SerialNo",
                "CustomerFirstName"=>"CustomerFirstName",
                "CustomerLastName"=>"CustomerLastName",
                "PurchaseDate"=>"PurchaseDate",
                "Amount"=>"Amount",
                "GSTAmount"=>"GST Amount",
                "RemainingPayment"=>"RemainingAmountPayment",
                "RemainingGSTPayment"=>"RemainingGSTPayment",
                "TotalNoOfPayment"=>"TotalNoOfPayment"
            );
        }elseif($div=="Followup"){
            $dynamicfilename='ATS';
            $fields = array(
                "SrNo"=>"SrNo",
                "PropertyNo"=>"Property No",
                "SerialNo"=>"SerialNo",
                "CustomerFirstName"=>"CustomerFirstName",
                "CustomerLastName"=>"CustomerLastName",
                "PurchaseDate"=>"PurchaseDate",
                "Amount"=>"Amount",
                "GSTAmount"=>"GST Amount",
                "RemainingPayment"=>"RemainingAmountPayment",
                "RemainingGSTPayment"=>"RemainingGSTPayment",
                "TotalNoOfPayment"=>"TotalNoOfPayment"
            );
        }elseif($div=="Booking"){
            $dynamicfilename='SD';
            $fields = array(
                "SrNo"=>"SrNo",
                "PropertyNo"=>"Property No",
                "SerialNo"=>"SerialNo",
                "CustomerFirstName"=>"CustomerFirstName",
                "CustomerLastName"=>"CustomerLastName",
                "PurchaseDate"=>"PurchaseDate",
                "Amount"=>"Amount",
                "GSTAmount"=>"GST Amount",
                "RemainingPayment"=>"RemainingAmountPayment",
                "RemainingGSTPayment"=>"RemainingExtraWorkPayment",
                "TotalNoOfPayment"=>"TotalNoOfPayment"
            );
        }else{
            $dynamicfilename='SD';
            $fields = array(
                "SrNo"=>"SrNo",
                "PropertyNo"=>"Property No",
                "SerialNo"=>"SerialNo",
                "CustomerFirstName"=>"CustomerFirstName",
                "CustomerLastName"=>"CustomerLastName",
                "PurchaseDate"=>"PurchaseDate",
                "Amount"=>"Amount",
                "GSTAmount"=>"GST Amount",
                "RemainingPayment"=>"RemainingAmountPayment",
                "RemainingGSTPayment"=>"RemainingExtraWorkPayment",
                "TotalNoOfPayment"=>"TotalNoOfPayment"
            );
        }

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
            ->getStyle($column."1")->getFont()->setBold(true);
            $col++;
        }
        //Set Headers of Excel
        $row = 2;
        $SerialNo = 1;
        if (!empty($array['data'])) {
            foreach ($array['data'] as $rr => $data) {
                if(@$data->Message){
                    break;
                }
                $col = 0;
                foreach ($fields as $key => $field) {

                    if ($field == 'SrNo')
                        $data->$field = $SerialNo;

                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$key);
                    $col++;
                }
                $row++;
                $SerialNo++;
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        ob_end_clean();
        $filename = 'Report-'.$dynamicfilename.  '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }
    
}
