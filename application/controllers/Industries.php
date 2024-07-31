<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Industries extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/brand_model');
        $this->load->model('admin/cms_model');
    }

    public function manufacturer()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Manufacturer';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/industries/manufacturer', $data);
        $this->load->view('front/includes/footer');
    }

    public function engineering()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Engineering';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/industries/engineering', $data);
        $this->load->view('front/includes/footer');
    }

    public function automation()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Automation';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/industries/automation', $data);
        $this->load->view('front/includes/footer');
    }

    public function software()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Software';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/industries/software', $data);
        $this->load->view('front/includes/footer');
    }

    public function bifs()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Banking,Finance, Insurance';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/industries/bifs', $data);
        $this->load->view('front/includes/footer');
    }

    public function bpo()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'BPO/KPO';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/industries/bpo', $data);
        $this->load->view('front/includes/footer');
    }
    public function healthcare()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Healthcare';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/industries/healthcare', $data);
        $this->load->view('front/includes/footer');
    }

    public function realestate()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Real Estate';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/industries/realestate', $data);
        $this->load->view('front/includes/footer');
    }
}
