<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insertAdminError($error_array)
    {
        $error_array['error_message'] = getStringClean((isset($error_array['error_message'])) ? $error_array['error_message'] : NULL);
        $error_array['method_name'] = getStringClean((isset($error_array['method_name'])) ? $error_array['method_name'] : NULL);
        $error_array['Type'] = getStringClean((isset($error_array['Type'])) ? $error_array['Type'] : NULL);
        $error_array['User_Agent'] = getStringClean((isset($error_array['User_Agent'])) ? $error_array['User_Agent'] : NULL);
        $sql = "SELECT Fn_A_AddErrorlog('" .
            $error_array['method_name'] . "','" .
            $error_array['error_message'] . "','" .
            $error_array['Type'] . "','" .
            $error_array['User_Agent'] . "','" .
            $this->session->userdata['UserID'] . "','" .
            GetIP() . "','" .
            $this->session->userdata['UserID'] .
            "')";
        $query = $this->db->query($sql);
        $query->next_result();
        $query->result();
    }
    function delete($TableName, $FieldName, $ID)
    {
        $query = $this->db->query("call usp_M_DeleteField('" . $TableName . "','" . $FieldName . "','" . $ID . "')");
        return $query->row();
    }
    function emailexists($email)
    {
        $query = $this->db->query("call usp_A_CheckEmailExist('" . $email . "')");
        return $query->row();
    }
    function getDeviceInfo($ID)
    {
        $query = $this->db->query("call usp_A_GetDeviceInfo('$ID')");
        $query->next_result();
        return $query->result();
    }
    function getCountryCombobox()
    {
        $query = $this->db->query("call usp_A_GetCountry_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getEmployeeCombobox()
    {
        $query = $this->db->query("call usp_A_GetEmployeeCombobox()");
        $query->next_result();
        return $query->result();
    }

    function getEmployee()
    {
        $query = $this->db->query("call usp_A_GetEmployee_ComboBox()");
        $query->next_result();
        return $query->result();
    }

    function getVisitor()
    {
        $query = $this->db->query("call usp_A_GetVisitor_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getDesignation()
    {
        $query = $this->db->query("call usp_A_GetDesignation_ComboBox()");
        $query->next_result();
        return $query->result();
    }

    function getLanguageCombobox()
    {
        $query = $this->db->query("call usp_A_Language_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getRolesCombobox()
    {
        $query = $this->db->query("call usp_A_Roles_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getUserCombobox($usertype = "")
    {
        $query = $this->db->query("call usp_A_GetUser_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function getStateCombobox($StateID = 0, $CountryID = 0)
    {
        $query = $this->db->query("call usp_A_GetStateOnly_ComboBox($CountryID)");
        $query->next_result();
        return $query->result();
    }
    function getPageCombobox($StateID = 0)
    {
        $query = $this->db->query("call usp_A_pagename_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function GetOnlyCity()
    {
        $query = $this->db->query("call usp_A_GetCity_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function GetOnlyGroup()
    {
        $query = $this->db->query("call usp_A_GetGroup_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function GetOnlyState()
    {
        $query = $this->db->query("call usp_A_GetStateOnly_ComboBox()");
        $query->next_result();
        return $query->result();
    }
    function GetPropertyCombobox($ProjectID)
    {
        $query = $this->db->query("call usp_A_GetPropertyByProjectID($ProjectID)");
        $query->next_result();
        return $query->result();
    }
    function GetAllPropertyCombobox($ProjectID)
    {
        $query = $this->db->query("call usp_A_GetAllPropertyByProjectID($ProjectID)");
        $query->next_result();
        return $query->result();
    }
    function GetPurchaseProperty($ProjectID)
    {
        $query = $this->db->query("call usp_A_GetPurchaseProperty($ProjectID)");
        $query->next_result();
        return $query->result();
    }
    function getCustomerPropertyCombobox($CustomerID)
    {
        $query = $this->db->query("call usp_A_GetCustomerProperty_ComboBox($CustomerID)");
        $query->next_result();
        return $query->result();
    }
    function getProjectMileStoneCombobox($CustomerPropertyID)
    {
        $query = $this->db->query("call usp_A_GetProjectMileStone_Combobox($CustomerPropertyID)");
        $query->next_result();
        return $query->result();
    }
    function getProject($GroupID)
    {
        $query = $this->db->query("call usp_A_GetProject_ComboBox('" . $GroupID . "')");
        $query->next_result();
        return $query->result();
    }
    function CheckPassCode()
    {
        $ID = $this->session->userdata['UserID'];
        $PassCode = $this->input->post('PassCode');
        $query = $this->db->query("call usp_M_CheckPassCode('$ID','$PassCode')");
        $query->next_result();
        return $query->row();
    }


    function getProjectByRoleID($RoleID)
    {
        $query = $this->db->query("call usp_A_GetProjectByRole('" . $this->session->userdata['UserID'] . "','" .
            $this->UserRoleID . "','All')");
        $query->next_result();
        return $query->result();
    }
    function GetDashboard($array)
    {
        $array['FilterType'] = (!isset($array['FilterType']) || $array['FilterType'] == "") ? "Daily" : $array['FilterType'];
        if ($this->UserRoleID == -1 || $this->UserRoleID == -2) {
            $EmployeeID = '-1';
        } else {
            $EmployeeID = $this->session->userdata['UserID'];
        }

        if ($array['FilterType'] == "Daily") {
            $wk1 = $this->db->query("SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') AS 'day'");
            $StartDates = $wk1->row_array();
            $StartDate = $StartDates['day'];
            $wkes = $this->db->query("SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') AS 'day'");
            $EndDates = $wkes->row_array();
            $EndDate = $EndDates['day'];
        } elseif ($array['FilterType'] == "Weekly") {
            $wk = $this->db->query("SELECT DATE(NOW() + INTERVAL (0 - WEEKDAY(NOW())) DAY) AS 'day'");
            $StartDates  = $wk->row_array();
            $StartDate = $StartDates['day'];
            $wke = $this->db->query("SELECT DATE(NOW() + INTERVAL (6 - WEEKDAY(NOW())) DAY) AS 'day'");
            $EndDates = $wke->row_array();
            $EndDate = $EndDates['day'];
        } elseif ($array['FilterType'] == "Monthly") {

            $wk = $this->db->query("SELECT DATE_SUB(CURDATE(), INTERVAL DAY(CURDATE())-1 DAY) AS 'day'");
            $StartDates  = $wk->row_array();
            $StartDate = $StartDates['day'];
            $wke = $this->db->query("SELECT LAST_DAY(CURRENT_DATE()) AS 'day'");
            $EndDates = $wke->row_array();
            $EndDate = $EndDates['day'];
        } elseif ($array['FilterType'] == "Yearly") {
            $wk = $this->db->query("SELECT MAKEDATE(YEAR(NOW()),1) AS 'day'");
            $StartDates  = $wk->row_array();
            $StartDate = $StartDates['day'];
            $wke = $this->db->query("SELECT LAST_DAY(DATE_ADD(NOW(), INTERVAL 12-MONTH(NOW()) MONTH)) AS 'day'");
            $EndDates = $wke->row_array();
            $EndDate = $EndDates['day'];
        } elseif ($array['FilterType'] == "Total") {
            $StartDate  = '2022-10-10';
            $EndDate = (date('Y-m-d'));
        }

        $query = $this->db->query("SELECT COUNT(BrandID) as Count FROM brands 
        WHERE DATE_FORMAT(CreatedDate,'%Y-%m-%d') BETWEEN '$StartDate'  AND '$EndDate' ");
        $result['TotalBrands'] = $query->row_array();

        $query2 = $this->db->query("SELECT COUNT(CategoryID) as Count FROM ss_category 
        WHERE DATE_FORMAT(CreatedDate,'%Y-%m-%d') BETWEEN '$StartDate'  AND '$EndDate'");
        $result['TotalCategory'] = $query2->row_array();

        $query3 = $this->db->query("SELECT COUNT(BlogID) as Count FROM sssm_blogs 
        WHERE DATE_FORMAT(CreatedDate,'%Y-%m-%d') BETWEEN '$StartDate'  AND '$EndDate'");
        $result['TotalBlogs'] = $query3->row_array();

        $query4 = $this->db->query("SELECT COUNT(JobPostingID) as Count FROM sssm_jobpost 
        WHERE DATE_FORMAT(PublishedDate,'%Y-%m-%d') BETWEEN '$StartDate'  AND '$EndDate'");
        $result['TotalJobs'] = $query4->row_array();

        $query5 = $this->db->query("SELECT COUNT(SubCategoryID) as Count FROM ss_subcategory 
        WHERE DATE_FORMAT(CreatedDate,'%Y-%m-%d') BETWEEN '$StartDate'  AND '$EndDate'");
        $result['TotalSubCat'] = $query5->row_array();


        $result['FromDate'] = $StartDate;
        $result['EndDate'] = $EndDate;
        // print_r($result);
        // die;
        return $result;
    }

    public function CheckDuplicate($data)
    {
        $data['data_value'] = getStringClean($data['data_value']);
        $sql = "call usp_A_CheckDuplicate ('" .
            $data['table_name'] . "','" .
            $data['field_name'] . "','" .
            $data['data_value'] . "','" .
            $data['ufield'] . "','" .
            $data['ID'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function CheckDuplicateDouble($data)
    {
        $sql = "call usp_A_CheckDuplicateDouble ('" .
            $data['table_name'] . "','" .
            $data['field_name'] . "','" .
            $data['data_value'] . "','" .
            $data['field_name1'] . "','" .
            $data['data_value1'] . "','" .
            $data['ufield'] . "','" .
            $data['ID'] . "')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->row();
    }
    public function changeStatus($data)
    {
        $array['ID'] = (isset($data['ID'])) ? $data['ID'] : NULL;
        $array['Status'] = (isset($data['Status'])) ? $data['Status'] : NULL;

        $array['table_name'] = $data['table_name'];
        $array['field_name'] = $data['field_name'];
        $array['modified_by'] = $this->session->userdata['UserID'];
        return $this->db->query("call usp_A_ChangeStatus('" . $array['table_name'] . "','" . $array['field_name'] . "','" . $array['ID'] . "','" . $array['Status'] . "','" . $array['modified_by'] . "');");
    }

    public function getDeviceByEmployee($UserID, $UserType, $ProjectID)
    {
        $query = $this->db->query("call usp_M_getDeviceByEmployee($UserID, '$UserType', $ProjectID)");
        $query->next_result();
        return $query->result();
    }

    // Start : Result as per Sp query 
    public function getInlineQuery($sql)
    {
        try {
            $query = $this->db->query($sql);
            return $query->result();
        } catch (Exection $e) {
            return '';
        }
    }

    function getChanelPartnersCombobox($ID)
    {
        $sql = "call usp_A_GetChanelPartnerList('-1','1','','1','','','')";
        $query = $this->db->query($sql);
        $query->next_result();
        return $query->result();
    }


    public function getMenus()
    {
        $query = $this->db->query("SELECT C.CategoryID, C.CategoryName, P.PageID
                                FROM ss_category C
                                LEFT JOIN sssm_pagemaster P ON P.CategoryID = C.CategoryID
                                WHERE C.Status = 1  GROUP BY C.CategoryName ORDER BY C.CategoryID ASC");
        $catData = $query->result();

        $query2 = $this->db->query("SELECT S.SubCategoryName, S.SubCategoryID, S.CategoryID, P.PageID
                                    FROM ss_subcategory S
                                    LEFT JOIN sssm_pagemaster P ON P.SubCategoryID = S.SubCategoryID
                                    WHERE S.Status = 1 ORDER BY S.SubCategoryID ASC");
        $subCat = $query2->result();

        foreach ($catData as $key => $value) {
            foreach ($subCat as $key => $menu) {
                $menus['CategoryID'] = $value->CategoryID;
                $menus['CategoryName'] = $value->CategoryName;
                if ($value->CategoryID == $menu->CategoryID) {
                    $menusc['SubCategoryID'] = $menu->SubCategoryID;
                    $menusc['SubCategoryName'] = $menu->SubCategoryName;
                    $menusc['PageID'] = $menu->PageID;
                    $data[$value->CategoryName][] = $menusc;
                }
            }
        }
        $return = ['menus' => $catData, 'Submenus' => $data];
        return $return;
    }

    public function getCmsData($ID)
    {
        $query = $this->db->query("SELECT C.PageID, C.Title, C.Content
                                FROM sssm_cms C
                                WHERE C.Status = 1 AND C.PageID = '$ID'");
        $cms = $query->result();
        return $cms;
    }

    public function getBannerData($ID)
    {
        $query = $this->db->query("SELECT C.BannerID, C.BannerTitle, C.SubTitle1, C.SubTitle2, C.SubTitle3, CONCAT('assets/uploads/banner/',C.Image) as Image
                                FROM ss_banner C
                                WHERE C.Status = 1 AND C.PageID = '$ID'");
        $cms = $query->result();
        return $cms;
    }

    public function getBlogsData()
    {
        $query = $this->db->query("SELECT C.BlogID, C.BlogTitle, C.AuthorName, C.PublishedDate, C.Content, C.Status
                                FROM sssm_blogs C
                                WHERE C.Status = 1");
        $cms = $query->result();
        return $cms;
    }

    public function getPageIdData($page)
    {

        $query = $this->db->query("SELECT C.PageID, C.PageName, C.CategoryID
        FROM sssm_pagemaster C
        WHERE C.Status = 1 AND LOWER(C.PageName) = '$page'");
        $cms = $query->result();
        return $cms;
    }

    public function getHomeData()
    {
        $query = $this->db->query("SELECT C.SectionID, C.PageID, C.SequenceNo, C.Content
                                FROM sssm_sections C
                                WHERE C.Status = 1 AND C.PageID = 1");
        $section = $query->result();
        return $section;
    }

    public function getBlogsDetail($name)
    {
        $query = $this->db->query("SELECT C.BlogID, C.BlogTitle, C.AuthorName, C.PublishedDate, C.Content, C.Status
                                FROM sssm_blogs C
                                WHERE C.Status = 1 AND LOWER(REPLACE(C.BlogTitle,' ', '-')) = '$name'");
        $cms = $query->result();
        return $cms;
    }

    public function getMenusMetaKey($pageName)
    {

        $query = $this->db->query("SELECT C.CategoryID, C.CategoryName,C.MetaKeyword, C.MetaDescription
                                FROM ss_category C
                                WHERE C.Status = 1 AND C.CategoryName = '$pageName'");
        $catData = $query->result();

        return $catData;
    }

    public function getMenusSubMetaKey($pageName)
    {

        $query2 = $this->db->query("SELECT S.SubCategoryName, S.SubCategoryID, S.CategoryID,S.MetaKeyword, S.MetaDescription
                                    FROM ss_subcategory S
                                    WHERE S.Status = 1  AND S.SubCategoryName ='$pageName' ");
        $subCat = $query2->result();
        return $subCat;
    }

    public function getJobData()
    {
        $query = $this->db->query("SELECT *
                                FROM sssm_jobpost
                                WHERE Status = 1 ORDER BY JobPostingID DESC LIMIT 10 ");
        $catData = $query->result();
        return $catData;
    }
}
