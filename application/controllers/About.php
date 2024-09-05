<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Abouts extends CI_Controller
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
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'About us';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/about', $data);
        $this->load->view('front/includes/footer');
    }
}
