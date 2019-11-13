<?php

class Originals extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('db_model');
	}

	public function index() {
		$data = array();
		$cat_id = $this->input->get('categorie');

		if($cat_id && $cat_id != "all") {
			$categories = $this->db_model->getCategories();

			$category = $this->db_model->getCategoryByID($cat_id);
			$originals = $this->db_model->getOriginalsFromCategory($cat_id);

			if(is_null($category)) {
				$data['message'] = "Cette catégorie n'existe pas";
			} else {
				$data['category'] = $category;
			}

			$data = array(
				'originals' => $originals,
				'categories' => $categories);

			$this->load->view('templates/header');
			$this->load->view('originals/index', $data);
			$this->load->view('templates/footer');

		} else {
			$categories = $this->db_model->getCategories();
			$originals = $this->db_model->gallery();
			$this->load->view('templates/header');
			$this->load->view('originals/index', array('originals' => $originals, 'categories' => $categories));
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
