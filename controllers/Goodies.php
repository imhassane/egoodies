<?php

class Goodies extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('db_model');
	}

	public function index() {
		$datas = array();
		$type = $this->input->get('type');

		$types = $this->db_model->getGoodyTypes();
		$datas['types'] = $types;


		$datas['cart'] = $this->db_model->addToCard();

		if($type != null && strtolower($type) != "all") {
			$goodies = $this->db_model->getGoodiesByType($type);
			$datas['goodies'] = $goodies;
		} else {
			$goodies = $this->db_model->getGoodies();
			$datas['goodies'] = $goodies;
		}

		$this->load->view('templates/header');
		$this->load->view('goodies/index', $datas);
		$this->load->view('templates/footer');
	}
}
