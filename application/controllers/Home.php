<?php

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index() {

		$news = $this->db->query("SELECT * FROM t_news_new");

		$data = array();
		$data['news'] = $news;

		$this->load->view("templates/header");
		$this->load->view("home_index", $data);
		$this->load->view("templates/footer");
	}
}
