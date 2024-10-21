<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Contact extends CI_Controller

{



    function __construct()

    {

        parent::__construct();

        $this->load->model('admin/brand_model');

        $this->load->model('admin/blog_model');

        $this->load->library('form_validation');

        $this->load->library('recaptcha');

        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->database();
        $this->db2 = $this->load->database('db2', TRUE);  // Load second database

    }



    public function index()

    {



        $data = $formData = array();

        $data['recaptcha_html'] = $this->recaptcha->getRecaptchaHtml();



        // Pass POST data to view

        $data['postData'] = $formData;

        $data['menu'] = $menu = $this->common_model->getMenus();

        $data['page_name'] = 'Contact';



        $data['metaKey'] = $this->common_model->getMenusMetaKey('Contact');

        // echo "<pre>";

        // print_r($data['metaKey']);

        // die;

        $this->load->view('front/includes/header', $data);

        $this->load->view('front/contact', $data);

        $this->load->view('front/includes/footer');

    }



    public function sendEmail()

    {

        // Load the email library

        $this->load->library('email');

        $this->form_validation->set_rules('con_firstname', 'First Name', 'required|alpha');

        $this->form_validation->set_rules('con_lastname', 'Last Name', 'required|alpha');

        $this->form_validation->set_rules('con_contact', 'Contact', 'required|numeric|exact_length[10]');

        $this->form_validation->set_rules('con_email', 'Email', 'required|valid_email');

        if (empty($_FILES['filename']['name'])) {

            $this->form_validation->set_rules('filename', 'Document', 'required');

        }



        $mailData = $this->input->post();



        // Captcha validation

        $recaptcha_response = $mailData['g-recaptcha-response'];

        $response = $this->recaptcha->verifyResponse($recaptcha_response);

        // print_r($response);

        if ($this->form_validation->run() == FALSE || !$response['success']) {



            $data['menu'] = $menu = $this->common_model->getMenus();

            $data['page_name'] = 'Contact';

            $data['recaptcha_error'] = $response['error-codes'][0];

            $data['recaptcha_html'] = $this->recaptcha->getRecaptchaHtml();

            $this->load->view('front/includes/header', $data);

            $this->load->view('front/contact', $data);

            $this->load->view('front/includes/footer');

        } else {



            $this->load->helper('file');



            $config['upload_path']   = 'assets/uploads/resume/';

            $config['allowed_types'] = 'doc|docx|pdf';

            $config['max_size']      = 10024;



            $this->load->library('upload');



            $this->upload->initialize($config);

            //upload file to directory

            if ($this->upload->do_upload('filename')) {



                // $uploadData = $this->upload->data();

                // $uploadedFile = $uploadData['filename'];

                $uploadedFile = $this->upload->data('file_name');



                // Define email data

                $formData = array(

                    'con_firstname' => $mailData['con_firstname'],

                    'con_lastname' => $mailData['con_lastname'],

                    'con_contact' => $mailData['con_contact'],

                    'con_email' => $mailData['con_email'],

                    'filename' => $uploadedFile,

                    'con_intro' => $mailData['con_intro']

                );

            }

            // Mail config

            $to = HR_MAIL;

            $from = $mailData['con_email'];

            $fromName = isset($formData['con_firstname']) ? $formData['con_firstname'] : '' . ' ' . (isset($formData['con_lastname']) ?$formData['con_lastname'] : '');

            $mailSubject = 'Contact Request Submitted by ' . isset($formData['con_firstname'])?$formData['con_firstname'] : '';



            // Mail content

            $mailContent = '<h2>Contact Request Submitted</h2>

    <p><b>First Name: </b>' . isset($formData['con_firstname']) ? $formData['con_firstname'] : '' . '</p>

    <p><b>Last Name: </b>' . isset($formData['con_lastname']) ?$formData['con_lastname'] : '' . '</p>

    <p><b>Contact Number: </b>' . isset($formData['con_contact']) ? $formData['con_contact'] : '' . '</p>

    <p><b>Email: </b>' . isset($formData['con_email']) ? $formData['con_email'] :'' . '</p>

    <p><b>File Url: </b><a href="' . base_url("assets/uploads/resume/") . $formData["filename"] . '">' . $formData['filename'] . '</a></p>

    <p><b>Message: </b>' . isset($formData['con_intro']) ? $formData['con_intro'] : '' . '</p>';

            $config = array(

                'protocol'  => 'smtp',

                'smtp_host' => 'smtpout.secureserver.net',

                'smtp_port' => 465, // or 465 for SSL

                'smtp_crypto' => 'ssl',

                'smtp_user' => 'info@unique-hr.com',

                'smtp_pass' => 'Guniquehr123',

                'mailtype'  => 'html', // or 'text'

                'charset'   => 'utf-8', // or

                'wordwrap'  => TRUE,

                'newline'   => "\r\n",                      // Ensure correct line endings

                'crlf'      => "\r\n"

            );

            $this->email->initialize($config);

            $this->email->to($to);

            $this->email->from($from, $fromName);

            $this->email->subject($mailSubject);

            $this->email->message($mailContent);



            $send =  $this->email->send() ? true : false;

            if ($send) {

                $this->db2->insert('unregister_user', [
                    'FirstName' => $formData['con_firstname'],
                    'LastName' => $formData['con_lastname'],
                    'EmailID' => $formData['con_email'],
                    'ContactNumber' => $formData['con_contact'],
                    'File' => $formData['filename'],
                    'Descriptions' => $formData['con_intro'],
                ]);

                $formData = array();



                $data['status'] = array(

                    'type' => 'success',

                    'msg' => 'Your contact request has been submitted successfully.'

                );

                $data['menu'] = $menu = $this->common_model->getMenus();

                $data['page_name'] = 'Contact';

                $data['recaptcha_html'] = $this->recaptcha->getRecaptchaHtml();

                $this->load->view('front/includes/header', $data);

                $this->load->view('front/contact', $data);

                $this->load->view('front/includes/footer');

            } else {

                $data['status'] = array(

                    'type' => 'error',

                    'msg' => 'Some problems occured, please try again.'

                );

                $data['menu'] = $menu = $this->common_model->getMenus();

                $data['page_name'] = 'Contact';

                $data['recaptcha_error'] = $response['error-codes'][0];

                $data['recaptcha_html'] = $this->recaptcha->getRecaptchaHtml();

                $this->load->view('front/includes/header', $data);

                $this->load->view('front/contact', $data);

                $this->load->view('front/includes/footer');

            }

        }

    }

}

