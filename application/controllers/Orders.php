<?php
require(APPPATH.'libraries/fpdf/fpdf.php');
class PDF extends FPDF
{
	// Page header
	var $oinfo;
	function setRows($data)
	{
		$this->oinfo = $data;
	}
	function Header()
	{
	    // Logo
	    //$this->Image('logo.png',10,6,30);
	    // Arial bold 15
	    $this->SetFont('Times','BU',16);
	    // Move to the right
	    //$this->Cell(80);
		$this->Cell(100,10,'Order #: '.$this->oinfo['OmId'],1,0);
		$this->SetFont('Times','',12);
		$this->Cell(70,10,'Date: '.date("d-m-Y",strtotime($this->oinfo['OmCreatedOn'])),1,1);
		$this->MultiCell(170,10,'Name: '.$this->oinfo['OmCompanyName'],1);
		$this->Cell(70,10,'LPO: '.$this->oinfo['OmLpo'],1,0,'L');
		$this->Cell(100,10,'Salesman: '.$this->oinfo['OmCreatedBy'],1,1);
		// Line break
	    $this->Ln(5);
	}
// // Load data
// function LoadData($file)
// {
//     // Read file lines
//     $lines = file($file);
//     $data = array();
//     foreach($lines as $line)
//         $data[] = explode(';',trim($line));
//     return $data;
// }

// Colored table
function FancyTable($rows)
{

    // Colors, line width and bold font
	$this->SetFillColor(128,128,128);
    // $this->SetTextColor(255);
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('Times','B',12);
    // Header
	$header = array("Sr #", "Part #", "Supplier #", "Description", "R-Qty", "L-Qty", "T-Qty");
    $headerwidth = array(10, 20, 35, 60, 15, 15, 15);

    for($i=0;$i<count($header);$i++)
        $this->Cell($headerwidth[$i],10,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    //$this->SetFillColor(78, 77, 79);
    // $this->SetTextColor(0);
    // $this->SetFont('');
    // Data
    $fill = false; // Flag
	$rc = 1; // RowCount
	$this->SetFont('Times','',10);
    foreach($rows as $row)
    {

        $this->Cell($headerwidth[0],6,$rc,1,0,'L',$fill);
        $this->Cell($headerwidth[1],6,$row['OiPartNo'],1,0,'L',$fill);
		$this->Cell($headerwidth[2],6,$row['OiSupplierNo'],1,0,'L',$fill);
		$this->SetFontSize(8);
		$this->Cell($headerwidth[3],6,$row['OiDescription'],1,0,'L',$fill);
		$this->SetFontSize(12);
		$this->Cell($headerwidth[4],6,$row['OiRightQty'],1,0,'C',$fill);
		$this->Cell($headerwidth[5],6,$row['OiLeftQty'],1,0,'C',$fill);
		$this->Cell($headerwidth[6],6,$row['OiTotalQty'],1,0,'C',$fill);
		$this->SetFontSize(10);
        $this->Ln();
        $fill = !$fill;
		$rc += 1;
    }
    // Closing line
    $this->Cell(array_sum($headerwidth),0,'','T');
}
}
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
        $data['title'] = ($print == "FALSE")? ucfirst("order Details") : ucfirst("Order Print");
        $data['js'] = ($print == "FALSE")? "order_details.js" : "order_print.js";
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
// Edit order
// /Edit order

// Delete order
	public function delete_order()
	{
		$usrLvl = $this->input->post('usrlvl');
		if($usrLvl<7)
		{
			header('HTTP/1.1 404 Unauthorized User');
        	header('Content-Type: application/json; charset=UTF-8');
        	die(json_encode(array('message' => 'ERROR', 'code' => 404)));
		}
		$this->load->model('order_model');
		$result = $this->order_model->delete_order();
		echo json_encode($result);
	}
// /Delete Order
// Print Order
	public function print_order($orderNumber=109)
	{
		$this->load->model('order_model');
        $oinfo= $this->order_model->get_orders($orderNumber);
        $items= $this->order_model->get_order($orderNumber);
		// Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])


		$pdf = new PDF();
		$pdf->setRows($oinfo);
		$pdf->AddPage();
		$pdf->FancyTable($items);
		//$pdf->Output();
		$pdf->Output('F','i:/S2/O-'.$orderNumber.'.pdf');
		echo ('Order saved :'.$orderNumber);
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
		echo json_encode($result);
	}
	public function set_print_state()
	{
		$this->load->model('order_model');
		$result = $this->order_model->set_print_state();
		echo json_encode($result);
	}

}
