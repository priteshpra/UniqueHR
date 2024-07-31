<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
        $firstThreeElements = array_slice($data['blog'], 0, 3);

        $data['firstThreeElements'] = $firstThreeElements;
        $data['page_name'] = 'Home';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/index', $data);
        $this->load->view('front/includes/footer');
    }
}
