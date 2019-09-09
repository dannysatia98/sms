<?php

class _spirit extends CI_Model {

  public function __construct(){
    parent::__construct();
  }

  public function find_by_id($spirit_id)
  {
    return $this->db->where('spirit_id', $spirit_id)->get('spirit')->row_array();
  }
}
