<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Views extends CI_Controller {
    
    public function pollsView() {
        $this->load->view("partials/polls.html");
    }
    
    public function pollView() {
        $this->load->view("partials/vote.html");
    }
    
    public function resultsView() {
        $this->load->view("partials/results.html");
    }
    
    public function about() {
        $this->load->view("partials/about.html");
    }
    
    public function index() {
        $this->load->view('view');
    }
}