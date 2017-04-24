<?php
    class Client_model extends CI_Model
    {
        public function __construct()
        {
            
        }
        //below function can get ALL or 1 client. 
        public function get_clients($cond="ALL")
        {
            if($cond == "ALL")
            {
                $query = $this->db->order_by('CLCODE','ASC')->get('cl001');
                return $query->result_array();
            }
            else
            {
                $query = $this->db->get_where('cl001', array('CLCODE'=>$cond));
                return $query->row_array();
            }
        }
        
    }

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

