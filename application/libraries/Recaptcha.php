<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recaptcha
{

    private $site_key;
    private $secret_key;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->config('recaptcha');

        $this->site_key = $this->ci->config->item('recaptcha_site_key');
        $this->secret_key = $this->ci->config->item('recaptcha_secret_key');
    }

    public function getRecaptchaHtml()
    {
        return '<div class="g-recaptcha" data-sitekey="' . $this->site_key . '"></div>';
    }

    public function verifyResponse($response)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $this->secret_key,
            'response' => $response,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result, true);
    }
}
