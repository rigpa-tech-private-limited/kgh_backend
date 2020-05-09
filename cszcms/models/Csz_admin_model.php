<?php

/**
 * CSZ CMS
 *
 * An open source content management system
 *
 * Copyright (c) 2016, Astian Foundation.
 *
 * Astian Develop Public License (ADPL)
 *
 * This Source Code Form is subject to the terms of the Astian Develop Public
 * License, v. 1.0. If a copy of the APL was not distributed with this
 * file, You can obtain one at http://astian.org/about-ADPL
 *
 * @author	CSKAZA
 * @copyright   Copyright (c) 2016, Astian Foundation.
 * @license	http://astian.org/about-ADPL	ADPL License
 * @link	https://www.cszcms.com
 * @since	Version 1.0.0
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Csz_admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Csz_model');
        $this->load->database();
    }

    /**
     * load_config
     *
     * Function for load settings from database
     *
     * @return	object or FALSE
     */
    public function load_config()
    {
        return $this->Csz_model->load_config();
    }

    /**
     * getLatestVersion
     *
     * Function for get latest version from xml url
     *
     * @param	string	$xml_url    xml url file
     * @return	versoin string
     */
    public function getLatestVersion($xml_url = '')
    {
        if (!$xml_url) {
            $xml_url = $this->config->item('csz_chkverxmlurl_main');
        }
        $xml_url_bak = $this->config->item('csz_chkverxmlurl_backup');
        if ($this->Csz_model->is_url_exist($xml_url) !== false) {
            $xml = @simplexml_load_file($xml_url);
        } elseif ($this->Csz_model->is_url_exist($xml_url) === false && $this->Csz_model->is_url_exist($xml_url_bak) !== false) {
            $xml = @simplexml_load_file($xml_url_bak);
        } else {
            $xml = false;
        }
        if ($xml !== false) {
            return $xml->version;
        } else {
            $xml_cur = $this->Csz_model->getVersion();
            if (strpos($xml_cur, 'Beta') !== false) {
                $vercur = str_replace(' Beta', '', $xml_cur);
                $cur_xml = explode('.', $vercur);
                $xml_version = $cur_xml[0].'.'.$cur_xml[1].'.'.($cur_xml[2] - 1);
            } else {
                $xml_version = $xml_cur;
            }
            return $xml_version;
        }
    }

    /**
     * chkVerUpdate
     *
     * Function for check version for update
     *
     * @param	string	$cur_ver    current version
     * @param	string	$xml_url    xml url file
     * @return	true or false
     */
    public function chkVerUpdate($cur_ver, $xml_url = '')
    {
        $last_ver = $this->getLatestVersion($xml_url);
        if ($last_ver) {
            return $this->Csz_model->chkVerUpdate($cur_ver, $last_ver);
        } else {
            return false;
        }
    }

    /**
     * findNextVersion
     *
     * Function for check version for update
     *
     * @param	string	$cur_txt    current version
     * @param	string	$xml_url    xml url file
     * @return	string or false
     */
    public function findNextVersion($cur_txt, $xml_url = '')
    {
        $last_ver = $this->getLatestVersion($xml_url);
        if ($last_ver) {
            return $this->Csz_model->findNextVersion($cur_txt, $last_ver);
        } else {
            return false;
        }
    }

    /**
     * getLang
     *
     * Function for get backend language
     *
     * @return	string
     */
    public function getLang()
    {
        /* Get Lang for Admin */
        $row = $this->load_config();
        return $row->admin_lang;
    }

    /**
     * getCurPages
     *
     * Function for count in the tableget current for backend
     *
     * @return	string
     */
    public function getCurPages()
    {
        $totSegments = $this->uri->total_segments();
        if (!is_numeric($this->uri->segment($totSegments)) && $this->uri->segment($totSegments) != 'new' && $this->uri->segment($totSegments) != 'add') {
            $pageURL = $this->uri->segment($totSegments);
        } elseif (is_numeric($this->uri->segment($totSegments)) || $this->uri->segment($totSegments) == 'new' || $this->uri->segment($totSegments) == 'add') {
            if ($this->uri->segment($totSegments - 1) == 'edit' || $this->uri->segment($totSegments - 1) == 'view') {
                $pageURL = $this->uri->segment($totSegments - 2);
            } else {
                $pageURL = $this->uri->segment($totSegments - 1);
            }
        }
        if ($pageURL == "") {
            $pageURL = "admin";
        }
        return $pageURL;
    }

    /**
     * countTable
     *
     * Function for count in the table
     *
     * @param	string	$table    DB table
     * @param	string	$search_sql    DB condition
     * @return	int
     */
    public function countTable($table, $search_sql = '')
    {
        //return $this->db->count_all($table);
        return $this->Csz_model->countData($table, $search_sql);
    }

    /**
     * pageSetting
     *
     * Function for pagination settings
     *
     * @param	string	$base_url    Base url for link
     * @param	string	$total_row   Total result
     * @param	string	$result_per_page    result limit per page
     * @param	string	$num_link    Number for show the page exclude ...
     * @param	string	$uri_segment    Uri secment for use pageination
     */
    public function pageSetting($base_url, $total_row, $result_per_page, $num_link, $uri_segment = '')
    {
        if (!$uri_segment) {
            $uri_segment = 3;
        }
        $this->load->library('pagination');
        $config = array();
        $suffix_url = '';
        $config["base_url"] = $base_url;
        $config["total_rows"] = $total_row;
        $config["per_page"] = $result_per_page;
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = false;
        $config['reuse_query_string'] = false;
        if (count($_GET) > 0) {
            $suffix_url = '?'.http_build_query($_GET, '', "&");
            $config['suffix'] = $suffix_url;
        }
        $config['first_url'] = $config['base_url'].$suffix_url;
        $config['num_links'] = $num_link;
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment;
        $this->pagination->initialize($config);
    }

    /**
     * getIndexData
     *
     * Function for get data for index page (support pageination)
     *
     * @param	string	$table    DB table
     * @param	string	$limit    DB limit
     * @param	string	$offset   DB offset
     * @param	string	$orderby  DB order by field. Default is 'timestamp_create'
     * @param	string	$sort     DB sort by asc or desc. Default is 'desc'
     * @param	string	$search_sql    DB where condition. NULL if not need. Example "name='Joe' AND status LIKE '%boss%' OR status1 LIKE '%active%" for string. And array('field'=>'value') for array
     * @param	string	$groupby    DB group by field. NULL if not need
     * @param	string	$join_db   Table to join or NULL
     * @param	string	$join_where   Join condition or NULL
     * @param	string	$join_type   Join type ('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER') or NULL
     * @return	array
     */
    public function getIndexData($table, $limit = 0, $offset = 0, $orderby = '', $sort = '', $search_sql = '', $groupby = '', $join_db = '', $join_where = '', $join_type = '')
    {
        // Get a list of all user accounts
        $count = $this->Csz_model->countData($table, $search_sql, $groupby, $orderby, $sort, $join_db, $join_where, $join_type);
        $this->db->select('*');
        if ($join_db && $join_where) {
            $this->db->join($join_db, $join_where, $join_type);
        }
        if ($search_sql) {
            if (is_array($search_sql)) {
                foreach ($search_sql as $key => $value) {
                    $this->db->where($key, $value);
                }
            } else {
                $this->db->where($search_sql);
            }
        }
        if ($orderby && $sort) {
            $this->db->order_by($orderby, $sort);
        } elseif ($orderby) {
            $this->db->order_by($orderby);
        }
        if ($groupby) {
            $this->db->group_by($groupby);
        }
        if ($limit && $limit != 0) {
            if ($offset > ceil((intval($count) / intval($limit)))) {
                $offset = ceil((intval($count) / intval($limit)));
            }
            $start = (intval($offset) * intval($limit)) - intval($limit);
            if ($start < 0) {
                $start = 0;
            }
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get($table);
        if (!empty($query)) {
            if ($query->num_rows() !== 0) {
                $row = $query->result_array();
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->db->close();
    }

    /**
     * getUser
     *
     * Function for get member data
     *
     * @param	string	$id    member id
     * @return	object or FALSE
     */
    public function getUser($id, $type = '')
    {
        // Get the user details
        $sql_where = "user_admin_id = '".$id."'";
        if ($type) {
            $sql_where.= " AND user_type = '".$type."'";
        }
        $rows = $this->Csz_model->getValue('*', 'user_admin', $sql_where, '', 1);
        if ($rows !== false) {
            return $rows;
        } else {
            return false;
        }
    }

    /**
     * getUserEmail
     *
     * Function for get member email
     *
     * @param	string	$id    member id
     * @return	string
     */
    public function getUserEmail($id)
    {
        // Get the user email address
        $rows = $this->Csz_model->getValue('email', 'user_admin', "user_admin_id", $id, 1);
        if ($rows !== false) {
            return $rows->email;
        } else {
            return false;
        }
    }

    /**
     * createUser
     *
     * @param	string	$member    member is TRUE
     * Function for create the new user
     */
    public function createUser($member = false)
    {
        // Create the user account
        if ($this->input->post('active')) {
            $active = $this->input->post('active', true);
        } else {
            $active = 0;
        }
        if ($this->input->post('year', true) && $this->input->post('month', true) && $this->input->post('day', true)) {
            $birthday = $this->input->post('year', true).'-'.$this->input->post('month', true).'-'.$this->input->post('day', true);
        } else {
            $birthday = '';
        }
        $upload_file = '';
        if ($_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif') {
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/profile/';
            $file_f = $_FILES['file_upload']['tmp_name'];
            $file_name = $_FILES['file_upload']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        $data = array(
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'password' => $this->Csz_model->pwdEncypt($this->input->post('password', true)),
            'first_name' => $this->input->post('first_name', true),
            'last_name' => $this->input->post('last_name', true),
            'birthday' => $birthday,
            'gender' => $this->input->post('gender', true),
            'address' => $this->input->post('address', true),
            'phone' => $this->input->post('phone', true),
            'picture' => $upload_file,
            'active' => $active,
            'md5_hash' => md5(time() + mt_rand(1, 99999999)),
        );
        if ($member === false) {
            $this->db->set('user_type', 'admin');
        } else {
            $this->db->set('user_type', 'member');
        }
        $this->db->set('md5_lasttime', 'NOW()', false);
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->insert('user_admin', $data);
        $this->db->set('user_admin_id', $this->db->insert_id());
        $this->db->set('user_groups_id', $this->input->post('group', true));
        $this->db->insert('user_to_group');
    }

    /**
     * updateUser
     *
     * Function for update the user
     *
     * @param	string	$id    member id
     * @return	TRUE or FALSE
     */
    public function updateUser($id)
    {
        $query = $this->Csz_model->chkPassword($this->session->userdata('admin_email'), $this->input->post('cur_password', true), "user_type != 'member'");
        if ($query['num_rows'] !== 0) {
            // update the user account
            if ($this->input->post('active')) {
                $active = $this->input->post('active', true);
            } else {
                $active = 0;
            }
            if ($this->input->post('year', true) && $this->input->post('month', true) && $this->input->post('day', true)) {
                $birthday = $this->input->post('year', true).'-'.$this->input->post('month', true).'-'.$this->input->post('day', true);
            } else {
                $birthday = '';
            }
            if ($this->input->post('del_file')) {
                $upload_file = '';
                @unlink('photo/profile/'.$this->input->post('del_file', true));
            } else {
                $upload_file = $this->input->post('picture');
                if ($_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif') {
                    $paramiter = '_1';
                    $photo_id = time();
                    $uploaddir = 'photo/profile/';
                    $file_f = $_FILES['file_upload']['tmp_name'];
                    $file_name = $_FILES['file_upload']['name'];
                    $upload_file = $this->file_upload($file_f, $file_name, $this->input->post('picture', true), $uploaddir, $photo_id, $paramiter);
                }
            }
            $this->db->set('name', $this->input->post("name", true), true);
            $this->db->set('email', $this->input->post('email', true), true);
            if ($this->input->post('password') != '') {
                $this->db->set('password', $this->Csz_model->pwdEncypt($this->input->post('password', true)), true);
                $this->db->set('md5_hash', md5(time() + mt_rand(1, 99999999)), true);
                $this->db->set('md5_lasttime', 'NOW()', false);
            }
            if ($id != 1 && $this->session->userdata('user_admin_id') != $id) {
                $this->db->set('active', $active, false);
                $this->db->set('user_type', $this->input->post("user_type", true), true);
            }
            $this->db->set('first_name', $this->input->post("first_name", true), true);
            $this->db->set('last_name', $this->input->post("last_name", true), true);
            $this->db->set('birthday', $birthday, true);
            $this->db->set('gender', $this->input->post("gender", true), true);
            $this->db->set('address', $this->input->post("address", true), true);
            $this->db->set('phone', $this->input->post("phone", true), true);
            $this->db->set('picture', $upload_file, true);
            $this->db->set('timestamp_update', 'NOW()', false);
            $this->db->where('user_admin_id', $id);
            $this->db->update('user_admin');
            if ($id != 1 && $this->session->userdata('user_admin_id') != $id) {
                $user_groups_id = $this->input->post("group", true);
                $data = array(
                    'user_admin_id' => $id
                );
                $count = $this->Csz_model->countData('user_to_group', $data);
                if ($count === false || $count < 1) {
                    $this->db->set('user_groups_id', $user_groups_id);
                    $this->db->insert('user_to_group', $data);
                } else {
                    $this->db->set('user_groups_id', $user_groups_id);
                    $this->db->where('user_admin_id', $id);
                    $this->db->update('user_to_group');
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * removeUser
     *
     * Function for remove the user
     *
     * @param	string	$id    member id
     */
    public function removeUser($id)
    {
        // Delete a user account
        if ($id != 1) {
            $this->removeData('user_admin', array('user_admin_id' => $id));
        }
    }

    /**
     * removeData
     *
     * Function for remove the user
     *
     * @param	string	$table    DB table
     * @param	string	$id_field    DB id field
     * @param	string	$id_val    DB id value
     */
    public function removeData($table, $id_field, $id_val = '')
    {
        if ($table && $id_field) {
            if (is_array($id_field)) {
                // Delete a data from table
                $this->db->delete($table, $id_field);
            } else {
                // Delete a data from table
                $this->db->delete($table, array($id_field => $id_val));
            }
        } else {
            return false;
        }
    }

    /**
     * dropTable
     *
     * Function for drop the DB table
     *
     * @param	string	$table_name    DB table
     */
    public function dropTable($table_name)
    {
        $this->load->dbforge();
        if ($table_name) {
            $this->dbforge->drop_table($table_name, true);
        } else {
            return false;
        }
    }

    /**
     * chkMd5Time
     *
     * Function for check the user md5 time for forgot the password link
     *
     * @param	string	$md5    md5 from user DB
     * @param	string	$table    DB table
     * @return	TRUE or FALSE
     */
    public function chkMd5Time($md5, $table = '')
    {
        if (!$table) {
            $table = 'user_admin';
        }
        $this->db->select("*");
        $this->db->where("md5_hash", $md5);
        $this->db->where("md5_lasttime < DATE_SUB(NOW(), INTERVAL 30 MINUTE)");
        $this->db->limit(1, 0);
        $query = $this->db->get($table);
        if ($query->num_rows() !== 0) {
            $this->db->set('md5_hash', md5(time() + mt_rand(1, 99999999)), true);
            $this->db->set('md5_lasttime', 'NOW()', false);
            $this->db->where('md5_hash', $md5);
            $this->db->update($table);
            return true;
        } else {
            return false;
        }
    }

    /**
     * sessionLoginChk
     *
     * Function for check the session from client browser
     *
     * @return	TRUE or FALSE
     */
    public function sessionLoginChk()
    {
        $numcount = 0;
        if ($this->session->userdata('session_id')) {
            $numcount = $this->Csz_model->countData('user_admin', "session_id = '".$this->session->userdata('session_id')."' AND email = '".$this->session->userdata('admin_email')."'");
            if ($numcount !== false && $numcount > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * getLangISOfromName
     *
     * Function for get the language code from name
     *
     * @param	string	$lang_name    Language name
     * @return	string
     */
    public function getLangISOfromName($lang_name)
    {
        /* Get Language ISO from language config file (for backend system) */
        $this->config->load('language');
        $lang_config = $this->config->item('admin_language_iso');
        return $lang_config[$lang_name];
    }

    /**
     * getLangNamefromISO
     *
     * Function for get the language name from code
     *
     * @param	string	$lang_iso    Language code
     * @return	string
     */
    public function getLangNamefromISO($lang_iso)
    {
        /* Get Language ISO from language config file (for backend system) */
        $this->config->load('language');
        $lang_config = $this->config->item('admin_language_iso');
        $key = array_search($lang_iso, $lang_config);
        if ($key !== false && !empty($key)) {
            return $key;
        } else {
            return 'english';
        }
    }

    /**
     * cszCopyright
     *
     * Function for show website footer credit
     * Please do not remove or change this fuction
     *
     */
    public function cszCopyright()
    {
        /* Please do not remove or change this function */
        $csz_copyright = '<br><span class="copyright">Powered by <a href="http://rigpa.in" target="_blank" style="color: gray;">RIGPA TECH</a></span>';
        return $csz_copyright;
    }

    /**
     * coreCss
     *
     * Function for load core css
     *
     * @param	string	$more_css    additional css
     * @param	bool	$more_include    for include the css file or FALSE
     * @return	String
     */
    public function coreCss($more_css = '', $more_include = true)
    {
        $core_css = link_tag($this->config->item('assets_url').'/css/bootstrap.min.css');
        $core_css.= link_tag($this->config->item('assets_url').'/css/jquery-ui-themes-1.11.4/themes/smoothness/jquery-ui.min.css');
        $core_css.= link_tag($this->config->item('assets_url').'/font-awesome/css/font-awesome.min.css');
        $core_css.= link_tag($this->config->item('assets_url').'/css/flag-icon.min.css');
        $core_css.= link_tag($this->config->item('assets_url').'/js/plugins/select2/select2.min.css');
        if (!empty($more_css)) {
            if ($more_include !== false) {
                if (is_array($more_css)) {
                    foreach ($more_css as $value) {
                        if ($value) {
                            $core_css.= link_tag($value);
                        }
                    }
                } else {
                    $core_css.= link_tag($more_css);
                }
            } else {
                $more_css = str_replace(array('<style type="text/css">',"<style type='text/css'>",'<style>','</style>'), '', $more_css);
                $core_css.= '<style type="text/css">'.$more_css.'</style>';
            }
        }
        return $core_css;
    }

    /**
     * coreJs
     *
     * Function for load core js
     *
     * @param	string	$more_js    additional js
     * @param	bool	$more_include    for include the js file or FALSE
     * @return	String
     */
    public function coreJs($more_js = '', $more_include = true)
    {
        $core_js = '<script type="text/javascript" src="'.$this->config->item('assets_url').'/js/jquery-1.12.4.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="'.$this->config->item('assets_url').'/js/bootstrap.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="'.$this->config->item('assets_url').'/js/jquery-ui.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="'.$this->config->item('assets_url').'/js/jquery.ui.touch-punch.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="'.$this->config->item('assets_url').'/js/tinymce/tinymce.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="'.$this->config->item('assets_url').'/js/plugins/select2/select2.full.min.js"></script>';
        $core_js.= '<script type="text/javascript">$(function(){$(".select2").select2()});</script>';
        if (!empty($more_js)) {
            if ($more_include !== false) {
                if (is_array($more_js)) {
                    foreach ($more_js as $value) {
                        if ($value) {
                            $core_js.= '<script type="text/javascript" src="' . $value . '"></script>';
                        }
                    }
                } else {
                    $core_js.= '<script type="text/javascript" src="' . $more_js . '"></script>';
                }
            } else {
                $more_js = str_replace(array('<script type="text/javascript">',"<script type='text/javascript'>",'<script>','</script>'), '', $more_js);
                $core_js.= '<script type="text/javascript">'.str_replace('<script ', '</script><script ', $more_js).'</script>';
            }
        }
        return $core_js;
    }

    /**
     * coreMetatags
     *
     * Function for load core metatag
     *
     * @param	string	$desc_txt    page description
     * @param	string	$more_metatags    additional meta tags text
     * @return	String
     */
    public function coreMetatags($desc_txt, $more_metatags = '')
    {
        $meta = array(
            array('name' => 'robots', 'content' => 'no-cache, no-cache'),
            array('name' => 'description', 'content' => $desc_txt),
            array('name' => 'keywords', 'content' => $this->load_config()->keywords),
            array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'),
            array('name' => 'author', 'content' => 'CSKAZA'),
            array('name' => 'generator', 'content' => 'CSZ CMS | Version '.$this->Csz_model->getVersion()),
            array('name' => 'X-UA-Compatible', 'content' => 'IE=edge', 'type' => 'equiv'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
        );
        $return_meta = meta($meta);
        if (!empty($more_metatags)) {
            if (is_array($more_metatags)) {
                foreach ($more_metatags as $value) {
                    if ($value) {
                        $return_meta.= $value;
                    }
                }
            } else {
                $return_meta.= $more_metatags;
            }
        }
        return $return_meta;
    }

    /**
     * getSocial
     *
     * Function for get the social
     *
     * @return	object or FALSE
     */
    public function getSocial()
    {
        $this->db->select("*");
        $this->db->order_by("footer_social_id", "asc");
        $query = $this->db->get('footer_social');
        if ($query->num_rows() !== 0) {
            $row = $query->result();
            return $row;
        } else {
            return false;
        }
    }

    /**
     * updateSocial
     *
     * Function for update the social
     */
    public function updateSocial()
    {
        $this->db->select("*");
        $query = $this->db->get("footer_social");
        if ($query->num_rows() !== 0) {
            foreach ($query->result() as $rows) {
                $data = array();
                $data['social_url'] = $this->input->post($rows->social_name, true);
                if (isset($_POST['checkbox'.$rows->social_name])) {
                    $data['active'] = $this->input->post('checkbox'.$rows->social_name, true);
                } else {
                    $data['active'] = 0;
                }
                $this->db->set('timestamp_update', 'NOW()', false);
                $this->db->where("social_name", $rows->social_name);
                $this->db->update('footer_social', $data);
            }
        }
    }

    /**
     * updateSettings
     *
     * Function for update the settings
     */
    public function updateSettings()
    {
        $additional_js = str_replace('<script', '</script><script', str_replace('</script>', '', $this->input->post('additional_js')));
        $data = array(
            'themes_config' => $this->input->post('siteTheme', true),
            'admin_lang' => $this->input->post('siteLang', true),
            'site_footer' => $this->input->post('siteFooter', true),
            'default_email' => $this->input->post('siteEmail', true),
            'keywords' => $this->input->post('siteKeyword', true),
            'additional_js' => $additional_js,
            'additional_metatag' => $this->input->post('additional_metatag'),
            'googlecapt_active' => $this->input->post('googlecapt_active', true),
            'googlecapt_sitekey' => trim($this->input->post('googlecapt_sitekey', true)),
            'googlecapt_secretkey' => trim($this->input->post('googlecapt_secretkey', true)),
            'pagecache_time' => $this->input->post('pagecache_time', true),
            'email_protocal' => $this->input->post('email_protocal', true),
            'smtp_host' => $this->input->post('smtp_host', true),
            'smtp_user' => $this->input->post('smtp_user', true),
            'smtp_port' => $this->input->post('smtp_port', true),
            'sendmail_path' => $this->input->post('sendmail_path', true),
            'member_confirm_enable' => $this->input->post('member_confirm_enable', true),
            'member_close_regist' => $this->input->post('member_close_regist', true),
            'gmaps_key' => trim($this->input->post('gmaps_key', true)),
            'gmaps_lat' => trim($this->input->post('gmaps_lat', true)),
            'gmaps_lng' => trim($this->input->post('gmaps_lng', true)),
            'ga_client_id' => trim($this->input->post('ga_client_id', true)),
            'ga_view_id' => trim($this->input->post('ga_view_id', true)),
            'fbapp_id' => trim($this->input->post('fbapp_id', true)),
            'gsearch_active' => $this->input->post('gsearch_active', true),
            'gsearch_cxid' => trim($this->input->post('gsearch_cxid', true)),
            'maintenance_active' => $this->input->post('maintenance_active', true),
            'html_optimize_disable' => $this->input->post('html_optimize_disable', true),
        );
        if ($this->input->post('del_file')) {
            $upload_file = '';
            @unlink('photo/logo/'.$this->input->post('del_file', true));
        } else {
            $upload_file = $this->input->post('siteLogo');
            if ($_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg') {
                $paramiter = '_1';
                $photo_id = time();
                $uploaddir = 'photo/logo/';
                $file_f = $_FILES['file_upload']['tmp_name'];
                $file_name = $_FILES['file_upload']['name'];
                $upload_file = $this->file_upload($file_f, $file_name, $this->input->post('siteLogo', true), $uploaddir, $photo_id, $paramiter);
            }
        }
        $data['site_logo'] = $upload_file;
        if ($this->input->post('del_og_image')) {
            $upload_file1 = '';
            @unlink('photo/logo/'.$this->input->post('del_og_image', true));
        } else {
            $upload_file1 = $this->input->post('ogImage');
            if ($_FILES['og_image']['type'] == 'image/png' || $_FILES['og_image']['type'] == 'image/jpg' || $_FILES['og_image']['type'] == 'image/jpeg') {
                $paramiter = '_1';
                $photo_id = time();
                $uploaddir = 'photo/logo/';
                $file_f = $_FILES['og_image']['tmp_name'];
                $file_name = $_FILES['og_image']['name'];
                $upload_file1 = $this->file_upload($file_f, $file_name, $this->input->post('ogImage', true), $uploaddir, $photo_id, $paramiter);
            }
        }
        $data['og_image'] = $upload_file1;
        if ($this->input->post('siteTitle') != "") {
            $data['site_name'] = $this->input->post('siteTitle', true);
        }
        if ($this->input->post('smtp_pass', true)) {
            $this->db->set('smtp_pass', trim($this->input->post('smtp_pass', true)));
        }
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where("settings_id", 1);
        $this->db->update('settings', $data);
    }

    /**
     * file_upload
     *
     * Function for upload file
     *
     * @param	string	$photo    File from $_FILE['tmp_name']
     * @param	string	$photo_name1    File name from $_FILE['name']
     * @param	string	$tmp_photo    Temp file. Can null if noting
     * @param	string	$uploaddir    Path to save the file
     * @param	string	$photo_id    New file name
     * @param	string	$paramiter    Other paramiter for new file name. Can null if noting
     * @param	string	$yearR    Year for directory
     * @param	string	$maxSizeR    Max the photo size (pixel). For image file only. Default 1900px
     * @return	String (New filename)
     */
    public function file_upload($photo, $photo_name1, $tmp_photo, $uploaddir, $photo_id, $paramiter, $yearR = '', $maxSizeR = 1900)
    {
        $photo_name = $this->security->sanitize_filename($photo_name1);
        if ($yearR) {
            $year = $yearR."/";
        } else {
            $year = date("Y")."/";
        }
        if ($uploaddir) {
            if (file_exists($uploaddir) === false) {
                mkdir($uploaddir, 0777);
            }
            if (file_exists($uploaddir.$year) === false) {
                mkdir($uploaddir.$year, 0777);
            }
        }
        if (!$photo) {
            $photo = $tmp_photo;
        } else {
            $ext = explode(".", $photo_name);
            $ext_n = count($ext) - 1;
            if (strtoupper($ext[$ext_n]) == "JPG" || strtoupper($ext[$ext_n]) == "JPEG" || strtoupper($ext[$ext_n]) == "PNG" || strtoupper($ext[$ext_n]) == "GIF") {
                $org_filename = $photo_id.$paramiter."-org.".$ext[$ext_n];
                $newfile = $uploaddir.$year.$org_filename;
                if (is_uploaded_file($photo)) { // upload original image
                    if (!copy($photo, "$newfile")) {
                        echo "<script>alert('Error: File not uploaded!');</script>";
                    }
                }

                if (@filesize($newfile) > (1024 * 1024 * 5)) {
                    $photo = "";
                    @unlink($newfile);
                } else {
                    list($w, $h) = @getimagesize($newfile);

                    if (($w > $maxSizeR) || ($h > $maxSizeR) && (!strtoupper($ext[$ext_n]) == "GIF")) {
                        // $im = $this->thumbnail($org_filename, $uploaddir.$year, $maxSizeR); //resize image
                        // $small_filename = $photo_id.$paramiter.".".$ext[$ext_n];
                        // $this->imageToFile($im, $uploaddir.$year.$small_filename); //make image to file for resize
                        // $photo = $year.$small_filename;
                        // @unlink($newfile);

                        $photo = $year.$org_filename;
                    } else {
                        $photo = $year.$org_filename;
                    }
                }
                if ($tmp_photo) {
                    @unlink($uploaddir.$tmp_photo);
                }
            } elseif (strtoupper($ext[$ext_n]) == "PDF" || strtoupper($ext[$ext_n]) == "DOC" || strtoupper($ext[$ext_n]) == "DOCX" || strtoupper($ext[$ext_n]) == "ODT" || strtoupper($ext[$ext_n]) == "TXT" || strtoupper($ext[$ext_n]) == "ODG" || strtoupper($ext[$ext_n]) == "ODP" || strtoupper($ext[$ext_n]) == "ODS" || strtoupper($ext[$ext_n]) == "ZIP" || strtoupper($ext[$ext_n]) == "RAR" || strtoupper($ext[$ext_n]) == "PSD" || strtoupper($ext[$ext_n]) == "CSV" || strtoupper($ext[$ext_n]) == "XLS" || strtoupper($ext[$ext_n]) == "XLSX" || strtoupper($ext[$ext_n]) == "PPT" || strtoupper($ext[$ext_n]) == "PPTX" || strtoupper($ext[$ext_n]) == "MP3" || strtoupper($ext[$ext_n]) == "WAV" || strtoupper($ext[$ext_n]) == "MP4" || strtoupper($ext[$ext_n]) == "FLV" || strtoupper($ext[$ext_n]) == "WMA" || strtoupper($ext[$ext_n]) == "AVI" || strtoupper($ext[$ext_n]) == "MOV" || strtoupper($ext[$ext_n]) == "M4V" || strtoupper($ext[$ext_n]) == "WMV" || strtoupper($ext[$ext_n]) == "M3U" || strtoupper($ext[$ext_n]) == "PLS") {
                $final_filename = $photo_id.$paramiter.".".$ext[$ext_n];
                $newfile = $uploaddir.$year.$final_filename;
                if (is_uploaded_file($photo)) {
                    if (!copy($photo, "$newfile")) {
                        echo "<script>alert('Error: File not uploaded!');</script>";
                    }
                }
                $photo = $year.$final_filename;
                if (@filesize($newfile) > (1024 * 1024 * 100)) { // Limit 100 MB
                    $photo = "";
                    @unlink($newfile);
                }
                if ($tmp_photo) {
                    @unlink($uploaddir.$tmp_photo);
                }
            } else {
                $photo = "";
            }
        }
        return $photo;
    }

    /**
     * Create a thumbnail image from $inputFileName no taller or wider than
     * $maxSize. Returns the new image resource or false on error.
     * Author: mthorn.net
     */
    private function thumbnail($inputFileName, $uploaddir, $maxSize = 500)
    {
        $info = @getimagesize($uploaddir.$inputFileName);
        $type = isset($info['type']) ? $info['type'] : $info[2];
        // Check support of file type
        if (!(imagetypes() & $type)) {
            // Server does not support file type
            return false;
        }
        $width = isset($info['width']) ? $info['width'] : $info[0];
        $height = isset($info['height']) ? $info['height'] : $info[1];
        // Calculate aspect ratio
        $wRatio = $maxSize / $width;
        $hRatio = $maxSize / $height;
        // Using imagecreatefromstring will automatically detect the file type
        $sourceImage = imagecreatefromstring(file_get_contents($uploaddir.$inputFileName));
        // Calculate a proportional width and height no larger than the max size.
        if (($width <= $maxSize) && ($height <= $maxSize)) {
            // Input is smaller than thumbnail, do nothing
            return $sourceImage;
        } elseif (($wRatio * $height) < $maxSize) {
            // Image is horizontal
            $tHeight = ceil($wRatio * $height);
            $tWidth = $maxSize;
        } else {
            // Image is vertical
            $tWidth = ceil($hRatio * $width);
            $tHeight = $maxSize;
        }
        $thumb = imagecreatetruecolor($tWidth, $tHeight);
        if ($sourceImage === false) {
            // Could not load image
            return false;
        }
        // Copy resampled makes a smooth thumbnail
        imagecopyresampled($thumb, $sourceImage, 0, 0, 0, 0, $tWidth, $tHeight, $width, $height);
        imagedestroy($sourceImage);
        return $thumb;
    }

    /**
     * Save the image to a file. Type is determined from the extension.
     * $quality is only used for jpegs.
     * Author: mthorn.net
     */
    private function imageToFile($im, $fileName, $quality = 75)
    {
        if (!$im || file_exists($fileName)) {
            return false;
        }
        $ext = strtolower(substr($fileName, strrpos($fileName, '.')));
        switch ($ext) {
            case '.gif':
                imagegif($im, $fileName);
                break;
            case '.jpg':
            case '.jpeg':
                imagejpeg($im, $fileName, $quality);
                break;
            case '.png':
                imagepng($im, $fileName);
                break;
            case '.bmp':
                imagewbmp($im, $fileName);
                break;
            default:
                return false;
        }
        return true;
    }

    /**
     * sortNav
     *
     * Function for save the navigation by sort
     */
    public function sortNav()
    {
        $i = 0;
        $main_arrange = 1;
        $menu_id = $this->input->post('menu_id', true);
        if (!empty($menu_id)) {
            while ($i < count($menu_id)) {
                if ($menu_id[$i]) {
                    $this->db->set('arrange', $main_arrange, false);
                    $this->db->set('timestamp_update', 'NOW()', false);
                    $this->db->where("page_menu_id", $menu_id[$i]);
                    $this->db->update('page_menu');
                    $main_arrange++;
                }
                $i++;
            }
        }
        $menusub_id = $this->input->post('menusub_id', true);
        if (!empty($menusub_id)) {
            foreach (array_keys($menusub_id) as $key) {
                $sub_arrange = 1;
                for ($i = 0; $i < count($menusub_id[$key]); $i++) {
                    if ($menusub_id[$key][$i]) {
                        $this->db->set('arrange', $sub_arrange, false);
                        $this->db->set('timestamp_update', 'NOW()', false);
                        $this->db->where("page_menu_id", $menusub_id[$key][$i]);
                        $this->db->where("drop_page_menu_id", $key);
                        $this->db->update('page_menu');
                        $sub_arrange++;
                    }
                }
            }
        }
    }

    /**
     * getPagesAll
     *
     * Function for get all pages
     *
     * @return	array
     */
    public function getPagesAll()
    {
        $this->db->select("*");
        $query = $this->db->get('pages');
        if (!empty($query) && $query->num_rows() !== 0) {
            return $query->result_array();
        }
        return array();
    }

    /**
     * getPluginAll
     *
     * Function for get all plugin
     *
     * @return	array
     */
    public function getPluginAll()
    {
        $this->db->select("*");
        $this->db->where("plugin_active", 1);
        $this->db->order_by("plugin_config_filename", "asc");
        $query = $this->db->get('plugin_manager');
        if (!empty($query) && $query->num_rows() !== 0) {
            return $query->result_array();
        }
        return array();
    }

    /**
     * getAllMenu
     *
     * Function for get all menu
     *
     * @param	int	$drop_page_menu_id    1 = drop menu, 0 = main menu
     * @param	string	$lang    language code
     * @param	int	$position    menu position  0 = Top, 1 = Bottom
     * @return	object or FALSE id not found
     */
    public function getAllMenu($drop_page_menu_id = 0, $lang = '', $position = 0)
    {
        return $this->Csz_model->main_menu($drop_page_menu_id, $lang, $position, true);
    }

    /**
     * getDropMenuAll
     *
     * Function for get all drop down menu
     *
     * @return	array
     */
    public function getDropMenuAll()
    {
        $this->db->select("*");
        $this->db->where('drop_menu', 1);
        $query = $this->db->get('page_menu');
        if ($query->num_rows() !== 0) {
            return $query->result_array();
        }
        return array();
    }

    /**
     * getMenuArrange
     *
     * Function for get next number for arrange
     *
     * @param	string	$mainmenu_id    for main menu. Default is 0
     * @return	int
     */
    public function getMenuArrange($mainmenu_id = 0)
    {
        $this->db->select("*");
        if ($mainmenu_id) {
            $this->db->where('drop_menu', 0);
        }
        $this->db->where('drop_page_menu_id', $mainmenu_id);
        $query = $this->db->get('page_menu');
        return ($query->num_rows()) + 1;
    }

    /**
     * insertMenu
     *
     * Function for insert new menu
     */
    public function insertMenu()
    {
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        ($this->input->post('dropdown')) ? $dropdown = $this->input->post('dropdown', true) : $dropdown = 0;
        ($this->input->post('dropMenu')) ? $dropMenu = $this->input->post('dropMenu', true) : $dropMenu = 0;
        ($this->input->post('new_windows')) ? $new_windows = $this->input->post('new_windows', true) : $new_windows = 0;
        ($this->input->post('menuType')) ? $arrange = $this->getMenuArrange($this->input->post('dropMenu')) : $arrange = $this->getMenuArrange();
        $o_link_input = $this->input->post('url_link', true);
        if (substr($o_link_input, 0, 1) === '#') {
            $other_link = substr($o_link_input, 1);
        } else {
            $replace_arr = array('https://', 'http://');
            $other_link = str_replace($replace_arr, '', $o_link_input);
        }
        $protocal = $this->input->post('protocal', true);
        if (!$other_link) {
            $protocal = '';
        }
        $data = array(
            'menu_name' => $this->input->post('name', true),
            'lang_iso' => $this->input->post('lang_iso', true),
            'pages_id' => $this->input->post('pageUrl', true),
            'other_link' => $protocal.$other_link,
            'plugin_menu' => $this->input->post('pluginmenu', true),
            'drop_menu' => $dropdown,
            'drop_page_menu_id' => $dropMenu,
            'position' => $this->input->post('position', true),
            'new_windows' => $new_windows,
            'active' => $active,
            'arrange' => $arrange,
        );
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->insert('page_menu', $data);
    }

    /**
     * updateMenu
     *
     * Function for update the menue
     *
     * @param	string	$id    Menu id
     */
    public function updateMenu($id)
    {
        // Update the menu
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        ($this->input->post('dropdown')) ? $dropdown = $this->input->post('dropdown', true) : $dropdown = 0;
        ($this->input->post('dropMenu')) ? $dropMenu = $this->input->post('dropMenu', true) : $dropMenu = 0;
        ($this->input->post('new_windows')) ? $new_windows = $this->input->post('new_windows', true) : $new_windows = 0;
        $this->db->set('menu_name', $this->input->post("name", true), true);
        $this->db->set('lang_iso', $this->input->post("lang_iso", true), true);
        $this->db->set('pages_id', $this->input->post('pageUrl', true), true);
        $o_link_input = $this->input->post('url_link', true);
        if (substr($o_link_input, 0, 1) === '#') {
            $other_link = substr($o_link_input, 1);
        } else {
            $replace_arr = array('https://', 'http://');
            $other_link = str_replace($replace_arr, '', $o_link_input);
        }
        $protocal = $this->input->post('protocal', true);
        if (!$other_link) {
            $protocal = '';
        }
        $this->db->set('other_link', $protocal.$other_link, true);
        $this->db->set('plugin_menu', $this->input->post('pluginmenu', true), true);
        $this->db->set('drop_menu', $dropdown, true);
        $this->db->set('drop_page_menu_id', $dropMenu, true);
        $this->db->set('position', $this->input->post('position', true), true);
        $this->db->set('new_windows', $new_windows, true);
        $this->db->set('active', $active, true);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where('page_menu_id', $id);
        $this->db->update('page_menu');
    }

    /**
     * findLangDataUpdate
     *
     * Function for find the lang update. When delete Lang, wiil update all page of lang to default.
     *
     * @param	string	$lang_iso    language code
     */
    public function findLangDataUpdate($lang_iso)
    {
        $query = $this->db->get_where($table = 'pages', 'lang_iso = \''.$lang_iso.'\'');
        if ($query->num_rows() !== 0) {
            foreach ($query->result() as $rows) {
                $this->db->set('lang_iso', $this->Csz_model->getDefualtLang(), true);
                $this->db->set('timestamp_update', 'NOW()', false);
                $this->db->where("pages_id", $rows->pages_id);
                $this->db->update('pages');
            }
        }
        $query = $this->db->get_where($table = 'page_menu', 'lang_iso = \''.$lang_iso.'\'');
        if ($query->num_rows() !== 0) {
            foreach ($query->result() as $rows) {
                $this->db->set('lang_iso', $this->Csz_model->getDefualtLang(), true);
                $this->db->set('timestamp_update', 'NOW()', false);
                $this->db->where("page_menu_id", $rows->page_menu_id);
                $this->db->update('page_menu');
            }
        }
        $this->load->dbforge();
        $this->dbforge->drop_column('general_label', 'lang_'.$lang_iso);
    }

    /**
     * insertLang
     *
     * Function for create new language
     */
    public function insertLang()
    {
        $arrange = $this->Csz_model->getLastID('lang_iso', 'arrange');
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        $data = array(
            'lang_name' => $this->input->post('lang_name', true),
            'lang_iso' => $this->input->post('lang_iso', true),
            'country' => $this->input->post('country', true),
            'country_iso' => $this->input->post('country_iso', true),
            'active' => $active,
        );
        $this->db->set('arrange', ($arrange)+1);
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->insert('lang_iso', $data);
        if (!$this->db->field_exists('lang_'.$this->input->post("lang_iso", true), 'general_label')) {
            $this->load->dbforge();
            $fields = array('lang_'.$this->input->post('lang_iso', true) => array('type' => 'TEXT', 'null' => false));
            $this->dbforge->add_column('general_label', $fields);
        }
    }

    /**
     * updateLang
     *
     * Function for update the language
     *
     * @param	string	$id    language id
     */
    public function updateLang($id)
    {
        $old_lang = $this->Csz_model->getValue('lang_iso', 'lang_iso', 'lang_iso_id', $id, 1);
        $this->load->dbforge();
        if (!$this->db->field_exists('lang_'.$this->input->post("lang_iso", true), 'general_label') && $old_lang->lang_iso != $this->input->post("lang_iso", true)) {
            if ($old_lang->lang_iso != 'en') {
                $fields = array(
                    'lang_'.$old_lang->lang_iso => array(
                        'name' => 'lang_'.$this->input->post("lang_iso", true),
                        'type' => 'TEXT',
                        'null' => false,
                    ),
                );
                $this->dbforge->modify_column('general_label', $fields);
            } else {
                $fields = array('lang_'.$this->input->post('lang_iso', true) => array('type' => 'TEXT', 'null' => false));
                $this->dbforge->add_column('general_label', $fields);
            }
        } else {
            if ($old_lang->lang_iso != 'en' && $this->input->post("lang_iso", true) == 'en') {
                $this->dbforge->drop_column('general_label', 'lang_' . $old_lang->lang_iso);
            }
        }
        /* Update lang in menu */
        $this->db->set('lang_iso', $this->input->post("lang_iso", true), true);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where('lang_iso', $old_lang->lang_iso);
        $this->db->update('page_menu');
        /* Update lang in page */
        $this->db->set('lang_iso', $this->input->post("lang_iso", true), true);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where('lang_iso', $old_lang->lang_iso);
        $this->db->update('pages');

        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        $this->db->set('lang_name', $this->input->post("lang_name", true), true);
        $this->db->set('lang_iso', $this->input->post("lang_iso", true), true);
        $this->db->set('country', $this->input->post('country', true), true);
        $this->db->set('country_iso', $this->input->post('country_iso', true), true);
        if ($id != 1) {
            $this->db->set('active', $active, false);
        }
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where('lang_iso_id', $id);
        $this->db->update('lang_iso');
    }

    /**
     * syncLabelLang
     *
     * Function for synchronize the language with general label for frontend
     */
    public function syncLabelLang()
    {
        $this->load->dbforge();
        $lang = $this->Csz_model->getValueArray('lang_iso', 'lang_iso', "lang_iso != ''", '');
        $count_lang = $this->countTable('lang_iso');
        foreach ($lang as $value) {
            if ($count_lang > 1) {
                if (!$this->db->field_exists('lang_'.$value['lang_iso'], 'general_label') && $value['lang_iso']) {
                    $fields = array('lang_'.$value['lang_iso'] => array('type' => 'TEXT', 'null' => false));
                    $this->dbforge->add_column('general_label', $fields);
                }
            }
        }
    }

    /**
     * updateLabel
     *
     * Function for update the general label
     *
     * @param	string	$id    general label id
     */
    public function updateLabel($id)
    {
        $lang = $this->Csz_model->getValueArray('lang_iso', 'lang_iso', "lang_iso != ''", '');
        foreach ($lang as $value) {
            $this->db->set('lang_'.$value['lang_iso'], $this->input->post("lang_".$value['lang_iso'], true), true);
        }
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where('general_label_id', $id);
        $this->db->update('general_label');
    }

    /**
     * chkPageName
     *
     * Function for check page name
     *
     * @return	string
     */
    public function chkPageName($page_name_input)
    {
        if ($page_name_input == 'assets' || $page_name_input == 'cszcms' ||
                $page_name_input == 'install' || $page_name_input == 'photo' ||
                $page_name_input == 'system' || $page_name_input == 'templates' ||
                $page_name_input == 'search' || $page_name_input == 'admin' ||
                $page_name_input == 'ci_session' || $page_name_input == 'member' ||
                $page_name_input == 'plugin' || $page_name_input == 'link' || $page_name_input == 'banner') {
            return 'pages_'.$this->input->post('page_name', true);
        } else {
            return $page_name_input;
        }
    }

    /**
     * insertPage
     *
     * Function for create new page
     */
    public function insertPage()
    {
        $page_name_input = $this->chkPageName($this->input->post('page_name', true));
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        $page_url = $this->Csz_model->rw_link($page_name_input);
        $content2 = $this->input->post('content', false);
        $content1 = str_replace('&lt;', '<', $content2);
        $content = str_replace('&gt;', '>', $content1);
        $custom_css = str_replace(array('<style type="text/css">',"<style type='text/css'>",'<style>','</style>'), '', $this->input->post('custom_css'));
        $custom_js = str_replace(array('<script type="text/javascript">',"<script type='text/javascript'>",'<script>','</script>'), '', $this->input->post('custom_js'));
        $data = array(
            'page_name' => $page_name_input,
            'page_url' => $page_url,
            'lang_iso' => $this->input->post('lang_iso', true),
            'page_title' => $this->input->post('page_title', true),
            'page_keywords' => $this->input->post('page_keywords', true),
            'page_desc' => $this->input->post('page_desc', true),
            'content' => $content,
            'custom_css' => $custom_css,
            'custom_js' => $custom_js,
            'active' => $active,
        );
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->insert('pages', $data);
    }

    /**
     * updatePage
     *
     * Function for update the page
     *
     * @param	string	$id    page id
     */
    public function updatePage($id)
    {
        // Update the page
        $page_name_input = $this->chkPageName($this->input->post('page_name', true));
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        $page_url = $this->Csz_model->rw_link($page_name_input);
        $content2 = $this->input->post('content', false);
        $content1 = str_replace('&lt;', '<', $content2);
        $content = str_replace('&gt;', '>', $content1);
        $custom_css = str_replace(array('<style type="text/css">',"<style type='text/css'>",'<style>','</style>'), '', $this->input->post('custom_css'));
        $custom_js = str_replace(array('<script type="text/javascript">',"<script type='text/javascript'>",'<script>','</script>'), '', $this->input->post('custom_js'));
        $this->db->set('page_name', $page_name_input, true);
        $this->db->set('page_url', $page_url, true);
        $this->db->set('lang_iso', $this->input->post('lang_iso', true), true);
        $this->db->set('page_title', $this->input->post('page_title', true), true);
        $this->db->set('page_keywords', $this->input->post('page_keywords', true), true);
        $this->db->set('page_desc', $this->input->post('page_desc', true), true);
        $this->db->set('content', $content, true);
        $this->db->set('custom_css', $custom_css, true);
        $this->db->set('custom_js', $custom_js, true);
        if ($id != 1) {
            $this->db->set('active', $active, false);
        }
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where('pages_id', $id);
        $this->db->update('pages');
        $this->Csz_model->clear_uri_cache($this->config->item('base_url').urldecode($page_url));
        $this->Csz_model->clear_file_cache('file_'.$this->Csz_model->encodeURL($page_url));
    }

    /**
     * insertFileUpload
     *
     * Function for insert the file upload into db
     *
     * @param	string	$year    year
     * @param	string	$fileupload    file name from file_upload function
     */
    public function insertFileUpload($year, $fileupload)
    {
        $data = array(
            'year' => $year,
            'file_upload' => $fileupload,
        );
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->insert('upload_file', $data);
    }

    /**
     * insertForms
     *
     * Function for insert the forms
     */
    public function insertForms()
    {
        $this->load->dbforge();
        // Create the new forms
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        ($this->input->post('sendmail')) ? $sendmail = $this->input->post('sendmail', true) : $sendmail = 0;
        ($this->input->post('captcha')) ? $captcha = $this->input->post('captcha', true) : $captcha = 0;
        ($this->input->post('send_to_visitor')) ? $send_to_visitor = $this->input->post('send_to_visitor', true) : $send_to_visitor = 0;
        $str_arr = array(' ', '-');
        $form_name = str_replace($str_arr, '_', strtolower($this->input->post('form_name', true)));
        $data = array(
            'form_name' => $form_name,
            'form_enctype' => $this->input->post('form_enctype', true),
            'form_method' => $this->input->post('form_method', true),
            'success_txt' => $this->input->post('success_txt', true),
            'captchaerror_txt' => $this->input->post('captchaerror_txt', true),
            'error_txt' => $this->input->post('error_txt', true),
            'sendmail' => $sendmail,
            'email' => $this->input->post('email', true),
            'subject' => $this->input->post('subject', true),
            'send_to_visitor' => $send_to_visitor,
            'active' => $active,
            'captcha' => $captcha,
        );
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->insert('form_main', $data);
        $form_main_id = $this->db->insert_id();

        $field_name = $this->input->post('field_name', true);
        $field_type = $this->input->post('field_type', true);
        $field_id = $this->input->post('field_id', true);
        $field_class = $this->input->post('field_class', true);
        $field_placeholder = $this->input->post('field_placeholder', true);
        $field_value = $this->input->post('field_value', true);
        $field_label = $this->input->post('field_label', true);
        $sel_option_val = $this->input->post('sel_option_val', true);
        $field_required = $this->input->post('field_required', true);
        $fields = array(
            'form_'.$form_name.'_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ),
        );
        $this->dbforge->add_field($fields);
        if (count($field_name) > 0) {
            for ($i = 0; $i < count($field_name); $i++) {
                if ($field_name[$i]) {
                    $data = array(
                        'form_main_id' => $form_main_id,
                        'field_type' => $field_type[$i],
                        'field_name' => $field_name[$i],
                        'field_id' => $field_id[$i],
                        'field_class' => $field_class[$i],
                        'field_placeholder' => $field_placeholder[$i],
                        'field_value' => $field_value[$i],
                        'field_label' => $field_label[$i],
                        'sel_option_val' => $sel_option_val[$i],
                        'field_required' => $field_required[$i],
                    );
                    $this->db->set('timestamp_create', 'NOW()', false);
                    $this->db->set('timestamp_update', 'NOW()', false);
                    $this->db->insert('form_field', $data);
                    $fields = $this->preTypeFields($field_type[$i], $field_name[$i]);
                    $this->dbforge->add_field($fields);
                }
            }
        }
        $fields = array(
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'timestamp_create' => array(
                'type' => 'datetime'
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('form_'.$form_name.'_id', true);
        $attributes = array('ENGINE' => 'MyISAM', 'CHARACTER SET' => 'utf8', 'COLLATE' => 'utf8_general_ci', ' AUTO_INCREMENT' => '1');
        $this->dbforge->create_table('form_'.$form_name, true, $attributes);
    }

    /**
     * updateForms
     *
     * Function for update the form
     *
     * @param	string	$id    form id
     */
    public function updateForms($id)
    {
        $this->load->dbforge();
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        ($this->input->post('sendmail')) ? $sendmail = $this->input->post('sendmail', true) : $sendmail = 0;
        ($this->input->post('captcha')) ? $captcha = $this->input->post('captcha', true) : $captcha = 0;
        ($this->input->post('send_to_visitor')) ? $send_to_visitor = $this->input->post('send_to_visitor', true) : $send_to_visitor = 0;
        $str_arr = array(' ', '-');
        $form_name = str_replace($str_arr, '_', strtolower($this->input->post('form_name', true)));
        $data = array(
            'form_name' => $form_name,
            'form_enctype' => $this->input->post('form_enctype', true),
            'form_method' => $this->input->post('form_method', true),
            'success_txt' => $this->input->post('success_txt', true),
            'captchaerror_txt' => $this->input->post('captchaerror_txt', true),
            'error_txt' => $this->input->post('error_txt', true),
            'sendmail' => $sendmail,
            'email' => $this->input->post('email', true),
            'subject' => $this->input->post('subject', true),
            'send_to_visitor' => $send_to_visitor,
            'email_field_id' => $this->input->post('email_field_id', true),
            'visitor_subject' => $this->input->post('visitor_subject', true),
            'visitor_body' => $this->input->post('visitor_body', true),
            'active' => $active,
            'captcha' => $captcha,
        );
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where('form_main_id', $id);
        $this->db->update('form_main', $data);
        /* Rename Field */
        $form_field_id = $this->input->post('form_field_id', true);
        $field_name1 = $this->input->post('field_name1', true);
        $field_oldname = $this->input->post('field_oldname', true);
        $field_oldtype = $this->input->post('field_oldtype', true);
        $field_type1 = $this->input->post('field_type1', true);
        $field_id1 = $this->input->post('field_id1', true);
        $field_class1 = $this->input->post('field_class1', true);
        $field_placeholder1 = $this->input->post('field_placeholder1', true);
        $field_value1 = $this->input->post('field_value1', true);
        $field_label1 = $this->input->post('field_label1', true);
        $sel_option_val1 = $this->input->post('sel_option_val1', true);
        $field_required1 = $this->input->post('field_required1', true);
        if (count($field_oldname) > 0) {
            for ($i = 0; $i < count($field_oldname); $i++) {
                if ($field_oldname[$i]) {
                    $data = array(
                        'form_main_id' => $id,
                        'field_type' => $field_type1[$i],
                        'field_name' => $field_name1[$i],
                        'field_id' => $field_id1[$i],
                        'field_class' => $field_class1[$i],
                        'field_placeholder' => $field_placeholder1[$i],
                        'field_value' => $field_value1[$i],
                        'field_label' => $field_label1[$i],
                        'sel_option_val' => $sel_option_val1[$i],
                        'field_required' => $field_required1[$i],
                    );
                    $this->db->set('timestamp_update', 'NOW()', false);
                    $this->db->where('form_field_id', $form_field_id[$i]);
                    $this->db->update('form_field', $data);
                    if ($field_oldname[$i] != $field_name1[$i]) {
                        if ($field_oldtype[$i] != 'button' && $field_oldtype[$i] != 'reset' && $field_oldtype[$i] != 'submit' && $field_oldtype[$i] != 'label') {
                            if ($field_type1[$i] == 'button' || $field_type1[$i] == 'reset' || $field_type1[$i] == 'submit' || $field_type1[$i] == 'label') {
                                $this->dbforge->drop_column('form_'.$form_name, $field_oldname[$i]);
                            } else {
                                $fields = $this->renameFields($field_type1[$i], $field_oldname[$i], $field_name1[$i]);
                                $this->dbforge->modify_column('form_'.$form_name, $fields);
                            }
                        } else {
                            if ($field_type1[$i] != 'button' && $field_type1[$i] != 'reset' && $field_type1[$i] != 'submit' && $field_type1[$i] != 'label') {
                                $fields = $this->preTypeFields($field_type1[$i], $field_name1[$i]);
                                $this->dbforge->add_column('form_'.$form_name, $fields);
                            }
                        }
                    }
                }
            }
        }

        /* Add New Field */
        $field_name = $this->input->post('field_name', true);
        $field_type = $this->input->post('field_type', true);
        $field_id = $this->input->post('field_id', true);
        $field_class = $this->input->post('field_class', true);
        $field_placeholder = $this->input->post('field_placeholder', true);
        $field_value = $this->input->post('field_value', true);
        $field_label = $this->input->post('field_label', true);
        $sel_option_val = $this->input->post('sel_option_val', true);
        $field_required = $this->input->post('field_required', true);
        if (count($field_name) > 0) {
            for ($i = 0; $i < count($field_name); $i++) {
                if ($field_name[$i]) {
                    $data = array(
                        'form_main_id' => $id,
                        'field_type' => $field_type[$i],
                        'field_name' => $field_name[$i],
                        'field_id' => $field_id[$i],
                        'field_class' => $field_class[$i],
                        'field_placeholder' => $field_placeholder[$i],
                        'field_value' => $field_value[$i],
                        'field_label' => $field_label[$i],
                        'sel_option_val' => $sel_option_val[$i],
                        'field_required' => $field_required[$i],
                    );
                    $this->db->set('timestamp_create', 'NOW()', false);
                    $this->db->set('timestamp_update', 'NOW()', false);
                    $this->db->insert('form_field', $data);
                    $fields = $this->preTypeFields($field_type[$i], $field_name[$i]);
                    $this->dbforge->add_column('form_'.$form_name, $fields);
                }
            }
        }
        $this->Csz_model->clear_all_cache();
    }

    /**
     * preTypeFields
     *
     * Function for prepare the field type
     *
     * @param	string	$type    field type
     * @param	string	$name    field name
     * @return  array
     */
    public function preTypeFields($type, $name)
    {
        $fields = array();
        switch ($type) {
            case 'checkbox':
                $fields = array(
                    $name => array(
                        'type' => 'INT',
                        'null' => true,
                        'constraint' => 11
                    ),
                );
                break;
            case 'datepicker':
                $fields = array(
                    $name => array(
                        'type' => 'DATE',
                        'null' => true,
                    ),
                );
                break;
            case 'email':
            case 'password':
            case 'radio':
            case 'selectbox':
            case 'text':
                $fields = array(
                    $name => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => true,
                    ),
                );
                break;
            case 'textarea':
                $fields = array(
                    $name => array(
                        'type' => 'TEXT',
                        'null' => true,
                    ),
                );
                break;
            default:
                break;
        }
        return $fields;
    }

    /**
     * renameFields
     *
     * Function for rename the field
     *
     * @param	string	$type    field type
     * @param	string	$oldname   old field name
     * @param	string	$newname   new field name
     * @return  array
     */
    public function renameFields($type, $oldname, $newname)
    {
        $fields = array();
        switch ($type) {
            case 'checkbox':
                $fields = array(
                    $oldname => array(
                        'name' => $newname,
                        'type' => 'INT',
                        'null' => true,
                        'constraint' => 11
                    ),
                );
                break;
            case 'datepicker':
                $fields = array(
                    $oldname => array(
                        'name' => $newname,
                        'type' => 'DATE',
                        'null' => true,
                    ),
                );
                break;
            case 'email':
            case 'password':
            case 'radio':
            case 'selectbox':
            case 'text':
                $fields = array(
                    $oldname => array(
                        'name' => $newname,
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => true,
                    ),
                );
                break;
            case 'textarea':
                $fields = array(
                    $oldname => array(
                        'name' => $newname,
                        'type' => 'TEXT',
                        'null' => true,
                    ),
                );
                break;
            default:
                break;
        }
        return $fields;
    }

    /**
     * execSqlFile
     *
     * Function for import the sql file into db
     *
     * @param	string	$sql_file    sql file path
     * @return  FALSE if sql file not found
     */
    public function execSqlFile($sql_file)
    {
        if (file_exists($sql_file)) {
            $db_debug = $this->db->db_debug;
            $this->db->db_debug = false;
            $this->load->helper('file');
            $backup = read_file($sql_file);
            $sql1 = preg_replace('#/\*.*?\*/#s', '', $backup);
            $sql2 = preg_replace('/^-- .*[\r\n]*/m', '', $sql1);
            $sqls = explode(';', $sql2);
            array_pop($sqls);
            $i = 0;
            foreach ($sqls as $statement) {
                if (trim($statement) != null) {
                    $sql = trim($statement).";";
                    $this->db->query(trim($sql));
                    if ($i >= 5000) { /* When 5000 query. Is sleep 5 sec. */
                        sleep(5);
                        $i = 0;
                    }
                    $i++;
                }
            }
            $this->db->db_debug = $db_debug;
        } else {
            return false;
        }
    }

    /**
     * chkPluginActive
     *
     * Function for check the plugin is active
     *
     * @param	string	$plugin_config_filename    plugin config filename
     * @return  TRUE or FALSE
     */
    public function chkPluginActive($plugin_config_filename)
    {
        if ($plugin_config_filename) {
            $status = $this->Csz_model->getValue('plugin_active', 'plugin_manager', "plugin_config_filename", $plugin_config_filename, 1);
            if ($status->plugin_active) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * insertWidget
     *
     * Function for insert the new widget
     */
    public function insertWidget()
    {
        // Create the new lang
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        $data = array(
            'widget_name' => $this->input->post('widget_name', true),
            'xml_url' => $this->input->post('xml_url', true),
            'limit_view' => $this->input->post('limit_view', true),
            'active' => $active,
            'widget_open' => $this->input->post('widget_open', true),
            'widget_content' => $this->input->post('widget_content', true),
            'widget_seemore' => $this->input->post('widget_seemore', true),
            'widget_close' => $this->input->post('widget_close', true),
        );
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->insert('widget_xml', $data);
    }

    /**
     * updateWidget
     *
     * Function for update the widget
     *
     * @param	string	$id    widget id
     */
    public function updateWidget($id)
    {
        // Update the lang
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        $this->db->set('widget_name', $this->input->post("widget_name", true));
        $this->db->set('xml_url', $this->input->post("xml_url", true));
        $this->db->set('limit_view', $this->input->post('limit_view', true));
        $this->db->set('active', $active);
        $this->db->set('widget_open', $this->input->post('widget_open', true));
        $this->db->set('widget_content', $this->input->post('widget_content', true));
        $this->db->set('widget_seemore', $this->input->post('widget_seemore', true));
        $this->db->set('widget_close', $this->input->post('widget_close', true));
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where('widget_xml_id', $id);
        $this->db->update('widget_xml');
        $this->Csz_model->clear_file_cache('widget_'.$this->Csz_model->encodeURL($this->input->post("widget_name", true)));
    }

    /**
     * insertLinks
     *
     * Function for insert the new widget
     */
    public function insertLinks()
    {
        // Create the new links
        $this->db->set('url', $this->input->post('url', true));
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->insert('link_stat_mgt');
    }

    /**
     * updateBFSettings
     *
     * Function for update the Brute Force Protection settings
     */
    public function updateBFSettings()
    {
        $this->db->set('bf_protect_period', $this->input->post("bf_protect_period", true));
        $this->db->set('max_failure', $this->input->post("max_failure", true));
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where("login_security_config_id", 1);
        $this->db->update('login_security_config');
    }

    /**
     * saveWhiteIP
     *
     * Function for insert the new whitelist IP Address
     */
    public function saveWhiteIP()
    {
        $ip_address = $this->input->post('ip_address', true);
        if ($this->Csz_model->chkBFwhitelistIP($ip_address) === false && !empty($ip_address)) {
            $data = array(
                'ip_address' => $ip_address,
                'note' => $this->input->post('note', true),
            );
            $this->db->set('timestamp_create', 'NOW()', false);
            $this->db->insert('whitelist_ip', $data);
            $this->removeData('blacklist_ip', 'ip_address', $ip_address);
            $this->db->cache_delete_all();
        }
    }

    /**
     * saveBlackIP
     *
     * Function for insert the new blacklist IP Address
     */
    public function saveBlackIP()
    {
        $ip_address = $this->input->post('ip_address', true);
        if ($this->Csz_model->chkBFblacklistIP($ip_address) === false && !empty($ip_address)) {
            $data = array(
                'ip_address' => $ip_address,
                'note' => $this->input->post('note', true),
            );
            $this->db->set('timestamp_create', 'NOW()', false);
            $this->db->insert('blacklist_ip', $data);
            $this->removeData('whitelist_ip', 'ip_address', $ip_address);
            $this->db->cache_delete_all();
        }
    }

    /**
     * insertBanner
     *
     * Function for insert the new banner
     */
    public function insertBanner()
    {
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        ($this->input->post('nofollow')) ? $nofollow = $this->input->post('nofollow', true) : $nofollow = 0;
        $upload_file = '';
        if ($_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif') {
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/banner/';
            $file_f = $_FILES['file_upload']['tmp_name'];
            $file_name = $_FILES['file_upload']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        $data = array(
            'name' => $this->input->post('name', true),
            'img_path' => $upload_file,
            'width' => $this->input->post('width', true),
            'height' => $this->input->post('height', true),
            'link' => $this->input->post('link', true),
            'start_date' => $this->input->post('start_date', true),
            'end_date' => $this->input->post('end_date', true),
            'mobile_flag' => $this->input->post('mobile_flag', true),
            'nofollow' => $nofollow,
            'active' => $active,
            'note' => $this->input->post('note', true),
        );
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->insert('banner_mgt', $data);
    }

    /**
     * updateBanner
     *
     * Function for update the banner
     *
     * @param	string	$id    banner id
     */
    public function updateBanner($id)
    {
        ($this->input->post('active')) ? $active = $this->input->post('active', true) : $active = 0;
        ($this->input->post('nofollow')) ? $nofollow = $this->input->post('nofollow', true) : $nofollow = 0;
        if ($this->input->post('del_file')) {
            $upload_file = '';
            @unlink('photo/banner/'.$this->input->post('del_file', true));
        } else {
            $upload_file = $this->input->post('picture');
            if ($_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif') {
                $paramiter = '_1';
                $photo_id = time();
                $uploaddir = 'photo/banner/';
                $file_f = $_FILES['file_upload']['tmp_name'];
                $file_name = $_FILES['file_upload']['name'];
                $upload_file = $this->file_upload($file_f, $file_name, $this->input->post('picture', true), $uploaddir, $photo_id, $paramiter);
            }
        }
        $data = array(
            'name' => $this->input->post('name', true),
            'img_path' => $upload_file,
            'width' => $this->input->post('width', true),
            'height' => $this->input->post('height', true),
            'link' => $this->input->post('link', true),
            'start_date' => $this->input->post('start_date', true),
            'end_date' => $this->input->post('end_date', true),
            'mobile_flag' => $this->input->post('mobile_flag', true),
            'nofollow' => $nofollow,
            'active' => $active,
            'note' => $this->input->post('note', true),
        );
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where('banner_mgt_id', $id);
        $this->db->update('banner_mgt', $data);
    }

    /**
     * saveActionsLogs
     *
     * Function for save the login log into database
     *
     * @param	string	$url    current url
     * @param	string	$actions    actions text
     * @param	string	$note    note text
     */
    public function saveActionsLogs($url, $actions, $note = '')
    {
        $data = array(
            'email_login' => $this->session->userdata('admin_email'),
            'note' => $note,
            'url' => $url,
            'actions' => $actions,
        );
        $this->db->set('user_agent', $this->input->user_agent(), true);
        $this->db->set('ip_address', $this->input->ip_address(), true);
        $this->db->set('timestamp_create', 'NOW()', false);
        $this->db->insert('actions_logs', $data);
        unset($data);
    }

    /**
     * setMaintenance
     *
     * Function for set the maintenance mode on frontend
     *
     */
    public function setMaintenance()
    {
        $data = array('maintenance_active' => 1);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where("settings_id", 1);
        $this->db->update('settings', $data);
        $this->db->cache_delete_all();
        $this->Csz_model->clear_file_cache('config');
        $this->Csz_model->clear_file_cache('topmenu_*', true);
    }

    /**
     * unsetMaintenance
     *
     * Function for unset the maintenance mode on frontend
     *
     */
    public function unsetMaintenance()
    {
        $data = array('maintenance_active' => 0);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where("settings_id", 1);
        $this->db->update('settings', $data);
        $this->db->cache_delete_all();
        $this->Csz_model->clear_file_cache('config');
        $this->Csz_model->clear_file_cache('topmenu_*', true);
    }

    /**
     * getFormDraft
     *
     * Function for get data from form draft
     *
     * @return	Object or FALSE
     */
    public function getFormDraft()
    {
        $this->db->select("*");
        $this->db->where("form_url", current_url());
        $this->db->where('user_admin_id', $this->session->userdata('user_admin_id'));
        $this->db->limit(1);
        $query = $this->db->get('save_formdraft');
        if (!empty($query) && $query->num_rows() === 1) {
            $data = $query->first_row();
            return json_decode(base64_decode($data->submit_array), true);
        } else {
            return false;
        }
    }

    /**
     * getFormDraft
     *
     * Function for get data from form draft
     *
     * @return	Object or FALSE
     */
    public function getDraftArray($array_key)
    {
        $data = $this->getFormDraft();
        if ($data !== false && is_array($data) && isset($data[$array_key])) {
            return $data[$array_key];
        } else {
            return '';
        }
    }

    /**
     * getSaveDraftJS
     *
     * Function for get data from form draft
     *
     * @return	String
     */
    public function getSaveDraftJS()
    {
        $more_js = '
        $(document).ready(function () {
            $("#save_draft").click(function () {
                tinyMCE.triggerSave(); /* save TinyMCE instances before serialize */
                var fields = $("form").serialize();
                var urlpost = "'.$this->Csz_model->base_link().'/admin/admin/saveDraft'.'";
                $.ajax({
                    url: urlpost,
                    type: "POST",
                    data: fields,
                    success: function (a) {
                        if(a == "SUCCESS"){
                            $("#save_draft_res").html("'.$this->lang->line('success_message_alert').'");
                        }else{
                            $("#save_draft_res").html("");
                        }
                    }
                });
                return false;
            });
        });';
        return $more_js;
    }

    /**
     * makePrivateKey
     *
     * Function for make private key from db
     *
     */
    public function makePrivateKey()
    {
        $row = $this->load_config();
        $user = $this->getUser(1);
        $gmdate = gmdate("YmdHis", time());
        $private_key = sha1($row->default_email . '|' . $this->Csz_model->base_link() . '|' . $user->password . '|cszcms|' . $gmdate);
        $this->db->set('bf_private_key', $private_key);
        $this->db->set('timestamp_update', 'NOW()', false);
        $this->db->where("login_security_config_id", 1);
        $this->db->update('login_security_config');
    }

    /**
     * getPrivateKey
     *
     * Function for get private key from db
     *
     * @return	String
     */
    public function getPrivateKey()
    {
        $this->db->select('bf_private_key');
        $this->db->where("login_security_config_id", '1');
        $this->db->limit(1, 0);
        $query = $this->db->get("login_security_config");
        if (!empty($query) && $query->num_rows() !== 0) {
            $private_key = $query->row()->bf_private_key;
            if (!empty($private_key) && $private_key != null) {
                return $private_key;
            } else {
                return '-';
            }
        } else {
            return '-';
        }
    }

    /**
     * getPluginXML
     *
     * Function for get latest version from xml url
     *
     * @param	string	$xml_url    xml url file
     * @return	object or FALSE
     */
    public function getPluginXML($xml_url = '')
    {
        $this->load->driver('cache', array('adapter' => 'file'));
        if (!$this->cache->get('plugin_list_xml')) {
            if (!$xml_url) {
                $xml_url = $this->config->item('csz_pluginxmlurl_main');
            }
            $xml_url_bak = $this->config->item('csz_pluginxmlurl_backup');
            if ($this->Csz_model->is_url_exist($xml_url) !== false) {
                $xml = file_get_contents($xml_url);
            } elseif ($this->Csz_model->is_url_exist($xml_url) === false && $this->Csz_model->is_url_exist($xml_url_bak) !== false) {
                $xml = file_get_contents($xml_url_bak);
            } else {
                $xml = false;
            }
            if (!empty($xml) && $xml !== false) {
                $return = &$xml;
            } else {
                $return = false;
            }
            ($this->load_config()->pagecache_time == 0) ? $cache_time = 1 : $cache_time = $this->load_config()->pagecache_time;
            $this->cache->save('plugin_list_xml', $return, ($cache_time * 60));
        }
        return simplexml_load_string($this->cache->get('plugin_list_xml'));
    }

    /**
     * getLatestVerArray
     *
     * Function for get latest version from xml url
     *
     * @return	array
     */
    private function setLatestVer()
    {
        $this->load->driver('cache', array('adapter' => 'file'));
        if (!$this->cache->get('plugin_list_version')) {
            $plugin_list = $this->getPluginXML();
            if ($plugin_list !== false) {
                $ver_arr = array();
                foreach ($plugin_list as $xml) {
                    $ver_arr[strval($xml->filename)] = strval($xml->version);
                }
            } else {
                $ver_arr = false;
            }
            ($this->load_config()->pagecache_time == 0) ? $cache_time = 1 : $cache_time = $this->load_config()->pagecache_time;
            $this->cache->save('plugin_list_version', $ver_arr, ($cache_time * 60));
        }
        return $this->cache->get('plugin_list_version');
    }

    /**
     * pluginLatestVer
     *
     * Function for get latest version from xml url
     *
     * @param	string	$plugin_config_filename    for plugin config filename
     * @return	String or FALSE
     */
    public function pluginLatestVer($plugin_config_filename)
    {
        $ver_arr = $this->setLatestVer();
        if ($ver_arr !== false && is_array($ver_arr)) {
            return $ver_arr[strval($plugin_config_filename)];
        } else {
            return false;
        }
    }

    /**
     * chkPluginInst
     *
     * Function for get latest version from xml url
     *
     * @param	string	$plugin_config_filename    for plugin config filename
     * @return	TRUE or FALSE
     */
    public function chkPluginInst($plugin_config_filename)
    {
        $count = $this->Csz_model->countData('plugin_manager', "plugin_config_filename = '".$plugin_config_filename."'");
        if ($count != 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * chkPluginUpdate
     *
     * Function for check version for plugin update
     *
     * @param	string	$cur_ver    current version
     * @param	string	$last_ver    latest version
     * @return	true or false
     */
    public function chkPluginUpdate($cur_ver, $last_ver)
    {
        return $this->Csz_model->chkVerUpdate($cur_ver, $last_ver);
    }

    /**
     * pluginNextVer
     *
     * Function for check next version for plugin update
     *
     * @param	string	$cur_txt    current version
     * @param	string	$last_ver    latest version
     * @return	string or false
     */
    public function pluginNextVer($cur_txt, $last_ver)
    {
        return $this->Csz_model->findNextVersion($cur_txt, $last_ver);
    }
}
