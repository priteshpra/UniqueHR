<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privacy extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/brand_model');
        $this->load->model('admin/cms_model');
    }

    public function index()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = PRIVACY_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Privacy Policy';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/privacy', $data);
        $this->load->view('front/includes/footer');
    }
}
