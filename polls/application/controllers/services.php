<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/REST_Controller.php");

class services extends REST_Controller {
    
    public function polls_get($pollid = NULL) {
        $this->load->model('poll');
        
        // for /polls, gets a list of all of the polls
        if (is_null($pollid)) {
            // Gets all of the polls
            $polls = $this->poll->listAll();
            $this->output->set_header("HTTP/1.1 200 OK");
            $this->output->set_content_type("application/json");
            $this->output->set_output(json_encode($polls));
        }
        else {
            // Gets specified poll and it's associated answers
            $poll = $this->poll->read($pollid);
            if ($poll === NULL) {
                $this->output->set_header("HTTP/1.1 404 Not found");
            }
            else {
                $this->output->set_header("HTTP/1.1 200 OK");
                $this->output->set_content_type("application/json");
                $this->output->set_output(json_encode($poll));
            }
        }
    }
    
    public function votes_post($pollid=NULL, $vote=NULL) {
        $this->load->model('vote');
        if ($pollid === NULL || $vote === NULL) {
            $this->output->set_header("HTTP/1.1 404 Not found");
            return;
        }
        // Checks to see if the referenced poll exists
        $poll = $this->db->get_where('Polls', array('id' => $pollid));
        
        // Returns true if the query is successful.
        if ($this->vote->addVote($pollid, $vote)) {
            $this->output->set_header("HTTP/1.1 200 OK");
        }
        else {
            $this->output->set_header("HTTP/1.1 404 Not found");
        }
    }
    
    public function votes_get($pollid=NULL) {
        $this->load->model('vote');
        
        if ($pollid === NULL) {
            $this->output->set_header("HTTP/1.1 404 Not found");
        }
        else {
            $answerCounts = $this->vote->getVotes($pollid);
            if ($answerCounts == NULL) {
                $this->output->set_header("HTTP/1.1 404 Not found");
                return;
            }

            $this->output->set_header("HTTP/1.1 200 OK");
            $this->output->set_content_type("application/json");
            $this->output->set_output(json_encode($answerCounts));
        }
    }
    
    public function votes_delete($pollid=NULL) {
        if ($pollid === NULL) {
            $this->output->set_header("HTTP/1.1 404 Not found");
        }
        else {
            $this->load->model('vote');
            $this->vote->deleteVotes($pollid);
            $this->output->set_header("HTTP/1.1 200 OK");
        }
    }
}