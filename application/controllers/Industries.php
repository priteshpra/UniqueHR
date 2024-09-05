<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Industries extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/brand_model');
        $this->load->model('admin/cms_model');
        $this->menu = $menu = $this->common_model->getMenus();
        $this->load->model('admin/pagemaster_model');
        $this->load->model('admin/common_model');
    }
    public function page()
    {
        $id = $this->uri->segment(2);
        $pageName = $this->uri->segment(2);

        // $data['pagemaster'] = $pagemaster = $this->pagemaster_model->getPageMasterByID($id);
        $page_id = $this->common_model->getPageIdData($pageName);
        // echo "<pre>";
        // print_r($pageName);
        // die;
        $data['menu'] = $menu = $this->common_model->getMenus();
        $data['page_id'] = $page_id = isset($page_id[0]->PageID) ? $page_id[0]->PageID : 0;

        $data['cms'] = $cms = $this->common_model->getCmsData($page_id);
        $data['page_id'] = $page_id;
        $data['banner'] = $banner = $this->common_model->getBannerData($page_id);


        $data['page_name'] = ucfirst($pageName);
        $data['metaKey'] = $this->common_model->getMenusSubMetaKey(ucfirst($pageName));
        // echo "<pre>";
        // print_r($data['metaKey']);
        // die;
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/industries/index', $data);
        $this->load->view('front/includes/footer');
    }
}
