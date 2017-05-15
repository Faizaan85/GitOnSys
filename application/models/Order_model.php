<?php
    class Order_model extends CI_Model
    {
        public function __construct()
        {
//            $this->load->database();
        }

        public function get_orders($cond = "ALL") //
        {
            if($cond == "ALL")
            {
				$this->db->select('OmId, OmCompanyName, OmCreatedOn, OmLpo, OmStatus, OmStore1, OmStore2, OmPrinted, OmCreatedBy');
				$yesterday = date("Y-m-d",strtotime("-2 day"));
				$whereCondition = "OmCreatedOn > '".$yesterday."' OR OmPrinted = 0";
				$this->db->where($whereCondition);
                $query = $this->db->order_by('OmId','DESC')->get('ordermaster_user');
                return $query->result_array();
            }
            else
            {
                $query = $this->db->get_where('ordermaster_user', array('OmId'=>$cond));
                return $query->row_array();
            }

        }
        public function get_order($omid)
        {
            $query = $this->db->get_where('order_details', array('OiOmId'=>$omid));
            return $query->result_array();
        }
        public function post_order($userid)
        {

			// Array for ordermaster
	        $order = array(
	            'OmCompanyName' => $this->input->post('name'),
	            'OmCreatedOn' => $this->input->post('date'),
	            'OmLpo' => $this->input->post('lpo'),
				'OmCreatedBy' => $userid
	        );
			// Array for orderitems
	        $orderdata = $this->input->post('orderdata');
			// Saving process begins
            $this->db->trans_begin();
            $this->db->insert('ordermaster',$order);
            $insert_id = $this->db->insert_id();

            for($i=0;$i<count($orderdata);$i++)
            {
                $insertdata = array(
                    'OiOmId' => $insert_id,
                    'OiPartNo' => $orderdata[$i][0],
                    'OiSupplierNo' => $orderdata[$i][1],
                    'OiDescription' => $orderdata[$i][2],
                    'OiRightQty' => $orderdata[$i][3],
                    'OiLeftQty' => $orderdata[$i][4],
                    'OiTotalQty' => $orderdata[$i][5],
                    'OiPrice' => $orderdata[$i][6]
                );
                $this->db->insert('orderitems',$insertdata);
            }
            if($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
				return "ERROR in Transaction";
            }
            else
            {
                $this->db->trans_commit();
                return $insert_id;
            }
        }

// Delete Order
		public function delete_order()
		{
			// Need to get OmId for Ordermaster table.
			// Also i should probably check user level but maybe later.
			$OmId = $this->input->post('omid');
			$this->db->set('OmIsDeleted', 1);
			$this->db->where('Omid', $OmId);
			$result = $this->db->update('ordermaster');
			return $result;
		}
// /Delete Order
        public function order_item_state($state)
        {
            // To update record set OiStatus with $state['OiStatus']
            $this->db->set('OiStatus', $state['OiStatus']);
            // With Following Conditions
            if(isset($state['OiTotalQty']))
            {
                $this->db->set('OiTotalQty', $state['OiTotalQty']);
                $this->db->set('OiLeftQty', $state['OiLeftQty']);
                $this->db->set('OiRightQty', $state['OiRightQty']);
            }
            $this->db->where('OiId',$state['OiId']);
            $this->db->where('OiOmId',$state['OiOmId']);
            // Return the result of the query.
            return $this->db->update('orderitems');
        }
		public function set_store_state()
		{
			// fetch post data into aray
			$data = array(
				'OmId' => $this->input->post('orderid'),
				'OmStore' => $this->input->post('storename'),
				'OmStoreState' => $this->input->post('status')
			);
			// set db Conditions
			$this->db->set($data['OmStore'],$data['OmStoreState']);
			$this->db->where('OmId',$data['OmId']);
			// Return the result of the query
			return $this->db->update('ordermaster');
		}
		public function set_print_state()
		{
			// Fetch post data into array
			$data = array(
				'OmId' => $this->input->post('orderid'),
				'OmPrinted' => $this->input->post('status')
			);
			// Set db Conditions
			$this->db->set('OmPrinted',$data['OmPrinted']);
			$this->db->where('OmId',$data['OmId']);
			// Return the result of the query
			return $this->db->update('ordermaster');
		}
    }
