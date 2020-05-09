<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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

class Article_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert() {
        // Create the new lang
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        ($this->input->post('fb_comment_active')) ? $fb_comment_active = $this->input->post('fb_comment_active', TRUE) : $fb_comment_active = 0;
        $upload_file = '';
        if ($_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif') {
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/plugin/article/';
            $file_f = $_FILES['file_upload']['tmp_name'];
            $file_name = $_FILES['file_upload']['name'];
            $upload_file = $this->Csz_admin_model->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        $upload_file1 = '';
        if ($_FILES['file_upload_pdf']['type'] == 'application/pdf') {
            $paramiter1 = '_1';
            $photo_id1 = time();
            $uploaddir1 = 'photo/plugin/article/';
            $file_f1 = $_FILES['file_upload_pdf']['tmp_name'];
            $file_name1 = $_FILES['file_upload_pdf']['name'];
            $upload_file1 = $this->Csz_admin_model->file_upload($file_f1, $file_name1, '', $uploaddir1, $photo_id1, $paramiter1);
        }
        
        $data = array(
            'main_picture' => $upload_file,
            'brochure_path' => $upload_file1,
            'title' => $this->input->post('title', TRUE),
            'keyword' => $this->input->post('keyword', TRUE),
            'video_url' => $this->input->post('video_url', TRUE),
            'short_desc' => $this->input->post('short_desc', TRUE),
            'content' => str_replace(' class="container"', '', $this->input->post('content', FALSE)),
            'cat_id' => $this->input->post('cat_id', TRUE),
        );
        $url_rewrite = $this->Csz_model->rw_link($this->input->post('title', TRUE));
        $this->db->set('url_rewrite', $url_rewrite);
        $this->db->set('lang_iso', $this->input->post('lang_iso', TRUE));
        $this->db->set('is_category', 0);
        $this->db->set('active', $active);
        $this->db->set('fb_comment_active', $fb_comment_active);
        $this->db->set('fb_comment_limit', $this->input->post('fb_comment_limit', TRUE));
        $this->db->set('fb_comment_sort', $this->input->post('fb_comment_sort', TRUE));
        $this->db->set('user_admin_id', $this->session->userdata('user_admin_id'));
        $this->db->set('timestamp_create', 'NOW()', FALSE);
        $this->db->set('timestamp_update', 'NOW()', FALSE);
        $this->db->insert('article_db', $data);
    }

    public function insertCat() {
        // Create the new lang
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        $arrange = $this->Csz_model->getLastID('article_db', 'arrange', "is_category = '1'");
        $data = array(
            'category_name' => $this->input->post('category_name', TRUE),
            'main_cat_id' => $this->input->post('main_cat_id', TRUE),
        );
        $url_rewrite = $this->Csz_model->rw_link($this->input->post('category_name', TRUE));
        $this->db->set('url_rewrite', $url_rewrite);
        $this->db->set('lang_iso', $this->input->post('lang_iso', TRUE));
        $this->db->set('is_category', 1);
        $this->db->set('active', $active);
        $this->db->set('user_admin_id', $this->session->userdata('user_admin_id'));
        $this->db->set('arrange', ($arrange)+1);
        $this->db->set('timestamp_create', 'NOW()', FALSE);
        $this->db->set('timestamp_update', 'NOW()', FALSE);
        $this->db->insert('article_db', $data);
    }

