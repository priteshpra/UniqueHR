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
        $id = $this->uri->segment(1);
        $pageName = $this->uri->segment(1);
        $page_id = $this->common_model->getPageIdData($pageName);

        $data['menu'] = $menu = $this->common_model->getMenus();
        $data['page_id'] = $page_id = isset($page_id[0]->PageID) ? $page_id[0]->PageID : 0;
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = $page_id;
        // $data['cms'] = $this->cms_model->getCmsByID($ID);
        $data['cms'] = $cms = $this->common_model->getCmsData($page_id);
        $data['banner'] = $banner = $this->common_model->getBannerData($page_id);
        $data['page_name'] = 'Privacy Policy';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/privacy', $data);
        $this->load->view('front/includes/footer');
    }
}
