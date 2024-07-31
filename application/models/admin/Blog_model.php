<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    //Start : for listing page contents 
    public function listData($per_page_record = 10, $page_number = 1)
    {
        $PageID = ($this->input->post('PageID') != '') ? $this->input->post('PageID') : -1;
        $status_search_value = ($this->input->post('Status_search') != '') ? $this->input->post('Status_search') : -1;
        $sql = "call usp_A_GetBlogs( '$per_page_record' , '$page_number','$PageID','$status_search_value')";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRecordCount()
    {
        $query = $this->db->query("call usp_A_GetRecordCount('ssc_cms','CMSID')");
        $query->next_result();
        return $query->result();
    }

    public function insert($array)
    {
        $array['PageID'] = (isset($array['PageID'])) ? $array['PageID'] : 0;
        $array['Content'] = (getStringClean(isset($array['Content'])) ? $array['Content'] : NULL);
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['created_by'] = $this->session->userdata('UserID');
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        $query = $this->db->query("call usp_A_AddBlogs('" .
            $array['PageID'] . "','" .
            $array['BlogTitle'] . "','" .
            $array['AuthorName'] . "','" .
            date('Y-m-d', strtotime($array['PublishedDate'])) . "','" .
            addslashes(utf8_encode($array['Content'])) . "','" .
            $array['created_by'] . "','" .
            $array['Status'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "')");
        $query->next_result();
        return $query->row();
    }

    public function update($array)
    {
        //print_r($array);die();
        $array['PageID'] = (isset($array['ID'])) ? $array['ID'] : NULL;
        $array['Content'] = (getStringClean(isset($array['Content'])) ? $array['Content'] : NULL);
        $array['Status'] = (isset($array['Status']) && $array['Status'] == 'on') ? ACTIVE : INACTIVE;
        $array['ID'] = (isset($array['ID'])) ? $array['ID'] : NULL;
        $array['modified_by'] = $this->session->userdata['UserID'];
        $array['usertype'] = 'Admin Web';
        $array['IPAddress'] = GetIP();
        $sql = "call usp_A_EditBlogs('" .
            $array['PageID'] . "','" .
            $array['BlogTitle'] . "','" .
            $array['AuthorName'] . "','" .
            date('Y-m-d', strtotime($array['PublishedDate'])) . "','" .
            addslashes(utf8_encode($array['Content'])) . "','" .
            $array['modified_by'] . "','" .
            $array['Status'] . "','" .
            $array['ID'] . "','" .
            $array['usertype'] . "','" .
            $array['IPAddress'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }

    public function getCmsByID($ID = NULL)
    {
        $query = $this->db->query("call usp_A_GetBlogByID('" . $ID . "')");
        $query->next_result();
        return $query->row();
    }

    function changeStatus($array)
    {
        $array['id'] = (isset($array['id'])) ? $array['id'] : NULL;
        $array['modified_by'] = (isset($array['modified_by'])) ? $array['modified_by'] : NULL;
        $array['status'] = (isset($array['status'])) ? $array['status'] : NULL;
        $array['table_name'] = "sssm_blogs";
        $array['field_name'] = "BlogID";
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['id'] . "','" . $array['status'] . "','" . $array['modified_by'] . "');");
    }
}
