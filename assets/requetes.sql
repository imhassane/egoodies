# -------------- ACTUALITES -------------------------------
# 1. Toutes les actualités et le login de l'utilisateur.
select
    new_id, new_title, new_content, new_created_at,
    tcc.cpt_id, cpt_username
from t_news_new
join t_compte_cpt tcc on t_news_new.cpt_id = tcc.cpt_id;

# 2. Données d'une actualité dont on connait l'id.
select
    new_id, new_title, new_content, new_created_at,
    tcc.cpt_id, cpt_username
from t_news_new
join t_compte_cpt tcc on t_news_new.cpt_id = tcc.cpt_id
where new_id = 2;


# 3. 5 dernières actualités dans l'ordre décroissant.
select
    new_id, new_title, new_content, new_created_at
from t_news_new
order by new_id desc limit 5;

# 4. Actualités contenant un mot particulier
select
    new_id, new_title, new_content, new_created_at
from t_news_new
where new_title LIKE '%c%'
order by new_id desc;

# 5. Actualités postées à une date particulière avec login de l'auteur.
select
    new_id, new_title, new_content, new_created_at,
    tcc.cpt_id, cpt_username
from t_news_new
join t_compte_cpt tcc on t_news_new.cpt_id = tcc.cpt_id
where YEAR(new_created_at) = 2019
  and MONTH(new_created_at) = 11
  and DAY(new_created_at) = 13
order by new_id desc;

# 6. Rajout d'une actualité
INSERT INTO t_news_new (new_id, new_title, new_content, cpt_id, ori_id, new_created_at)
VALUES (
        NULL, "Les Warriors dans un grand trouble", "Cette équipe perd des matchs, trop de match", 1, 11, NOW()
);

# 7. Requetes affichant toutes les actualités postées par un utilisateur.
SELECT *
FROM t_news_new
JOIN t_compte_cpt tcc on t_news_new.cpt_id = tcc.cpt_id
WHERE tcc.cpt_id = 1;

# 8. Toutes les actualités postées avant une date.
SELECT *
FROM t_news_new
WHERE DATEDIFF(new_created_at, '2019-10-14') < 0;

# 9. Modification d'une actualité
UPDATE t_news_new
    SET new_title = "",
        new_content = ""
    WHERE new_id = 4;

# 10. Compte les actualités postées avant une certaine date.
SELECT COUNT(new_id) AS NOMBRE_DACTUALITE
    FROM t_news_new
WHERE DATEDIFF(new_created_at, '2019-10-14') < 0;

# 11. Suppression d'une actualité à partir de son id.
DELETE FROM t_news_new
    WHERE new_id = 4;

# 12. Suppression des actualités postées par un auteur.
DELETE from t_news_new
    WHERE cpt_id = 4;

# ------------ ORIGINAUX ET CATEGORIES --------------------------------------
# 1. Liste de tous les originaux.
SELECT *
FROM t_original_ori;

# 2. Originaux classés par catégorie.
SELECT
    ori_id, ori_name, ori_description, ori_image, ori_created_at, cat_name
FROM t_original_ori
JOIN t_category_cat tcc on t_original_ori.cat_id = tcc.cat_id
ORDER BY tcc.cat_id;

# 3. Données d'un original et ses goodies associés.
SELECT
    ori_name, ori_description, ori_image, ori_created_at,
    goo_name, goo_description, goo_image, goo_quantity, goo_price, typ_id, goo_created_at
FROM t_original_ori
JOIN tj_goody_original tgo on t_original_ori.ori_id = tgo.ori_id
JOIN t_goody_goo tgg on tgo.goo_id = tgg.goo_id;

# 4. Originaux d'une catégorie particulière.
SELECT
    ori_name, ori_id, ori_description
FROM t_original_ori
WHERE cat_id = 1;

# 5. Liste de toutes les catégories (+ originaux si il y'en a)
SELECT
    cat_name,
    ori_name
FROM t_category_cat
LEFT JOIN t_original_ori too on t_category_cat.cat_id = too.cat_id;

# 6. Liste des originaux ayant des goodies multiples
SELECT
    ori_name, COUNT(goo_id) AS NOMBRE_GOODIES
