<?php

class Poll extends CI_Model {
    public $id;
    public $title;
    public $question;
    
    public function read($pollid) {
        $poll = new Poll();
        $query = $this->db->get_where('Polls', array('id' => $pollid));
        if ($query->num_rows !== 1) {
            return NULL;
        }
        
        $rows = $query->result();
        foreach ((array) $rows[0] as $field => $value) {
            $poll->$field = $value;
        }
        $poll->answers = $this->listAllAnswers($pollid);
        
        return $poll;
    }


    /*
     * Return a map from productID to productName for all products
     */
    public function listAll() {
        $rows = $this->db->get('Polls')->result();
        $list = array();
        foreach ($rows as $row) {
            $pollToAdd = new Poll();
            $pollToAdd->id = $row->id;
            $pollToAdd->title = $row->title;
            $pollToAdd->question = $row->question;
            $list[] = $pollToAdd;
        }
        return $list;
    }
    
    public function listAllAnswers($pollid) {
        $rows = $this->db->get_where('Answers', array('pollid' => $pollid))->result();
        $list = array();
        foreach ($rows as $row) {
            $list[$row->answerid] = $row->answer;
        }
        return $list;
    }
};

