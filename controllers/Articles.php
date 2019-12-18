<?php

class Articles extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('db_model');
	}

	public function index() {

		$datas = array();

		$datas['news'] = $this->db_model->getNews();

		$this->load->view('templates/header');
		$this->load->view('articles/index', $datas);
		$this->load->view('templates/footer');
	}
}
