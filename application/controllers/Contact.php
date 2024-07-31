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
    }

    public function index()
    {
        $data = $formData = array();

        // If contact request is submitted
        if ($this->input->post('contactSubmit')) {
            // Get the form data
            $formData = $this->input->post();

            // Form field validation rules
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');

            // Validate submitted form data
            if ($this->form_validation->run() == true) {

                // Define email data
                $mailData = array(
                    'name' => $formData['name'],
                    'email' => $formData['email'],
                    'subject' => $formData['subject'],
                    'message' => $formData['message']
                );

                // Send an email to the site admin
                $send = $this->sendEmail($mailData);

                // Check email sending status
                if ($send) {
                    // Unset form data
                    $formData = array();

                    $data['status'] = array(
                        'type' => 'success',
                        'msg' => 'Your contact request has been submitted successfully.'
                    );
                } else {
                    $data['status'] = array(
                        'type' => 'error',
                        'msg' => 'Some problems occured, please try again.'
                    );
                }
            }
        }

        // Pass POST data to view
        $data['postData'] = $formData;

        $data['page_name'] = 'Contact';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/contact', $data);
        $this->load->view('front/includes/footer');
    }

    private function sendEmail($mailData)
    {
        // Load the email library
        $this->load->library('email');

        // Mail config
        $to = 'recipient@gmail.com';
        $from = 'info@unique-hr.com';
        $fromName = 'unique HR';
        $mailSubject = 'Contact Request Submitted by ' . $mailData['name'];

        // Mail content
        $mailContent = '
            <h2>Contact Request Submitted</h2>
            <p><b>Name: </b>' . $mailData['name'] . '</p>
            <p><b>Email: </b>' . $mailData['email'] . '</p>
            <p><b>Subject: </b>' . $mailData['subject'] . '</p>
            <p><b>Message: </b>' . $mailData['message'] . '</p>
        ';

        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->to($to);
        $this->email->from($from, $fromName);
        $this->email->subject($mailSubject);
        $this->email->message($mailContent);

        return $this->email->send() ? true : false;
    }
}
