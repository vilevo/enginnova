INSERT INTO categories (id_categorie,name,created_at,updated_at) 
VALUES (1, 'developpement web', NULL, NULL),
		(2, 'developpement mobil', NULL, NULL),
		(3, 'maths', NULL, NULL),
		(4, 'genie civil', NULL, NULL),
		(5, 'graphisme', NULL, NULL),
		(6, 'devops', NULL, NULL),
		(7, 'chimie', NULL, NULL),
		(8, 'physique', NULL, NULL),
		(9, 'bureautique', NULL, NULL),
		(10, 'finance', NULL, NULL);

INSERT INTO booster_forfaits (id,name,created_at,updated_at) 
VALUES (1, 'une semaine', NULL, NULL),
	   (2, 'deux semaines', NULL, NULL);

INSERT INTO roles (id,name)
	VALUE ('1','user'),
		  ('2','admin');

INSERT INTO role_user (id,name)
	VALUE ('2','1');