FROM t_original_ori
JOIN tj_goody_original tgo on t_original_ori.ori_id = tgo.ori_id
GROUP BY t_original_ori.ori_id
HAVING NOMBRE_GOODIES > 1;

# 7. Requête listant tous les originaux (+ catégorie) et leurs goodies associés (+ type), s’il y en a
SELECT
    ori_name, cat_name, typ_name
FROM t_original_ori
LEFT JOIN t_category_cat tcc on t_original_ori.cat_id = tcc.cat_id
LEFT JOIN tj_goody_original tgo on t_original_ori.ori_id = tgo.ori_id
LEFT JOIN t_goody_goo tgg on tgo.goo_id = tgg.goo_id
LEFT JOIN t_goody_type_typ tgtt on tgg.typ_id = tgtt.typ_id;

# 8. Requête listant tous administrateurs et leur(s) originaux (+ catégories)
SELECT
    cpt_username, new_title, cat_name
FROM t_compte_cpt
JOIN t_news_new tnn on t_compte_cpt.cpt_id = tnn.cpt_id
JOIN t_original_ori too on tnn.ori_id = too.ori_id
JOIN t_category_cat tcc on too.cat_id = tcc.cat_id
WHERE cpt_status = 'A';

# 9. Requête listant tous les originaux qui ne sont plus liés à un administrateur
SELECT
    cpt_username, new_title, cat_name
FROM t_compte_cpt
JOIN t_news_new tnn on t_compte_cpt.cpt_id = tnn.cpt_id
JOIN t_original_ori too on tnn.ori_id = too.ori_id
JOIN t_category_cat tcc on too.cat_id = tcc.cat_id
WHERE cpt_status != 'A';

# 10. Requête listant, pour un administrateur dont on connaît le login, tous les originaux qu’il a ajoutés (+ catégorie + goodies), s’il y en a
SELECT
    cpt_username, new_title, cat_name, goo_name
FROM t_compte_cpt
left JOIN t_news_new tnn on t_compte_cpt.cpt_id = tnn.cpt_id
left JOIN t_original_ori too on tnn.ori_id = too.ori_id
left JOIN t_category_cat tcc on too.cat_id = tcc.cat_id
left JOIN tj_goody_original tgo on too.ori_id = tgo.ori_id
left JOIN t_goody_goo tgg on tgo.goo_id = tgg.goo_id
WHERE t_compte_cpt.cpt_id = 1;

# 11. Requête donnant la catégorie d’un original en particulier
SELECT
    cat_name
FROM t_category_cat
JOIN t_original_ori too on t_category_cat.cat_id = too.cat_id
WHERE ori_id = 2;

# --------------- GOODIES & TYPES ----------------------------------

# 1. Requête listant tous les goodies.
SELECT
    *
FROM t_goody_goo;

# 2.  Requête listant tous les goodies classés par type
SELECT
    goo_id, goo_name, typ_name
FROM t_goody_goo
JOIN t_goody_type_typ tgtt on t_goody_goo.typ_id = tgtt.typ_id
ORDER BY tgtt.typ_id DESC;

# 3. Requête récupérant les données d’un goodie particulier
SELECT
    *
FROM t_goody_goo
WHERE goo_id = 1;

# 4.  Requête comptant le nombre total de goodies présents dans la base
SELECT
    COUNT(goo_id) AS NOMBRE_TOTAL_GOODIES
FROM t_goody_goo;

# 5. Requête donnant la liste de tous les goodies associés à un original particulier
SELECT
    goo_name
FROM t_goody_goo
JOIN tj_goody_original tgo on t_goody_goo.goo_id = tgo.goo_id
JOIN t_original_ori too on tgo.ori_id = too.ori_id
WHERE too.ori_id = 1;

# 6. Requête récupérant le prix unitaire d’un goodie
SELECT
    goo_price
FROM t_goody_goo
WHERE goo_id = 1;

# 7. Requête récupérant le stock d’un goodie
SELECT
    goo_quantity
FROM t_goody_goo
WHERE goo_id = 1;

# 8. Requête donnant les goodies dont le stock est épuisé
SELECT
    goo_name
FROM t_goody_goo
WHERE goo_quantity = 0;

# 9.  Requête donnant la liste des goodies associés à un seul original
SELECT
    goo_name, COUNT(tgo.ori_id) AS NOMBRE_ORIGINAL
