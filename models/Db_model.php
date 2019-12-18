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
					ord_code, ord_id, ord_identification, ord_created_at, ord_max_date, ord_status,
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

		public function setOrderRetired($ord_id) {
			$this->db->query("UPDATE t_order_ord SET ord_status = 'R' WHERE ord_id=$ord_id");
			return $this->db->query("SELECT * FROM t_order_ord WHERE ord_id=$ord_id")->row();
		}

		public function deleteOrder($ord_id) {
			$this->db->trans_start();
			$query = $this->db->query("SELECT goo_id, qty FROM tj_order_goody WHERE ord_id=$ord_id");
			foreach ($query->result() as $data) {
				$this->db->query("SELECT goo_quantity INTO @goo_quantity FROM t_goody_goo WHERE goo_id=$data->goo_id");
				$this->db->query("UPDATE t_goody_goo SET goo_quantity = @goo_quantity + $data->qty WHERE goo_id=$data->goo_id");
			}
			$this->db->query("DELETE FROM tj_order_goody WHERE ord_id=$ord_id");
			$this->db->query("DELETE FROM t_order_ord WHERE ord_id=$ord_id");
			$this->db->trans_complete();
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
					goo_name, goo_price, goo_image, goo_id, goo_description, goo_quantity,
					typ_id, typ_name
					FROM t_goody_goo JOIN t_goody_type_typ USING (typ_id)";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getGoodiesByType($typ_id) {
			$sql = "
				SELECT
				goo_name, goo_image, goo_id, goo_description, goo_price, goo_quantity,
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
					cpt_username=? AND cpt_password=SHA2(?, 256)
					AND cpt_status != 'N'";
			$values = array(
				'cpt_username' => $pseudo,
				'cpt_password' => $password
			);
			$query = $this->db->query($sql, $values);
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
					prf_prenom = ?,
					prf_nom = ?,
					prf_email = ?
				WHERE prf_id = (SELECT prf_id FROM t_compte_cpt WHERE cpt_id = $cpt_id)";
			$values = array(
				'prf_prenom' => $first_name,
				'prf_nom' => $last_name,
				'email' => $email
			);
			$query = $this->db->query($sql, $values);
			$query = $this->db->query("SELECT * FROM t_compte_cpt JOIN t_profil_prf USING (prf_id) WHERE cpt_id = $cpt_id");
			return $query->row();
		}

		public function createUser() {
			$prf_array = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email')
			);
			$cpt_array = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'cpt_status' => $this->input->post('type'),
				'wit_id' => $this->input->post('wit_id')
			);
			$sql = "
				INSERT INTO t_profil_prf (prf_nom, prf_prenom, prf_email)
				VALUES (?, ?, ?);
			";
			$this->db->query($sql, $prf_array);
			$sql = "
				INSERT INTO t_compte_cpt(cpt_username, cpt_password, cpt_status, wit_id, prf_id, cpt_created_at)
				VALUES (?, SHA2(?, 256), ?, ?, (SELECT MAX(prf_id) FROM t_profil_prf), NOW());
			";
			$query = $this->db->query($sql, $cpt_array);
			$query = $this->db->query("SELECT MAX(cpt_id) FROM t_compte_cpt");
			return $query->row();
		}

		// Points de retrait
		public function getWithdrawalPoints() {
			$sql = "
				SELECT * FROM t_withdrawal_point_wit
			";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getWithdrawalPointOrders() {
			$cpt_id = (int) $this->session->cpt_id;
			$sql = "
				SELECT wit_id FROM t_compte_cpt WHERE cpt_id=$cpt_id;
			";
			$query = $this->db->query($sql);
			$wit_id = $query->row()->wit_id;
			$sql = "
				SELECT
					ord_id, ord_max_date, ord_email, ord_price, ord_created_at, ord_identification, ord_code, ord_status
				FROM t_order_ord
				WHERE wit_id=$wit_id
				ORDER BY ord_id DESC
			";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function addToCard() {
			$goo_id = $this->input->post('goo_id');			$goo_name = $this->input->post('goo_name');
			$goo_image = $this->input->post('goo_image');	$goo_price = $this->input->post('goo_price');
			$qty = $this->input->post('qty');				$goo_description = $this->input->post('goo_description');
			$stock = $this->input->post('goo_quantity');

			if(is_null($goo_id) || is_null($goo_price) || is_null($qty) || $qty == 0) return;

			$data = array(
				'goo_id' => (int) $goo_id, 'goo_price' => (float)$goo_price, 'goo_qty' => (int)$qty,
				'goo_name' => $goo_name, 'goo_image' => $goo_image, 'goo_description' => $goo_description,
				'stock' => $stock
			);

			// Si le panier n'existe pas encore.
			if(!$this->session->has_userdata('cart')) $this->session->set_userdata('cart', array());
			$cart = $this->session->userdata('cart');
			$goody_exists = false;

			foreach ($cart as $id => $el) {
				if($el['goo_id'] == $data['goo_id']) {
					$cart[$id]['goo_qty'] += $data['goo_qty'];
					$goody_exists = true;
				}
			}

			if($goody_exists == false) {
				$id = count($cart) + 1;
				$cart = array_merge($cart, array($id => $data));
			}

			$this->session->set_userdata('cart', $cart);
			return $this->session->userdata('cart');
		}

		public function updateCard() {
			$id = $this->input->post('id');
			$qty = (int) $this->input->post('num_goodies');

			$cart = $this->session->cart;
			if($qty <= 0)
				unset($cart[$id]);
			else
				$cart[$id]['goo_qty'] = $qty;

			$this->session->set_userdata('cart', $cart);
		}

		public function saveOrderInformations() {
			$data = array(
				"ord_first_name" => $this->input->post('first_name'),
				"ord_last_name" => $this->input->post('last_name'),
				"ord_email" => $this->input->post('email'),
				"wit_id" => $this->input->post('wit_id'),
				"ord_code" => $this->getRandomString(20),
				"ord_identification" => $this->getRandomString(8),
				"ord_price" => $this->session->userdata('total_price')
			);

			$sql = "
				INSERT INTO t_order_ord (ord_first_name, ord_last_name, ord_email, wit_id, ord_code, ord_identification, ord_price, ord_status, ord_created_at, ord_max_date)
				VALUES (?, ?, ?, ?, ?, ?, ?, 'D', NOW(), ADDDATE(NOW(), INTERVAL 30 DAY))
			";

			$query = $this->db->query($sql, $data);

			// On vide le panier.
			$cart = $this->session->userdata('cart');
			$this->session->unset_userdata('cart');
			$this->session->unset_userdata('total_price');

			$sql = "SELECT MAX(ord_id) AS ord_id FROM t_order_ord";
			$query = $this->db->query($sql);
			$ord_id = $query->row()->ord_id;
			foreach($cart as $c) {
				$values =  array('ord_id' => $ord_id, 'goo_id' => $c['goo_id'], 'qty' => $c['goo_qty']);
				$this->db->insert('tj_order_goody', $values);
				$sql = "SELECT goo_quantity FROM t_goody_goo WHERE goo_id = " . $c['goo_id'];
				$query = $this->db->query($sql);
				$this->db->where('goo_id', $c['goo_id']);
				$this->db->update('t_goody_goo', array('goo_quantity' => $query->row()->goo_quantity - $c['goo_qty']));
			}

			$sql = "SELECT ord_max_date FROM t_order_ord WHERE ord_id = (SELECT max(ord_id) FROM t_order_ord)";
			$query = $this->db->query($sql);

			return $query->row();
		}

		public function getRandomString($size) {
			$values = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			return substr(str_shuffle($values), 0, $size);
		}

		// News
		public function getNews() {
			$sql = "
				SELECT
					new_id, new_title, new_content, new_created_at,
					ori_name, ori_image, cpt_username
				FROM t_news_new
				JOIN t_original_ori USING (ori_id)
				JOIN t_compte_cpt USING (cpt_id);
			";
			$query = $this->db->query($sql);
			return $query->result();
		}
	}

