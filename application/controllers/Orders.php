<?php

class Orders extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('db_model');
	}

	public function liste() {
		$orders = $this->db_model->getAllOrders();

		$data = array();
		$data['orders'] = $orders;
		$this->load->view('templates/header');
		$this->load->view('orders/index', $data);
		$this->load->view('templates/footer');
	}

	public function details($ord_id, $ord_code) {
		$order = $this->db_model->getOrder($ord_id, $ord_code);
		$data = array();
		if($order == null) {
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
	}

	public function suivi() {
		$order = $this->db_model->trackOrder();

		// Si il n'ya aucune commande
		if(is_null($order)) {
			$this->load->view('templates/header');
			$this->load->view('orders/index', array(
													'message' => "Cette commande n'existe pas",
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
	}
}
