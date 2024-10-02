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
		$data['view'] = 'pages/item/list';
		$data['header_title'] = 'List Item';
		$this->load->view('index', $data);
	}

	public function new_item()
	{
		$data['header_title'] = 'New Item';
		$data['view'] = 'pages/item/create';
		$this->load->view('index', $data);
	}

	public function create_update_item() {
		$data = $this->input->post();

		if (empty($data['description']) || empty($data['title'])) {
			$this->session->set_flashdata('warning','Please fill full data');
			return redirect('item');
		}

		if (!empty($data['id']) ) {
			$data['title'] = htmlspecialchars($data['title']);
			$data['description'] = htmlspecialchars($data['description']);
			$id = $data['id'];
			unset($data['id']);
			$result = $this->item_model->update_item($data, $id);
			$msg = 'Update item complete';
		} else {
			$data['title'] = htmlspecialchars($data['title']);
			$data['description'] = htmlspecialchars($data['description']);
			$result = $this->item_model->insert_item($data);
			$msg = 'Add new item complete';
		}

		if ($result) {
			$this->session->set_flashdata('success', $msg);
		} else {
			$this->session->set_flashdata('warning','Something go wrong');
		}

		return redirect('item');
	}

	public function remove_item() {
		$data = $this->input->post();
		$result = $this->item_model->destroy_item($data);
		$result > 0 ? $msg = 'Remove success' : $msg = 'Something go wrong';
		echo json_encode(['status' => $result, 'msg' => $msg]);
		die();
	}
}
