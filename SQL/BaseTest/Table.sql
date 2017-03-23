/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     08/11/2016 13:30:17                          */
/*==============================================================*/

SET foreign_key_checks = 0;

drop table if exists avis;

drop table if exists commande;

drop table if exists compatibilite;

drop table if exists image;

drop table if exists preference;

drop table if exists produit;

drop table if exists quantiteProduit;

drop table if exists typeProduit;

drop table if exists utilisateur;

drop table if exists vote;

drop table if exists signalavis;

SET foreign_key_checks = 1;

/*==============================================================*/
/* Table: avis                                                  */
/*==============================================================*/
create table avis
(
   NOTE                 int not null default 5,
   AVIS                 varchar(1024),
   DATE                 date not null,
   DATEDERNIERVOTE      date,
   NUMUSER              int not null,
   primary key (NUMUSER)
);

/*==============================================================*/
/* Table: commande                                              */
/*==============================================================*/
create table commande
(
   NUMCOMMANDE          int not null AUTO_INCREMENT,
   RUE                  varchar(250),
   DATE                 date,
   VILLE                varchar(200),
   NUMRUE               numeric(8,0),
   CODEPOSTAL           varchar(6),
   TYPECOMMANDE         varchar(200) not null,
   NUMUSER              integer not null,
   primary key (NUMCOMMANDE)
);

/*==============================================================*/
/* Table: compatibilite                                         */
/*==============================================================*/
create table compatibilite
(
   NUMPRODUIT           int not null,
   NUMPRODUIT2          int not null,
   primary key (NUMPRODUIT, NUMPRODUIT2)
);

/*==============================================================*/
/* Table: image                                                 */
/*==============================================================*/
create table image
(
   NUMIMAGE             int not null AUTO_INCREMENT,
   SOURCEMOYEN          varchar(1024) not null,
   SOURCEPETIT          varchar(1024),
   SOURCEGRAND          varchar(1024),
   primary key (NUMIMAGE)
);

/*==============================================================*/
/* Table: preference                                            */
/*==============================================================*/
create table preference
(
   NUMUSER              int not null,
   NUMPRODUIT           int not null,
   CLASSEMENT           numeric(2,0),
   primary key (NUMUSER, NUMPRODUIT)
);

/*==============================================================*/
/* Table: produit                                               */
/*==============================================================*/
create table produit
(
   NUMPRODUIT           int not null AUTO_INCREMENT,
   NUMIMAGE             int,
   DESCRIPTION          varchar(512) not null,
   PRIX                 numeric(8,0) not null,
   TYPEPRODUIT          varchar(100) not null,
   LIBELLE              varchar(50) not null,
   primary key (NUMPRODUIT)
);

/*==============================================================*/
/* Table: quantiteProduit                                       */
/*==============================================================*/
create table quantiteProduit
(
   NUMCOMMANDE          int not null,
   NUMPRODUIT           int not null,
   QUANTITE             int,
   primary key (NUMCOMMANDE, NUMPRODUIT)
);

/*==============================================================*/
/* Table: typeProduit                                           */
/*==============================================================*/
create table typeProduit
(
   LIBELLE              varchar(50) not null,
   primary key (LIBELLE)
);

/*==============================================================*/
/* Table: utilisateur                                           */
/*==============================================================*/
create table utilisateur
(
   NUMUSER              int not null AUTO_INCREMENT,
   NOM                  varchar(20) not null,
   PRENOM               varchar(20) not null,
   MAIL                 varchar(50) not null,
   VILLE                varchar(200),
   RUE                  varchar(250),
   CODEPOSTAL           varchar(6),
   TELEPHONE            varchar(11) not null,
   TYPEUSER             varchar(20) not null,
   PSEUDO               varchar(25) not null,
   MDP                  varchar(1024) not null,
   NUMRUE               varchar(100),
   DATEINSCRIPTION      date,
   primary key (NUMUSER)
);

/*==============================================================*/
/* Table: vote                                                  */
/*==============================================================*/
create table vote
(
   NUMAVIS              int not null,
   NUMUSER              int not null,
   VOTE                 bool,
   primary key (NUMAVIS, NUMUSER)
);

create table signalavis
(
    numSignal           int not null AUTO_INCREMENT,
    remarque            varchar(1024),
    NUMAVIS             int not null,
    numUser             int not null,
    primary key(numSignal)
);

alter table avis add constraint FK_POSTE_UN2 foreign key (NUMUSER)
      references utilisateur (NUMUSER) on delete restrict on update restrict;

alter table commande add constraint FK_REFERENCE_12 foreign key (NUMUSER)
      references utilisateur (NUMUSER) on delete restrict on update restrict;

alter table compatibilite add constraint FK_EST_COMPATIBLE foreign key (NUMPRODUIT2)
      references produit (NUMPRODUIT) on delete restrict on update restrict;

alter table compatibilite add constraint FK_EST_COMPATIBLE2 foreign key (NUMPRODUIT)
      references produit (NUMPRODUIT) on delete restrict on update restrict;

alter table preference add constraint FK_PREFERE foreign key (NUMPRODUIT)
      references produit (NUMPRODUIT) on delete restrict on update restrict;

alter table preference add constraint FK_PREFERE2 foreign key (NUMUSER)
      references utilisateur (NUMUSER) on delete restrict on update restrict;

alter table produit add constraint FK_APPARTIENT foreign key (TYPEPRODUIT)
      references typeProduit (LIBELLE) on delete restrict on update restrict;

alter table produit add constraint FK_POSSEDE3 foreign key (NUMIMAGE)
      references image (NUMIMAGE) on delete restrict on update restrict;

alter table quantiteProduit add constraint FK_CONTIENT foreign key (NUMPRODUIT)
      references produit (NUMPRODUIT) on delete restrict on update restrict;

alter table quantiteProduit add constraint FK_CONTIENT2 foreign key (NUMCOMMANDE)
      references commande (NUMCOMMANDE) on delete restrict on update restrict;

alter table vote add constraint FK_VOTE foreign key (NUMAVIS)
      references avis (NUMUSER) on delete restrict on update restrict;

alter table vote add constraint FK_VOTE2 foreign key (NUMUSER)
      references utilisateur (NUMUSER) on delete restrict on update restrict;

alter table signalavis add constraint FK_AVIS foreign key (NUMAVIS)
      references avis (NUMUSER) on delete restrict on update restrict;

alter table signalavis add constraint FK_USER foreign key (NUMUSER)
      references utilisateur (NUMUSER) on delete restrict on update restrict;
