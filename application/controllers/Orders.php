<?php

class Orders extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('db_model');
	}

	public function details($ord_id, $ord_code) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('method', 'method', 'required');

		$order = $this->db_model->getOrder($ord_id, $ord_code);

		if($this->form_validation->run() == FALSE) {
			$data = array();
			if ($order == null) {
				$data['message'] = "La commande n'existe pas";
			} else {
				$data['order'] = $order;
				// On prend les goodies de la commande.
				$goodies = $this->db_model->getOrderGoodies($ord_id);
				$data['goodies'] = $goodies;
			}

			$this->load->view('templates/header');
			$this->load->view('orders/show', $data);
			$this->load->view('templates/footer');
		} else {
			$data['method'] = $this->input->post('method');

			if($data['method'] == 'update') {
				$data['order'] = $this->db_model->setOrderRetired($order->ord_id);
			}else {
				$data['order'] = $order;
				$this->db_model->deleteOrder($order->ord_id);
			}

			$this->load->view('templates/header');
			$this->load->view('orders/update', $data);
			$this->load->view('templates/footer');
		}
	}

	public function suivi() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ord_id', 'ord_id', 'trim|required|min_length[8]', array(
																				'required' => "Veuillez entrer l'identifiant de la commande",
																				'min_length' => "L'identifiant doit contenir 8 caractères"
																				));
		$this->form_validation->set_rules('ord_code', 'ord_code', 'trim|required|min_length[20]', array(
			'required' => "Veuillez entrer le code de la commande",
			'min_length' => "Le code de la commande doit contenir 20 caractères"));

		if($this->form_validation->run() != FALSE) {

			$order = $this->db_model->trackOrder();

			// Si il n'ya aucune commande
			if (is_null($order)) {
				$this->load->view('templates/header');
				$this->load->view('orders/index', array(
						'message' => "Codes érronés, cette commande n'existe pas",
						'orders' => array()
					)
				);
				$this->load->view('templates/footer');
			} else {
				$orders = array($order);

				$this->load->view('templates/header');
				$this->load->view('orders/index', array('orders' => $orders));
				$this->load->view('templates/footer');
			}
		}else {
			$this->load->view('templates/header');
			$this->load->view('orders/index');
			$this->load->view('templates/footer');
		}
	}

	public function commandes() {
		if(!$this->session->has_userdata('cpt_status') && $this->session->userdata('cpt_status') != 'V')
			redirect('');
		$datas['orders'] = $this->db_model->getWithdrawalPointOrders();
		$this->load->view('templates/header');
		$this->load->view('orders/commandes', $datas);
		$this->load->view('templates/footer');
	}
}
