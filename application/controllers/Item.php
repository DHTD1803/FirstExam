<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('item_model');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['table_data'] = $this->item_model->get_all_item();
		$data['view'] = 'list';
		$data['header_title'] = 'List Item';
		$this->load->view('index', $data);
	}

	public function create()
	{
		$data = $this->input->post();
		$data['description'] = htmlspecialchars($data['description']);
		$result = $this->item_model->insert_new_item($data);
		if ($result) {
			$this->session->set_flashdata('success','Add new complete');
		} else {
			$this->session->set_flashdata('warning','Something go wrong');
		}

		redirect('item');
	}
}
