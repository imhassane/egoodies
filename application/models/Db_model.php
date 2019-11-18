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
			$sql = "
				SELECT
					ord_id, ord_identification, ord_code, ord_created_at, ord_price,
					ord_first_name, ord_last_name, ord_email, ord_max_date, ord_status,
					wit_name, wit_id, wit_adress
				FROM t_order_ord
				JOIN t_withdrawal_point_wit USING (wit_id)
			";
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

			$sql = "SELECT cpt_id, cpt_status, cpt_username FROM t_compte_cpt WHERE
					cpt_username='$pseudo' AND cpt_password=SHA2('$password', 256)
					AND cpt_status != 'N'";
			$query = $this->db->query($sql);
			return $query->row();
		}

		public function getProfil($cpt_id) {
			$sql = "
				SELECT
					prf_id, prf_nom, prf_prenom, cpt_status, prf_email
				FROM t_compte_cpt JOIN t_profil_prf USING (prf_id)
				WHERE cpt_id=$cpt_id
			";
			$query = $this->db->query($sql);
			return $query->row();
		}

		public function getProfils() {
			$sql = "
				SELECT
					prf_nom, prf_prenom, prf_email,
					cpt_status, cpt_username
				FROM t_profil_prf
				JOIN t_compte_cpt USING (prf_id);
			";
			return $this->db->query($sql)->result();
		}

		public function changePassword() {
			$cpt_id = $this->session->userdata('cpt_id');
			if(is_null($cpt_id)) {
				return array('message' => "Vous devez vous connecter pour accéder à cette page");
			}
			$current = $this->input->post('current');
			$new = $this->input->post('new');
			$repeat = $this->input->post('repeat');

			if($new != $repeat) return (object) array('message' => "Vos deux mots de passe ne correspondent pas");

			$sql = "SELECT cpt_id FROM t_compte_cpt WHERE cpt_id=$cpt_id AND cpt_password=SHA2('$current', 256)";
			$query = $this->db->query($sql);
			$user = $query->row();
			if(is_null($user)) return (object) array('message' => "Le mot de passe actuel n'est pas correct");

			$sql = "UPDATE t_compte_cpt SET cpt_password=SHA2('$new', 256) WHERE cpt_id=$cpt_id";
			$query = $this->db->query($sql);

			$sql = "SELECT cpt_id FROM t_compte_cpt WHERE cpt_id=$cpt_id";
			$query = $this->db->query($sql);

			return $query->row();
		}

		public function updateProfil() {
			$cpt_id = $this->session->userdata('cpt_id');

			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email = $this->input->post('email');

			$sql = "
				UPDATE t_profil_prf
				SET
					prf_prenom = '$first_name',
					prf_nom = '$last_name',
					prf_email = '$email'
				WHERE prf_id = (SELECT prf_id FROM t_compte_cpt WHERE cpt_id = $cpt_id)";
			$query = $this->db->query($sql);
			$query = $this->db->query("SELECT * FROM t_profil_prf JOIN t_compte_cpt WHERE cpt_id = $cpt_id");
			return $query->row();
		}

		public function createUser() {
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$type = $this->input->post('type');
			$sql = "
				INSERT INTO t_profil_prf (prf_nom, prf_prenom, prf_email)
				VALUES ('$last_name', '$first_name', '$email');
			";
			$this->db->query($sql);
			$sql = "
				INSERT INTO t_compte_cpt(cpt_username, cpt_password, cpt_status, prf_id, cpt_created_at)
				VALUES ('$username', SHA2('$password', 256), '$type', (SELECT MAX(prf_id) FROM t_profil_prf), NOW());
			";
			$query = $this->db->query($sql);
			$query = $this->db->query("SELECT MAX(cpt_id) FROM t_compte_cpt");
			return $query->row();
		}

		// Points de retrait
		function getWithdrawalPoints() {
			$sql = "
				SELECT * FROM t_withdrawal_point_wit
			";
			$query = $this->db->query($sql);
			return $query->result();
		}
	}

