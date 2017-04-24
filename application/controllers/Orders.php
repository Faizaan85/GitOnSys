<?php
class Orders extends CI_Controller
{
    public function index()
    {
		// Loads up order list
        // $this->load->model('order_model');
        // $data['orders'] = $this->order_model->get_orders();
        $data['title'] = ucfirst("orders");
        $data['js']='orderslist.js';
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

		$this->load->model('order_model');
        $data['orderinfo'] = $this->order_model->get_orders($omid);
        $data['items'] = $this->order_model->get_order($omid);
        $data['title'] = ucfirst("order Details");
        $data['js'] = "order_details.js";
        $data['autorefresh']=FALSE;

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
    public function create_new_order()
    {
        $this->load->model('client_model');
        $data['clients'] = $this->client_model->get_clients();
        $data['title'] = ucfirst("new Order");
        $data['js'] = 'neworder.js';
        //$data['clients'] =
        $data['autorefresh']=FALSE;
        $this->load->view('templates/header',$data);
        $this->load->view('pages/neworder_view');
        $this->load->view('templates/footer');
    }
    public function save_order()
    {
		// Load models.
		$this->load->model('order_model');
		$this->load->model('user_model');
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
		
	}

}
