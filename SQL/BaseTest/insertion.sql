/* Table Utilisateur */
insert into utilisateur(NumUser, Nom, Prenom,Mail, Ville, Rue, CodePostal, Telephone, TypeUser, Pseudo, MDP, NumRue)
values(1,"Menvu","Gérard","adr@mail.fr",null,null,null,"0404040404","ADMIN","gmenvu","1234", null),
(2,"Atan","Charles","addmail.en",null,null,null,"0505050505","USER","catan","2345", null), (3,"Doeuf","John","ddd@mail.us",null,null,null,"0202020202","USER","jdoeuf","3456",null),
(4,"Pietrac","Nicolas","aha@mail.net","Ploubelec","rue des Alouettes","14100","0606060606","USER","npietrac","4567", "42");




/* Table Avis (numuser,note,avis,date,datederniervote) */
insert into avis (NumUser,Note,Avis,Date,DateDernierVote)
values(2, 4, null, "2014-10-02",null), 
(3, 6, "Super !", "2015-06-20", "2016-11-02"),
(4, 8, "Miam.", "2015-09-30", "2016-10-15");




/* Table Vote (numuser_avis,numuser,vote(1>like,0>dislike/ mysql>boolean=tinyint)) */
insert into vote(NumAvis, NumUser, Vote)  values(2, 4, false),
(3,4, true),
(3,2,true),
(4,2,false),
(4,3,false);




/* Table Commande (numcommande,date,codepostal,ville,rue,numrue,typecommande)*/
insert into commande(NumCommande, Date, CodePostal, Ville, Rue, NumRue, TypeCommande) values(1,"2015-10-02",null,null,null,null,"A emporter"),
(2, "2015-11-04", null,null, null,null, "A Emporter"),
(3, "2015-12-07", "07100", "Pietache", "Rue de l honneur", "35", "Livraison");




/* Table QuantiteProduit */
insert into QuantiteProduit (NumCommande,NumProduit,Quantite)
values (1,1,2), (1,2,1), (1,6,1),
(2,3,4), (2,5,1),
(3,4,2),(3,2,4),(3,3,2);




/* Table CommandeEnregistrees */
insert into CommandeEnregistrees(NumCommande, NumUser) values (1,4),(2,3),(3,2);




/* Table Produit (numproduit,libelle,prix,description,typeproduit,numimage)*/
insert into produit(NumProduit, Libelle, Prix,Description, TypeProduit, NumImage) values(1,"Sushi noss",10,"Sushi au saumon","Sushi",2),
(2,"Ketchup",0.5,"Sauce de base","Sauce",3),
(3,"Rix titi",3,"Riz au lait","Accompagnement",4),
(4,"Makizu chichi",6,"Maki au poulet","Maki",5),
(5,"Sushi rah",5,"Sushi au cabillaud","Sushi",6), (6,"Alges à gogo",9,"Boîte d algues rouges","Accompagnement",7);




/* Table Compatibilite (numproduit,numproduit2) */
insert into Compatibilite (NumProduit, NumProduit2) values(1,2), (5,2), (3,2), (1,3), (4,6), (5,6);




/* Table Preference (numuser,numproduit,classement)*/
insert into Preference (NumUser,NumProduit,Classement) values(4,1,1), (4,3,2), (3,3,1);




/* Table TypeProduit */
insert into TypeProduit values("Sushi"), ("Sauce"), ("Accompagnement"), ("Maki");




/* Table Image */
insert into Image values(1,"src/img/img001","src/img/img002","src/img/img003"), (2,"src/img/img101","src/img/img102","src/img/img103"), (3,"src/img/img201","src/img/img202","src/img/img203"), (4,"src/img/img301","src/img/img302","src/img/img303"), (5,"src/img/img401","src/img/img402","src/img/img403"), (6,"src/img/img501","src/img/img502","src/img/img503"), (7,"src/img/img601","src/img/img602","src/img/img603");








