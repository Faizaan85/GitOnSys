<?php
class Pages extends CI_Controller
{

        public function view($page = 'home')
        {
        	if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
				{
                	// Whoops, we don't have a page for that!
                	show_404();
        		}
			$this->load->model(array('item_model'));

	        $data['title'] = ucfirst($page); // Capitalize the first letter

	        $this->load->view('templates/header', $data);
	        $this->load->view('pages/'.$page);
	        $this->load->view('templates/footer');
        }
		public function profile()
		{
			$data['title'] = "Punching Bag Game";
			$this->load->view('pages/punching_bag', $data);
		}
}