    public function artupdate($id) {
        $row = $this->Csz_model->getValue('is_category', 'article_db', 'article_db_id', $id, 1);
        if(!$row->is_category){
            ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
            ($this->input->post('fb_comment_active')) ? $fb_comment_active = $this->input->post('fb_comment_active', TRUE) : $fb_comment_active = 0;
            if ($this->input->post('del_file')) {
                $upload_file = '';
                @unlink('photo/plugin/article/' . $this->input->post('del_file', TRUE));
            } else {
                $upload_file = $this->input->post('mainPicture');
                if ($_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg') {
                    $paramiter = '_1';
                    $photo_id = time();
                    $uploaddir = 'photo/plugin/article/';
                    $file_f = $_FILES['file_upload']['tmp_name'];
                    $file_name = $_FILES['file_upload']['name'];
                    $upload_file = $this->Csz_admin_model->file_upload($file_f, $file_name, $this->input->post('siteLogo', TRUE), $uploaddir, $photo_id, $paramiter);
                }
            }
            if ($this->input->post('del_file1')) {
                $upload_file1 = '';
                @unlink('photo/plugin/article/' . $this->input->post('del_file1', TRUE));
            } else {
                $upload_file1 = $this->input->post('brochure_path');
                if ($_FILES['file_upload_pdf']['type'] == 'application/pdf') {
                    $paramiter1 = '_1';
                    $photo_id1 = time();
                    $uploaddir1 = 'photo/plugin/article/';
                    $file_f1 = $_FILES['file_upload_pdf']['tmp_name'];
                    $file_name1 = $_FILES['file_upload_pdf']['name'];
                    $upload_file1 = $this->Csz_admin_model->file_upload($file_f1, $file_name1, $this->input->post('siteLogo', TRUE), $uploaddir1, $photo_id1, $paramiter1);
                }
            }
            $data = array(
                'main_picture' => $upload_file,
                'brochure_path' => $upload_file1,
                'title' => $this->input->post('title', TRUE),
                'keyword' => $this->input->post('keyword', TRUE),
                'video_url' => $this->input->post('video_url', TRUE),
                'short_desc' => $this->input->post('short_desc', TRUE),
                'content' => str_replace(' class="container"', '', $this->input->post('content', FALSE)),
                'cat_id' => $this->input->post('cat_id', TRUE),
            );
            $url_rewrite = $this->Csz_model->rw_link($this->input->post('title', TRUE));
            $this->Csz_model->clear_uri_cache($this->config->item('base_url') . urldecode('plugin/article/view/' . $id . '/' . $this->Csz_model->getValue('url_rewrite', 'article_db', "article_db_id", $id, 1)->url_rewrite)); /* Clear Page Cache when update */
            $this->db->set('url_rewrite', $url_rewrite);
            $this->db->set('lang_iso', $this->input->post('lang_iso', TRUE));
            $this->db->set('active', $active);
            $this->db->set('fb_comment_active', $fb_comment_active);
            $this->db->set('fb_comment_limit', $this->input->post('fb_comment_limit', TRUE));
            $this->db->set('fb_comment_sort', $this->input->post('fb_comment_sort', TRUE));
            $this->db->set('timestamp_update', 'NOW()', FALSE);
            $this->db->where("article_db_id", $id);
            $this->db->update('article_db', $data);
        }
    }

    public function catupdate($id) {
        $row = $this->Csz_model->getValue('is_category', 'article_db', 'article_db_id', $id, 1);
        if($row->is_category){
            ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
            $data = array(
                'category_name' => $this->input->post('category_name', TRUE),
                'main_cat_id' => $this->input->post('main_cat_id', TRUE),
            );
            $url_rewrite = $this->Csz_model->rw_link($this->input->post('category_name', TRUE));
            $this->db->set('url_rewrite', $url_rewrite);
            $this->db->set('lang_iso', $this->input->post('lang_iso', TRUE));
            $this->db->set('active', $active);
            $this->db->set('timestamp_update', 'NOW()', FALSE);
            $this->db->where("article_db_id", $id);
            $this->db->update('article_db', $data);
        }
    }

    public function delete($id) {
        if ($id) {
            $row = $this->Csz_model->getValue('*', 'article_db', 'article_db_id', $id, 1);
            if ($row->is_category) {
                if (!$row->main_cat_id) {
                    $this->db->set('main_cat_id', 0);
                    $this->db->set('timestamp_update', 'NOW()', FALSE);
                    $this->db->where('main_cat_id', $id);
                    $this->db->update('article_db');
                }
                $this->db->set('cat_id', 0);
                $this->db->set('timestamp_update', 'NOW()', FALSE);
                $this->db->where('cat_id', $id);
                $this->db->update('article_db');
            }else{
                @unlink('photo/plugin/article/' . $row->main_picture);
            }
            $this->Csz_admin_model->removeData('article_db', 'article_db_id', $id);
        } else {
            return FALSE;
        }
    }

    private function AdminMenuActive($menu_page, $cur_page, $addeditdel = '') {
        /* $addeditdel = 'cat'; //Example: catNew, catEdit, catDel etc. */
        if ($menu_page == $cur_page || ($addeditdel != '' && strpos($cur_page, $addeditdel) !== false)) {
            $active = ' class="active"';
        } else {
            $active = "";
        }
        return $active;
    }

    public function AdminMenu() {
        $cur_page = $this->uri->segment(4);
        $html = '<nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="' . $this->Csz_model->base_link(). '/admin/plugin/article">' . $this->lang->line('nav_dash') . '</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li' . $this->AdminMenuActive('category', $cur_page, 'cat') . '><a href="' . $this->Csz_model->base_link(). '/admin/plugin/article/category">' . $this->lang->line('category_header') . '</a></li>
                        <li' . $this->AdminMenuActive('article', $cur_page, 'art') . '><a href="' . $this->Csz_model->base_link(). '/admin/plugin/article/article">' . $this->lang->line('article_header') . '</a></li>                      
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>';
        return $html;
    }

