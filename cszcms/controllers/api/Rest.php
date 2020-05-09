<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $resp = $this->RestModel->category_data();
            json_output(200, $resp);
        }
    }

    public function articles($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET' || $this->uri->segment(4) == '' || is_numeric($this->uri->segment(4)) == false) {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $resp = $this->RestModel->article_data($id);
            json_output(200, $resp);
        }
    }

    public function programs()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $resp = $this->RestModel->program_data();
            json_output(200, $resp);
        }
    }
    public function studentcenter()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $resp = $this->RestModel->student_data();
            json_output(200, $resp);
        }
    }

    public function sportscenter($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET' || $this->uri->segment(4) == '' || is_numeric($this->uri->segment(4)) == false) {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $resp = $this->RestModel->sportscenter_data($id);
            json_output(200, $resp);
        }
    }
    public function banners()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $resp = $this->RestModel->banner_data();
            json_output(200, $resp);
        }
    }
    public function web_banners()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $resp = $this->RestModel->web_banner_data();
            json_output(200, $resp);
        }
    }
}
