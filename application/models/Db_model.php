<?php

	class Db_model extends CI_Model {
		public function __construct()
		{
			$this->load->database();
		}

		// Catégories
		public function getCategoryByID($cat_id) {
			$sql = "SELECT cat_id, cat_name FROM t_category_cat WHERE cat_id=$cat_id";
			$query = $this->db->query($sql);
			return $query->row();
		}

		// Galérie
		public function getCategories() {
			$sql = "SELECT cat_id, cat_name FROM t_category_cat";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getOriginalsFromCategory($cat_id) {
			$sql = "SELECT ori_name, ori_image, ori_id FROM t_original_ori JOIN t_category_cat USING (cat_id) WHERE cat_id=$cat_id";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function gallery() {
			$sql = "SELECT ori_name, ori_image, ori_id FROM t_original_ori";
			$query = $this->db->query($sql);
			return $query->result();
		}

		// Originals
		public function getOriginals() {
			$sql = "SELECT * FROM t_original_ori";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getOriginal($ori_id) {
			$sql = "
				SELECT *
				FROM t_original_ori
				WHERE ori_id=$ori_id
			";

			$query = $this->db->query($sql);
			return $query->row();
		}

		public function getOriginalGoodies($ori_id) {
			$sql = "
				SELECT *
				FROM t_goody_goo
				JOIN tj_goody_original USING (goo_id)
				WHERE ori_id = $ori_id
			";

			$query = $this->db->query($sql);
			return $query->result();
		}

		// Orders
		public function getAllOrders() {
			$sql = "SELECT * FROM t_order_ord";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getOrder($ord_id, $ord_code) {
			$sql = "select 
					ord_code, ord_id, ord_identification, ord_created_at, ord_max_date,
					ord_first_name, ord_last_name, ord_email, ord_price,
					wit_id, wit_adress, wit_name
					FROM t_order_ord
					JOIN t_withdrawal_point_wit USING (wit_id)
					WHERE ord_identification='$ord_id' AND ord_code='$ord_code'";
			$query = $this->db->query($sql);
			return $query->row();
		}

		public function getOrderGoodies($ord_id) {
			$sql = "
				SELECT * FROM t_goody_goo
				JOIN tj_order_goody USING (goo_id)
				JOIN t_order_ord USING (ord_id)
				WHERE ord_identification = '$ord_id'
			";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function trackOrder() {
			$ord_id = $this->input->post('ord_id');
			$ord_code = $this->input->post('ord_code');
			
			$sql = "SELECT * FROM t_order_ord WHERE ord_identification='$ord_id' AND ord_code='$ord_code'";
			$query = $this->db->query($sql);
			$result = $query->row();
			return $result;
		}

		// Goodies
		public function getGoodies() {
			$sql = "SELECT
					goo_name, goo_image, goo_id,
					typ_id, typ_name
					FROM t_goody_goo JOIN t_goody_type_typ USING (typ_id)";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getGoodiesByType($typ_id) {
			$sql = "
				SELECT
				goo_name, goo_image, goo_id,
				typ_name, typ_id
				FROM t_goody_goo
				JOIN t_goody_type_typ USING (typ_id)
				WHERE typ_id=$typ_id
			";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getGoodyTypes() {
			$sql = "SELECT *, COUNT(goo_id) as totalGoody FROM `t_goody_type_typ` JOIN t_goody_goo USING (typ_id) GROUP BY typ_id";
			$query = $this->db->query($sql);
			return $query->result();
		}

		// Authentification & profil
		public function authenticate() {
			$pseudo = $this->input->post('pseudo');
			$password = $this->input->post('password');

			$sql = "SELECT * FROM t_compte_cpt WHERE cpt_username='$pseudo' AND cpt_password='$password'";
			$query = $this->db->query($sql);
			return $query->row();
		}

		public function getProfil() {
			$cpt_id = $this->session->userdata('cpt_id');

			$sql = "
				SELECT
					prf_id, prf_nom, prf_prenom
				FROM t_compte_cpt JOIN t_profil_prf USING (prf_id)
				WHERE cpt_id=$cpt_id;
			";
			$query = $this->db->query($sql);
			return $query->row();
		}
	}