    public function categoryMenu($lang_iso) {
        $maincat = $this->Csz_model->getValueArray('*', 'article_db', "is_category = '1' AND active = '1' AND main_cat_id = '0' AND lang_iso = '" . $lang_iso . "'", '', 0, 'arrange', 'ASC');
        $html = '<div class="panel panel-primary">
                <div class="panel-body">
                    <form action="' . $this->Csz_model->base_link(). '/plugin/article/search" name="searchfrm" id="searchfrm" method="get" style="margin:0px; padding:0px;">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-search"></i></span>
                        <input type="text" class="form-control" placeholder="' . $this->Csz_model->getLabelLang('article_search_txt') . '" name="p" value="' . $this->Csz_model->cleanOSCommand($this->input->get('p' ,TRUE)) . '">
                    </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading"><b><i class="glyphicon glyphicon-menu-hamburger"></i> ' . $this->Csz_model->getLabelLang('article_category_menu') . '</b></div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">';
        $html.= '<li role="presentation" class="text-left"><a href="' . $this->Csz_model->base_link(). '/plugin/article"><b><i class="glyphicon glyphicon-home"></i> ' . $this->Csz_model->getLabelLang('article_index_header') . '</b></a></li>';
        if ($maincat === FALSE) {
            $html.= '<li role="presentation" class="text-left"><a><b>' . $this->Csz_model->getLabelLang('article_cat_not_found') . '</b></a></li>';
        } else {
            foreach ($maincat as $mc) {
                $html.= '<li role="presentation" class="text-left"><a href="' . $this->Csz_model->base_link(). '/plugin/article/category/' . $mc['url_rewrite'] . '"><b><i class="glyphicon glyphicon-triangle-bottom"></i> ' . $mc['category_name'] . '</b></a></li>';
                $subcat = $this->Csz_model->getValueArray('*', 'article_db', "is_category = '1' AND active = '1' AND main_cat_id = '" . $mc['article_db_id'] . "'", '', 0, 'arrange', 'ASC');
                if (!empty($subcat)) {
                    foreach ($subcat as $sc) {
                        $html.= '<li role="presentation" class="text-left" style="margin-left:40px;line-height:8px;"><a href="' . $this->Csz_model->base_link(). '/plugin/article/category/' . $sc['url_rewrite'] . '">' . $sc['category_name'] . '</a></li>';
                    }
                }
            }
        }
        $html.= '</ul>
                </div>
            </div>';
        $archive = $this->Csz_model->getValueArray('YEAR(timestamp_create) AS article_year', 'article_db', "is_category = '0' AND active = '1' AND lang_iso = '" . $lang_iso . "'", '', 0, 'article_year', 'DESC', 'article_year');
        $html.= '<div class="panel panel-primary">
                <div class="panel-heading"><b><i class="glyphicon glyphicon-menu-hamburger"></i> ' . $this->Csz_model->getLabelLang('article_archive') . '</b></div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">';
        if ($archive === FALSE) {
            $html.= '<li role="presentation" class="text-left"><a><b>' . $this->Csz_model->getLabelLang('article_not_found') . '</b></a></li>';
        } else {
            foreach ($archive as $ac) {
                $html.= '<li role="presentation" class="text-left"><a onclick="ChkHideShow(' . $ac['article_year'] . ');"><b><i class="glyphicon glyphicon-triangle-bottom"></i> ' . $ac['article_year'] . '</b></a></li>';
                $html.= '<div id="' . $ac['article_year'] . '" style="display:none;margin-left:30px;line-height:25px;">';
                $subarchive = $this->Csz_model->getValueArray("MONTHNAME(STR_TO_DATE(MONTH(timestamp_create), '%m')) AS article_month_name, MONTH(timestamp_create) AS article_month", 'article_db', "is_category = '0' AND active = '1' AND lang_iso = '" . $lang_iso . "' AND YEAR(timestamp_create) = '" . $ac['article_year'] . "'", '', 0, 'article_month', 'DESC', 'article_month');
                if (!empty($subarchive)) {
                    foreach ($subarchive as $sa) {
                        $html.= '<li role="presentation" class="text-left" style="padding-left:10px;"><a href="' . $this->Csz_model->base_link(). '/plugin/article/archive/' . $ac['article_year'] . '-' . $sa['article_month'] . '">' . $sa['article_month_name'] . '</a></li>';
                    }
                }
                $html.= '</div>';
            }
        }
        $html.= '</ul>
                </div>
            </div>';
        $html.= '<div class="panel panel-primary">
                <div class="panel-body text-center">
            <a href="' . $this->Csz_model->base_link(). '/plugin/article/rss" class="btn btn-sm btn-primary" target="_blank" title="RSS FEED"><i class="fa fa-rss" aria-hidden="true"></i> RSS FEED</a>
            </div>
            </div>';
        return $html;
    }
    
    public function getCatNameFromID($id){
        $cat = $this->Csz_model->getValue('category_name', 'article_db', "article_db_id", $id, 1);
        if(!empty($cat) && $cat->category_name){
            return $cat->category_name;
        }else{
            return $id;
        }
        
    }

}
