<?php

class Panier extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('db_model');
	}
	public function index() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('num_goodies', 'num_goodies', 'required', array('required' => 'Champ obligatoire'));

		$datas = array();

		if($this->form_validation->run() != FALSE) {
			if($this->input->post('method') == 'update') {
				$this->db_model->updateCard();
			}
		}

		if(!$this->session->has_userdata('cart')) $this->session->set_userdata('cart', array());

		$this->load->view('templates/header');
		$this->load->view('cart/index', $datas);
		$this->load->view('templates/footer');
	}

	public function informations() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'first_name', 'trim|required', array('required' => "Veuillez entrer votre prénom"));
		$this->form_validation->set_rules('last_name', 'last_name', 'trim|required', array('required' => "Veuillez entrer votre nom"));
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email', array('required' => "Veuillez entrer votre adresse email", "valid_email" => "Veuillez entrer une adresse email correcte"));
		$this->form_validation->set_rules('wit_id', 'first_name', 'trim|required', array('required' => "Veuillez choisir un point de retrait"));

		$datas = array();
		$datas['withs'] = $this->db_model->getWithdrawalPoints();

		if($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header');
			$this->load->view('cart/informations', $datas);
			$this->load->view('templates/footer');
		} else {
			if(!$this->session->has_userdata('total_price')) redirect('/panier');

			$datas['res'] = $this->db_model->saveOrderInformations();
			$this->load->view('templates/header');
			$this->load->view('cart/order_success', $datas);
			$this->load->view('templates/footer');
		}
	}
}
