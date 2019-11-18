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

		$profil = $this->db_model->getProfil($this->session->userdata('cpt_id'));
		$data['profil'] = $profil;

		$this->load->view('templates/header');
		$this->load->view('member/profil', $data);
		$this->load->view('templates/footer');
	}

	public function profils() {
		$this->load->view('templates/header');
		$this->load->view('member/profils', array('profils' => $this->db_model->getProfils()));
		$this->load->view('templates/footer');
	}

	public function modifierMotDePasse() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('current', 'current', 'trim|required', array('required' => 'Votre mot de passe est requis'));
		$this->form_validation->set_rules('new', 'new', 'trim|required', array('required' => 'Entrez le nouveau mot de passe'));
		$this->form_validation->set_rules('repeat', 'repeat', 'trim|required|matches[new]', array('required' => 'Repetez le mot de passe', 'matches' => "Les mots de passe ne correspondent pas"));

		$data = array();
		if($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header');
			$this->load->view('member/change-password', $data);
			$this->load->view('templates/footer');
		} else {
			$user = $this->db_model->changePassword();
			if($user) {
				$data['user'] = $user;
				$data['message'] = "Le mot de passe a été modifié avec succès";
			}

			$this->load->view('templates/header');
			$this->load->view('member/change-password', $data);
			$this->load->view('templates/footer');
		}
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
			if($user->cpt_status == 'V')
				redirect('/member/espacevendeur');
			else if($user->cpt_status == 'A')
				redirect('/member/espaceadmin');
		} else {
			$data['message'] = "Vos identifiants ne sont pas corrects";
		}

		$this->load->view('templates/header');
		$this->load->view('member/login', $data);
		$this->load->view('templates/footer');
	}

	public function inscription() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'first_name', 'trim|required', array('required' => "Veuillez entrer le prenom"));
		$this->form_validation->set_rules('last_name', 'last_name', 'trim|required', array('required' => "Veuillez entrer le nom"));
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email', array('required' => "Veuillez entrer une adresse email correcte"));
		$this->form_validation->set_rules('type', 'type', 'trim|required', array('required' => "Veuillez sélectionner le type du compte"));
		$this->form_validation->set_rules('username', 'username', 'trim|required', array('required' => "Veuillez entrez un nom d'utilisateur"));
		$this->form_validation->set_rules('password', 'password', 'trim|required', array('required' => "Veuillez entrer le mot de passe"));
		$this->form_validation->set_rules('repeat', 'repeat', 'trim|required|matches[password]', array('required' => "Veuillez repeter le mot de passe"));

		if($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header');
			$this->load->view('member/register');
			$this->load->view('templates/footer');
		} else {
			$data = array();
			$user = $this->db_model->createUser();
			if(!is_null($user)) {
				$data['message'] = "Le profil a bien été créé";
			}
			$this->load->view('templates/header');
			$this->load->view('member/register', $data);
			$this->load->view('templates/footer');
		}
	}

	public function modifierprofil() {
		if(!$this->session->cpt_id)
			redirect('/');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'first_name', 'trim|required', array('required' => 'Votre prénom est requis'));
		$this->form_validation->set_rules('last_name', 'last_name', 'trim|required', array('required' => 'Votre nom est requis'));
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email', array('required' => 'Votre adresse email est requise'));
		$data = array();

		if($this->form_validation->run() == FALSE) {
			$user = $this->db_model->getProfil($this->session->userdata('cpt_id'));
			$data['user'] = $user;

			$this->load->view('templates/header');
			$this->load->view('member/modifier_profil', $data);
			$this->load->view('templates/footer');
		} else {
			$user = $this->db_model->updateProfil();
			$data['user'] = $user;

			$this->load->view('templates/header');
			$this->load->view('member/modifier_profil', $data);
			$this->load->view('templates/footer');
		}
	}

	public function espaceVendeur() {
		if(!$this->session->has_userdata('cpt_id'))
			redirect('/');
		else if ($this->session->userdata('cpt_status') != 'V')
			redirect('/');

		$this->load->view('templates/header');
		$this->load->view('member/espace_vendeur');
		$this->load->view('templates/footer');
	}

	public function espaceAdmin() {
		if(!$this->session->has_userdata('cpt_id'))
			redirect('/');
		else if ($this->session->userdata('cpt_status') != 'A')
			redirect('/');

		$data = array();

		$data['orders'] = $this->db_model->getAllOrders();
		$data['withs'] = $this->db_model->getWithdrawalPoints();

		$this->load->view('templates/header');
		$this->load->view('member/espace_admin', $data);
		$this->load->view('templates/footer');
	}
}
