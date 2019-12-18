<?php

class Originals extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('db_model');
	}

	public function index() {
		$data = array();

		$cat_id = $this->input->get('cat');

		if($cat_id && $cat_id != "all") {
			$categories = $this->db_model->getCategories();

			$category = $this->db_model->getCategoryByID($cat_id);
			$originals = $this->db_model->getOriginalsFromCategory($cat_id);

			$data = array(
				'originals' => $originals,
				'categories' => $categories
			);

			if(is_null($category)) {
				$data['message'] = "Cette catégorie n'existe pas";
			} else {
				$data['category'] = $category;
			}

			$this->load->view('templates/header');
			$this->load->view('originals/index', $data);
			$this->load->view('templates/footer');

		} else {
			$categories = $this->db_model->getCategories();
			$originals = $this->db_model->gallery();
			$this->load->view('templates/header');
			$this->load->view('originals/index', array('originals' => $originals, 'categories' => $categories, 'category' => (object) array('cat_name' => 'tout')));
			$this->load->view('templates/footer');
		}
	}

	public function details($ori_id) {
		$original = $this->db_model->getOriginal($ori_id);
		$data = array();
		if(is_null($original)) {
			$data['message'] = "Cet original n'existe pas";
		}else {
			$data['original'] = $original;

			$qty = (int) $this->input->post('qty'); $limit = (int) $this->input->post('goo_quantity');

			if($qty <= $limit)
				$data['cart'] = $this->db_model->addToCard();
			else
				$data['qty_exceeded'] = "Il n'y a pas cette quantité de goodies en stock actuellement";

			$data['goodies'] = $this->db_model->getOriginalGoodies($ori_id);
		}

		$this->load->view('templates/header');
		$this->load->view('originals/details', $data);
		$this->load->view('templates/footer');
	}

	public function trier() {
		$cat_id = $this->input->get('categorie');
		if($cat_id == null || $cat_id == "all") {
			redirect('/originals/');
		} else {
			$categories = $this->db_model->getCategories();

			$category = $this->db_model->getCategoryByID($cat_id);
			$originals = $this->db_model->getOriginalsFromCategory($cat_id);

			$this->load->view('templates/header');
			$this->load->view('originals/index', array(
				'originals' => $originals,
				'categories' => $categories,
				'category' => $category));
			$this->load->view('templates/footer');
		}
	}
}
