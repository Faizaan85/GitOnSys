<?php
class Orders extends CI_Controller
{
    public function index()
    {
		// Loads up order list
        // $this->load->model('order_model');
        // $data['orders'] = $this->order_model->get_orders();
        $data['title'] = ucfirst("orders");
        $data['js']=array('DataTables/datatables.min.js','js/orderslist.js');
        // $data['autorefresh']=TRUE;
        // $data['baseurl']=base_url();
        $this->load->view('templates/header', $data);
        $this->load->view('pages/orderslist');
		$this->load->view('templates/footer');
    }
	public function get_orderlist()
	{
		$this->load->model('order_model');
		$data['orders'] = $this->order_model->get_orders();
		echo json_encode($data['orders']);

	}

    public function get_order_details($omid,$print = "FALSE")
    {

		$this->load->model(array('order_model','item_model'));
        $data['orderinfo'] = $this->order_model->get_orders($omid); //ordermaster
        $data['items'] = $this->order_model->get_order($omid); //orderitems / order details
        $data['title'] = ($print == "FALSE")? ucfirst("order Details") : ucfirst("Order Print");
        $data['js'] = ($print == "FALSE")? array("js/order_details.js") : array("js/order_print.js");
        $data['autorefresh']=FALSE;
		$data['envals'] = $this->item_model->enum_select();
        $this->load->view('templates/header', $data);
        if($print == "FALSE")
        {
            $this->load->view('pages/order');
	    }
        else
        {
            $this->load->view('pages/order_print');
        }
        $this->load->view('templates/footer');
    }
    public function create_new_order($mode="new")
    {
        $this->load->model('client_model');
        $data['clients'] = $this->client_model->get_clients();
		if($mode === "new")
		{
			$data['title'] = "New Order";
		}
		else
		{
			$data['title'] = "Edit Order";
			// Load existing records here.

		}
        $data['js'] = array(
			'tabulator-master/tabulator.js',
			'js/neworder.js'
		);
        //$data['clients'] =

        $this->load->view('templates/header',$data);
        $this->load->view('pages/neworder_view-tabulator.php');
        $this->load->view('templates/footer');
    }
	// public function edit_order();
	// {
	//
	// }
    public function save_order()
    {
		// Load models.
		$this->load->model(array('order_model', 'user_model'));

		// save post username to variable
		$usrname = $this->input->post('username');
		// get the userid from username
		$usrid = $this->user_model->get_userid($usrname);
		// if username not found. (only case to heppen: someone messed with the data)
		// if($usrid == false)
		// {
		// 	die(header("HTTP/1.0 404 Not Found"));
		// }
		// else send userid to post order and get result.
        $result = $this->order_model->post_order($usrid['UsrId']);

		echo json_encode($result);
    }
// Edit order
// /Edit order

// Delete order
	public function delete_order()
	{
		$usrLvl = $this->input->post('usrlvl');
		if($usrLvl<7)
		{
			header('HTTP/1.1 466 Unauthorized User');
        	header('Content-Type: application/json; charset=UTF-8');
        	die(json_encode(array('message' => 'ERROR', 'code' => 466)));
		}
		$this->load->model('order_model');
		$result = $this->order_model->delete_order();
		echo json_encode($result);
	}
// /Delete Order


    public function order_item_state()
    {
        $this->load->model('order_model');
        $date = new DateTime();
        $state=array(
            'OiId' => $this->input->post('oiid'),
            'OiOmId' => $this->input->post('oiomid'),
            'OiModifiedOn' => $date->getTimestamp(),
            'OiStatus' => $this->input->post('status')
        );
        if($this->input->post('oitotalqty') != NULL)
        {
            // Create additional Array
            $state_addition = array(
                    'OiLeftQty' => $this->input->post('oileftqty'),
                    'OiRightQty' => $this->input->post('oirightqty'),
                    'OiTotalQty' => $this->input->post('oitotalqty')
            );
            // Merge it with Existing $state array
            $state = array_merge($state,$state_addition);
        }
        $result = $this->order_model->order_item_state($state);
        echo json_encode($state);
    }
	public function set_store_state()
	{
		$this->load->model('order_model');
		$result = $this->order_model->set_store_state();
		echo json_encode($result);
	}
	public function set_print_state()
	{
		$this->load->model('order_model');
		$result = $this->order_model->set_print_state();
		echo json_encode($result);
	}

}