FROM t_goody_goo
JOIN tj_goody_original tgo on t_goody_goo.goo_id = tgo.goo_id
GROUP BY tgo.ori_id
HAVING NOMBRE_ORIGINAL = 1;

# 10.  Requête donnant le type d’un goodie particulier
SELECT
    goo_name, typ_name
FROM t_goody_goo
JOIN t_goody_type_typ tgtt on t_goody_goo.typ_id = tgtt.typ_id
WHERE goo_id = 2;

# 11. Requête listant tous les types de goodie et les goodies associés, s’il y en a
SELECT
    typ_name, goo_name
FROM t_goody_type_typ
LEFT JOIN t_goody_goo tgg on t_goody_type_typ.typ_id = tgg.typ_id;

# 12. Requête listant tous les goodies d’un type particulier
SELECT
    typ_name, goo_name
FROM t_goody_type_typ
JOIN t_goody_goo tgg on t_goody_type_typ.typ_id = tgg.typ_id
WHERE tgg.typ_id = 2;

# 13. Requête donnant la liste des goodies multiples (liés à plusieurs originaux).
SELECT
    goo_name, COUNT(tgo.ori_id) AS NOMBRE_ORIGINAUX
FROM t_goody_goo
JOIN tj_goody_original tgo on t_goody_goo.goo_id = tgo.goo_id
GROUP BY tgo.goo_id HAVING NOMBRE_ORIGINAUX > 1;

# 14. Requête mettant à jour le stock d’un goodie particulier en lui rajoutant 3 unités.
SELECT goo_quantity INTO @GOODY_QTY FROM t_goody_goo WHERE goo_id = 1;
UPDATE t_goody_goo
    SET goo_quantity = @GOODY_QTY + 3
WHERE goo_id = 1;

# 15. Requête mettant à jour le stock d’un goodie particulier en lui enlevant 2 unités
SELECT goo_quantity INTO @GOODY_QTY FROM t_goody_goo WHERE goo_id = 1;
UPDATE t_goody_goo
    SET goo_quantity = @GOODY_QTY - 2
WHERE goo_id = 1;

# ------------ PROFILS (ADMINISTRATEURS / VENDEURS) --------------------------------------
# 1. Requête listant toutes les données de tous les profils
SELECT
    cpt_id, cpt_username, cpt_password, cpt_status,
    prf_created_at, prf_nom, prf_prenom, prf_email
FROM t_compte_cpt
JOIN t_profil_prf tpp on t_compte_cpt.prf_id = tpp.prf_id;

# 2.  Requête listant les données des profils des vendeurs (/des administrateurs)
SELECT
    cpt_id, cpt_username, cpt_password, cpt_status,
    prf_created_at, prf_nom, prf_prenom, prf_email
FROM t_compte_cpt
JOIN t_profil_prf tpp on t_compte_cpt.prf_id = tpp.prf_id
WHERE cpt_status = 'V';

SELECT
    cpt_id, cpt_username, cpt_password, cpt_status,
    prf_created_at, prf_nom, prf_prenom, prf_email
FROM t_compte_cpt
JOIN t_profil_prf tpp on t_compte_cpt.prf_id = tpp.prf_id
WHERE cpt_status = 'A';

# 3. Requête de vérification des données de connexion (login et mot de passe)
SELECT COUNT(cpt_id) AS EXISTE
FROM t_compte_cpt
WHERE cpt_username='' AND cpt_password=SHA2('', 256);

# 4. Requête récupérant les données d'un profil particulier (utilisateur connecté)
SELECT
    cpt_id, cpt_username, cpt_password, cpt_status,
    prf_created_at, prf_nom, prf_prenom, prf_email
FROM t_compte_cpt
JOIN t_profil_prf tpp on t_compte_cpt.prf_id = tpp.prf_id
WHERE cpt_id = 1;

# 5. Requête récupérant tous les logins des profils
SELECT
       cpt_username
FROM t_compte_cpt;

