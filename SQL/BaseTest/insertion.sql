/* Table Utilisateur */
insert into utilisateur(Nom, Prenom,Mail, Ville, Rue, CodePostal, Telephone, TypeUser, Pseudo, MDP, NumRue)
values
("Menvu","Gérard","adr@mail.fr",null,null,null,"0404040404","ADMIN","gmenvu","1234", null),
("Atan","Charles","addmail.en",null,null,null,"0505050505","USER","catan","2345", null),
("Doeuf","John","ddd@mail.us",null,null,null,"0202020202","USER","jdoeuf","3456",null),
("Pietrac","Nicolas","aha@mail.net","Ploubelec","rue des Alouettes","14100","0606060606","USER","npietrac","4567", "42");


/* Table Avis (numuser,note,avis,date,datederniervote) */
insert into avis (NumUser,Note,Avis,Date,DateDernierVote)
values
(2, 4, null, "2014-10-02",null),
(3, 6, "Super !", "2015-06-20", "2016-11-02"),
(4, 8, "Miam.", "2015-09-30", "2016-10-15");




/* Table Vote (numuser_avis,numuser,vote(1>like,0>dislike/ mysql>boolean=tinyint)) */
insert into vote(NumAvis, NumUser, Vote)  values
(2,4, false),
(3,4, true),
(3,2,true),
(4,2,false),
(4,3,false);

/* Table Image */
insert into image(SourcePetit, SourceMoyen, SourceGrand) values
("src/img/img001","src/img/img002","src/img/img003"),
("src/img/img101","src/img/img102","src/img/img103"),
("src/img/img201","src/img/img202","src/img/img203"),
("src/img/img301","src/img/img302","src/img/img303"),
("src/img/img401","src/img/img402","src/img/img403"),
("src/img/img501","src/img/img502","src/img/img503"),
("src/img/img601","src/img/img602","src/img/img603");



/* Table TypeProduit */
insert into typeProduit values
("Sushi"),
("Sauce"),
("Accompagnement"),
("Algue"),
("Maki"),
("Menu.Jour");


/* Table Produit (numproduit,libelle,prix,description,typeproduit,numimage)*/
insert into produit(numProduit, Libelle, Prix,Description, TypeProduit, NumImage) values
(1, "Sushi noss",10,"Sushi au saumon","Sushi",2),
(2, "Ketchup",1,"Sauce de base","Sauce",3),
(3, "Rix titi",3,"Riz au lait","Accompagnement",4),
(4, "Makizu chichi",8,"Maki au poulet","Maki",5),
(5, "Sushi rah",8,"Sushi au cabillaud","Sushi",6),

(6, "Algues au crabe",9,"Boîte d'algues rouges","Algue",7),
(7, "Algues du fermier",7,"Boîte d'algues vertes qui font penser à de l'herbe","Algue",7),
(8, "Algues arc-en-ciel",12,"Boîte d'algues multicolores","Algue",7),

(9, "Algues à gogo",22,"Dégustez une savoureuse sélection d'algues","Menu.Jour",null),
(10, "Saké pateux",1,"Ces japonais sont vraiment bizarres...","Sauce",3),
(11, "Le suprême Suhinos",10,"Dégustez une savoureuse sélection de sushis","Menu.Jour",null),
(12, "Le maki de l'extrême",15,"Attention, ça pique !","Menu.Jour",null);

/* Table Commande (numcommande,date,codepostal,ville,rue,numrue,typecommande)*/
insert into commande(Date, CodePostal, Ville, Rue, NumRue, TypeCommande, NumUser) values
("2015-10-02",null,null,null,null,"A emporter", 4),
("2015-11-04", null,null, null,null, "A Emporter", 3),
("2015-12-07", "07100", "Pietache", "Rue de l honneur", "35", "Livraison", 2);


/* Table QuantiteProduit */
insert into quantiteProduit (NumCommande,NumProduit,Quantite)
values
(1,1,2), (1,2,1),
(1,6,1), (2,3,4),
(2,5,1), (3,4,2),
(3,2,4), (3,3,2);

/* Table Compatibilite (numproduit,numproduit2) */
insert into compatibilite (NumProduit, NumProduit2) values
	(1,2), (5,2), (3,2), (1,3), (4,6), (5,6),
	(9,6), (9,7), (9,8), (9,10),
	(11,1), (11,2), (11,3),
	(12,4), (12,5), (12,10);

/* Table Preference (numuser,numproduit,classement)*/
insert into preference (NumUser,NumProduit,Classement)
values
(4,1,1),
(4,3,2),
(3,3,1);
