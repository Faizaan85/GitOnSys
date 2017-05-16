<?php
class Item_model extends CI_Model
{
	public function enum_select()
    {
        $query = "SHOW COLUMNS FROM itemdetails LIKE 'IdStore'";
        $row = $this->db->query($query)->row()->Type;
        $regex = "/'(.*?)'/";
		//enum('All','Store 1','Store 2')
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
		$i=1;
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$i] = $value;
			$i++;
        }
        return $enums;
    }
    public function get_partno_details($partno)//input partno and get details of it.
    {
        $query = $this->db->get_where('item', array('PART_NO'=>$partno));
        return $query->row_array();

    }
    public function search($value="")
    {
    	if($value==="")
    	{
    		//lets search all items in all category
    		$this->db->select('PART_NO, SSNO, CO_NAME, EQUIPMENT, `DESC`, SALES_PRIC, QTY_HAND, QTY_ORDER, UNIT_COST');
    		$this->db->from('item');
    		$this->db->like('PART_NO', $value);
    		$this->db->or_like('SSNO', $value);
    		$this->db->or_like('`DESC`', $value);
    		$this->db->or_like('CO_NAME', $value);
    		$this->db->or_like('REMARK',$value);
    		$this->db->order_by('PART_NO','ASC');
    		$query = $this->db->get();
    		return $query->result_array();
    	}
    	else
    	{
    		$query = $this->db->query(' Select PART_NO, SSNO, CO_NAME, EQUIPMENT, `DESC`, SALES_PRIC, QTY_HAND, QTY_ORDER, UNIT_COST from item where PART_NO LIKE "%'.$value .'%" OR SSNO LIKE "%'.$value .'%" OR `DESC` LIKE "%'.$value .'%" OR CO_NAME LIKE "%'.$value .'%" OR REMARK LIKE "%'.$value .'%" order by PART_NO ASC');
    		return $query->result_array();

    	}

    }
	public function set_item_store()
	{
		// fetch post data
		$data = array(
			'IdIPART_NO' => $this->input->post('partno'),
			'IdStore' => $this->input->post('option')
		);
		// set db condition.
		$this->db->set('IdStore',$data['IdStore']);
		$this->db->where('IdIPART_NO',$data['IdIPART_NO']);
		// Return the result of the query
		return $this->db->update('itemdetails');
	}
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
