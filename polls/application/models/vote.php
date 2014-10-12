<?php

class Vote extends CI_Model {
    public $id;
    public $title;
    public $question;
    
    public function getVotes($pollid) {
        // Gets counts for each answer in the given poll; escaping param' to protect against SQL injection.
        $query = $this->db->query("select answerid, count(*) as count from Responses where pollid=".$this->db->escape($pollid)." group by answerid");
        $rows = $query->result();
        $answeridCounts = array();
        foreach ($rows as $row) {
            $answeridCounts[$row->answerid] = $row->count;
        }
        
        // Gets the answer count for the given poll
        $numOfAnswers = $this->db->get_where("Answers", array("pollid" => $pollid))->num_rows;
        
        // If less than 2 answers, the poll doesn't exist/is invalid
        if ($numOfAnswers < 2) {
            $this->output->set_header("HTTP/1.1 404 Not found");
            return;
        }
        
        // Puts the counts into an array
        $answerCounts = array();
        for ($i = 0; $i < $numOfAnswers; $i += 1) {
            if (array_key_exists($i, $answeridCounts)) {
                $answerCounts[$i] = (int) $answeridCounts[$i];
            }
            else {
                $answerCounts[$i] = 0;
            }
        }
        
        $output['results'] = $answerCounts;
        return $output;
    }
    
    public function addVote($pollid, $vote) {
        // Checks to see if the referenced poll exists
        $poll = $this->db->get_where('Polls', array('id' => $pollid));
        if ($poll->num_rows !== 1) {
            return false;
        }
        
        // Checks referenced answer exists
        $answer = $this->db->get_where('Answers', array('pollid'=> $pollid, 'answerid' => $vote));
        if ($answer->num_rows !== 1) {
            return false;
        }
        
        $data = array(
            'pollid' => $pollid,
            'answerid' => $vote,
            'ip' => $this->input->ip_address());
        $this->db->insert('Responses', $data);
        return true;
    }
    
    public function deleteVotes($pollid) {
        $this->db->delete("Responses", array('pollid' => $pollid));
    }
}