# 6. Requête d'ajout des données d'un profil
INSERT INTO t_profil_prf(prf_id, prf_nom, prf_prenom, prf_email)
VALUES (NULL, "", "", "");
SELECT MAX(prf_id) INTO @LAST_PRF FROM t_profil_prf;
INSERT INTO t_compte_cpt(cpt_id, cpt_username, cpt_password, cpt_status, prf_id, cpt_created_at)
VALUES (NULL, "", SHA2("", 256), "N", @LAST_PRF, NOW());

# 7. Requête de modification des données d'un profil
UPDATE t_profil_prf
    SET prf_email = "", prf_prenom = "", prf_nom = ""
WHERE prf_id = 1;

# 8. Requête de mise à jour du mot de passe.
UPDATE t_compte_cpt
    SET cpt_password = SHA2("", 256)
WHERE cpt_id = 1;

# 9. Requête de désactivation d'un profil
UPDATE t_compte_cpt
    SET cpt_status = "D"
WHERE cpt_id = 1;

# 10. Requête(s) de suppression d’un profil administrateur et des données associées à ce profil (sans supprimer les originaux !)
SET @ADMIN_ID = 1;
SELECT prf_id INTO @PRF_ID FROM t_compte_cpt WHERE cpt_id = @ADMIN_ID;
DELETE FROM t_profil_prf WHERE prf_id = @PRF_ID;

DELETE FROM t_news_new
WHERE new_id IN (
    SELECT new_id
    FROM t_news_new
    JOIN t_compte_cpt tcc on t_news_new.cpt_id = tcc.cpt_id
    WHERE tcc.cpt_id = @ADMIN_ID
);
DELETE FROM t_goody_goo
WHERE goo_id IN (
    SELECT goo_id
    FROM t_news_new
    JOIN t_original_ori too on t_news_new.ori_id = too.ori_id
    JOIN tj_goody_original tgo on too.ori_id = tgo.ori_id
    WHERE cpt_id = @ADMIN_ID
);
# A finir

# ------------- POINTS DE RETRAIT --------------------
# 1. Requête listant tous les points de retrait
SELECT *
FROM t_withdrawal_point_wit;

# 2.Requête listant tous les points de retrait et leurs commandes, s’il y en a
SELECT
    wit_name,
    ord_code, ord_price
FROM t_withdrawal_point_wit
LEFT JOIN t_order_ord too on t_withdrawal_point_wit.wit_id = too.wit_id;

# 3. Requête listant tous les points de retrait et les vendeurs associés, s’il y en a
# A faire

# 4. Requête listant tous les points de retrait et les commandes associées en cours (/expirées), s’il y en a
SELECT
    wit_name
FROM t_withdrawal_point_wit
LEFT JOIN t_order_ord too on t_withdrawal_point_wit.wit_id = too.wit_id
WHERE DATEDIFF(ord_max_date, now()) > 0;

SELECT
    wit_name
FROM t_withdrawal_point_wit
LEFT JOIN t_order_ord too on t_withdrawal_point_wit.wit_id = too.wit_id
WHERE DATEDIFF(ord_max_date, now()) < 0;

# 5. Requête ajoutant les données d’un point de retrait
INSERT INTO t_withdrawal_point_wit(wit_id, wit_adress, wit_name)
VALUES (NULL, "", "", "");

# 6. Requête modifiant les données d’un point de retrait
UPDATE t_withdrawal_point_wit
SET
    wit_name = "", wit_adress = ""
WHERE wit_id = 1;

# 7. Requête listant tous les vendeurs d’un point de retrait particulier
# A faire

# 8. Requête(s) de suppression d’un point retrait (+ vendeurs) et de ré-attribution de ses commandes à un autre point de retrait dont on connaît l’identifiant
# A faire

# ------------------ COMMANDES & PANIER ---------------------------------
# 1. Requête calculant le montant total (prix à payer) d’une commande
SET @ORDER_ID = 1;
SELECT SUM(goo_price * qty) as PRIX
FROM t_goody_goo
JOIN tj_order_goody tog on t_goody_goo.goo_id = tog.goo_id
WHERE tog.ord_id = @ORDER_ID;

# 2. Requête comptant le nombre d’articles d’une commande particulière
SET @ORDER_ID = 1;
SELECT COUNT(goo_id) AS NOMBRE_ARTICLES
FROM tj_order_goody
WHERE ord_id = @ORDER_ID;

# 3. Requête(s) de création d’une commande
# A faire
