<?php

class _sosial extends CI_Model {

  public function __construct(){
    parent::__construct();
  }

  public function find_by_id($sosial_id)
  {
    return $this->db->where('sosial_id', $sosial_id)->get('sosial')->row_array();
  }
}
