<?php

class Items extends CI_Controller
{
    public function index()
    {
        // No idea what to do here.
    }
    public function get_part_details($partno)
    {
        $this->load->model('item_model');
        $data['part'] = $this->item_model->get_partno_details($partno);
		if(empty($data['part']))
		{
			header('HTTP/1.1 404 Item Not Found');
        	header('Content-Type: application/json; charset=UTF-8');
        	die(json_encode(array('message' => 'ERROR', 'code' => 404)));
		}
		else
		{
        	header('Content-Type: application/json');
        	echo json_encode($data['part']);
		}
    }
    public function item_search()
    {
        $this->load->model('item_model');
        $value = $this->input->post('search');
        $value = str_replace(" ", "%", $value);
        $data['searchresults'] = $this->item_model->search($value);

        $data['title'] = "Item Search";
        $data['js'] = '';
        //$data['clients'] =
        $data['autorefresh']=FALSE;
        $this->load->view('templates/header',$data);
        $this->load->view('pages/item_search');
        $this->load->view('templates/footer');
    }
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
