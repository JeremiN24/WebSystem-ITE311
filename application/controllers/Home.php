<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index() {
        $data = [
            'title' => 'Welcome to My Website',
            'content' => 'home_content' // This loads home_content.php
        ];
        $this->load->view('template', $data);
    }
}