<?php

class Member extends CI_COntroller {
	public function __construct(){
		parent::__construct();
		$this->load->model('db_model');
	}

	public function index() {
		$this->load->view('templates/header');
		$this->load->view('member/login');
		$this->load->view('templates/footer');
	}

	public function profil() {
		$data = array();

		$profil = $this->db_model->getProfil();
		$data['profil'] = $profil;

		$this->load->view('templates/header');
		$this->load->view('member/profil', $data);
		$this->load->view('templates/footer');
	}

	public function deconnexion() {
		$this->session->unset_userdata(array('cpt_id', 'cpt_status'));
		redirect('/member');
	}

	public function connexion() {

		if($this->session->has_userdata('cpt_id')) {
			redirect('/');
		}

		$user = $this->db_model->authenticate();
		$data = array();

		if($user) {
			$this->session->set_userdata(array(
				'cpt_id' => $user->cpt_id,
				'cpt_status' => $user->cpt_status,
				'cpt_username' => $user->cpt_username
			));
		} else {
			$data['message'] = "Vos identifiants ne sont pas corrects";
		}

		$this->load->view('templates/header');
		$this->load->view('member/login', $data);
		$this->load->view('templates/footer');
	}

	public function inscription() {
		if($this->session->has_userdata('cpt_id')) {
			redirect('/');
		}
		$this->load->view('templates/header');
		$this->load->view('member/register');
		$this->load->view('templates/footer');
	}
}
