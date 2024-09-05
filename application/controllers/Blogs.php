<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blogs extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/brand_model');
        $this->load->model('admin/blog_model');
    }

    public function index()
    {
        $id = $this->uri->segment(1);
        $pageName = $this->uri->segment(1);
        $page_id = $this->common_model->getPageIdData($pageName);
        $data['page_id'] = $page_id = isset($page_id[0]->PageID) ? $page_id[0]->PageID : 0;
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $data['blog'] = $this->blog_model->listData(100, 1);

        $data['page_name'] = 'Blogs';

        $this->load->view('front/includes/header', $data);
        $this->load->view('front/blogs', $data);
        $this->load->view('front/includes/footer');
    }

    public function detail($id)
    {
        // echo $id;
        // die;
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $data['Blog'] = $this->common_model->getBlogsDetail($id);
        $data['menu'] = $menu = $this->common_model->getMenus();
        $data['page_name'] = isset($Blog[0]->BlogTitle) ? $Blog[0]->BlogTitle : 'Blog Detail';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/blog-detail', $data);
        $this->load->view('front/includes/footer');
    }
}
