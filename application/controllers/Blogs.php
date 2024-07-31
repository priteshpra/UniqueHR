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
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $data['blog'] = $this->blog_model->listData(100, 1);

        $data['page_name'] = 'Blogs';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/blogs', $data);
        $this->load->view('front/includes/footer');
    }

    public function detail($id)
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $data['Blog'] = $this->blog_model->getCmsByID($id);

        $data['page_name'] = 'Blog Detail';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/blog-detail', $data);
        $this->load->view('front/includes/footer');
    }
}
