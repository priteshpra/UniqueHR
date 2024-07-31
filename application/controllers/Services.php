<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/brand_model');
        $this->load->model('admin/cms_model');
    }

    public function recruitment()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Recruitment';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/services/recruitment', $data);
        $this->load->view('front/includes/footer');
    }

    public function candidatescreening()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Candidate Screening';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/services/candidatescreening', $data);
        $this->load->view('front/includes/footer');
    }

    public function shortlisting()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Short Listing';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/services/shortlisting', $data);
        $this->load->view('front/includes/footer');
    }

    public function referencechecks()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Reference Checks';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/services/referencechecks', $data);
        $this->load->view('front/includes/footer');
    }

    public function interviewcoordination()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Interview Coordination';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/services/interviewcoordination', $data);
        $this->load->view('front/includes/footer');
    }

    public function postplacementsupport()
    {
        $data['brandList'] = $this->brand_model->ListData(100, 1);
        $ID = ABOUT_ID;
        $data['cms'] = $this->cms_model->getCmsByID($ID);

        $data['page_name'] = 'Post Placement Support';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/services/postplacementsupport', $data);
        $this->load->view('front/includes/footer');
    }
}
