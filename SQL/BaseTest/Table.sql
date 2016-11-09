/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     08/11/2016 13:30:17                          */
/*==============================================================*/


drop table if exists AVIS;

drop table if exists COMMANDE;

drop table if exists COMMANDEENREGISTREES;

drop table if exists COMPATIBILITE;

drop table if exists IMAGE;

drop table if exists PREFERENCE;

drop table if exists PRODUIT;

drop table if exists QUANTITEPRODUIT;

drop table if exists TYPEPRODUIT;

drop table if exists UTILISATEUR;

drop table if exists VOTE;

/*==============================================================*/
/* Table: AVIS                                                  */
/*==============================================================*/
create table AVIS
(
   NOTE                 int not null default 5,
   AVIS                 varchar(1024),
   DATE                 date not null,
   DATEDERNIERVOTE      date,
   NUMUSER              int not null,
   primary key (NUMUSER)
);

/*==============================================================*/
/* Table: COMMANDE                                              */
/*==============================================================*/
create table COMMANDE
(
   NUMCOMMANDE          int not null,
   RUE                  varchar(250),
   DATE                 date,
   VILLE                varchar(200),
   NUMRUE               numeric(8,0),
   CODEPOSTAL           varchar(6),
   TYPECOMMANDE         varchar(200) not null,
   primary key (NUMCOMMANDE)
);

/*==============================================================*/
/* Table: COMMANDEENREGISTREES                                  */
/*==============================================================*/
create table COMMANDEENREGISTREES
(
   NUMCOMMANDE          int not null,
   NUMUSER              int not null,
   primary key (NUMCOMMANDE, NUMUSER)
);

/*==============================================================*/
/* Table: COMPATIBILITE                                         */
/*==============================================================*/
create table COMPATIBILITE
(
   NUMPRODUIT           int not null,
   NUMPRODUIT2          int not null,
   primary key (NUMPRODUIT, NUMPRODUIT2)
);

/*==============================================================*/
/* Table: IMAGE                                                 */
/*==============================================================*/
create table IMAGE
(
   NUMIMAGE             int not null,
   SOURCEMOYEN          varchar(1024) not null,
   SOURCEPETIT          varchar(1024),
   SOURCEGRAND          varchar(1024),
   primary key (NUMIMAGE)
);

/*==============================================================*/
/* Table: PREFERENCE                                            */
/*==============================================================*/
create table PREFERENCE
(
   NUMUSER              int not null,
   NUMPRODUIT           int not null,
   CLASSEMENT           numeric(2,0),
   primary key (NUMUSER, NUMPRODUIT)
);

/*==============================================================*/
/* Table: PRODUIT                                               */
/*==============================================================*/
create table PRODUIT
(
   NUMPRODUIT           int not null,
   NUMIMAGE             int not null,
   DESCRIPTION          varchar(512) not null,
   PRIX                 numeric(8,0) not null,
   TYPEPRODUIT          varchar(100) not null,
   LIBELLE              varchar(50) not null,
   primary key (NUMPRODUIT)
);

/*==============================================================*/
/* Table: QUANTITEPRODUIT                                       */
/*==============================================================*/
create table QUANTITEPRODUIT
(
   NUMCOMMANDE          int not null,
   NUMPRODUIT           int not null,
   QUANTITE             int,
   primary key (NUMCOMMANDE, NUMPRODUIT)
);

/*==============================================================*/
/* Table: TYPEPRODUIT                                           */
/*==============================================================*/
create table TYPEPRODUIT
(
   LIBELLE              varchar(50) not null,
   primary key (LIBELLE)
);

/*==============================================================*/
/* Table: UTILISATEUR                                           */
/*==============================================================*/
create table UTILISATEUR
(
   NUMUSER              int not null,
   NOM                  varchar(20) not null,
   PRENOM               varchar(20) not null,
   MAIL                 varchar(50) not null,
   VILLE                varchar(200),
   RUE                  varchar(250),
   CODEPOSTAL           varchar(6),
   TELEPHONE            varchar(11),
   TYPEUSER             varchar(20) not null,
   PSEUDO               varchar(25) not null,
   MDP                  varchar(1024) not null,
   NUMRUE               varchar(100),
   DATEINSCRIPTION      date,
   primary key (NUMUSER)
);

/*==============================================================*/
/* Table: VOTE                                                  */
/*==============================================================*/
create table VOTE
(
   NUMAVIS              int not null,
   NUMUSER              int not null,
   VOTE                 bool,
   primary key (NUMAVIS, NUMUSER)
);

alter table AVIS add constraint FK_POSTE_UN2 foreign key (NUMUSER)
      references UTILISATEUR (NUMUSER) on delete restrict on update restrict;

alter table COMMANDEENREGISTREES add constraint FK_PASSE_UNE foreign key (NUMCOMMANDE)
      references COMMANDE (NUMCOMMANDE) on delete restrict on update restrict;

alter table COMMANDEENREGISTREES add constraint FK_PASSE_UNE2 foreign key (NUMUSER)
      references UTILISATEUR (NUMUSER) on delete restrict on update restrict;

alter table COMPATIBILITE add constraint FK_EST_COMPATIBLE foreign key (NUMPRODUIT2)
      references PRODUIT (NUMPRODUIT) on delete restrict on update restrict;

alter table COMPATIBILITE add constraint FK_EST_COMPATIBLE2 foreign key (NUMPRODUIT)
      references PRODUIT (NUMPRODUIT) on delete restrict on update restrict;

alter table PREFERENCE add constraint FK_PREFERE foreign key (NUMPRODUIT)
      references PRODUIT (NUMPRODUIT) on delete restrict on update restrict;

alter table PREFERENCE add constraint FK_PREFERE2 foreign key (NUMUSER)
      references UTILISATEUR (NUMUSER) on delete restrict on update restrict;

alter table PRODUIT add constraint FK_APPARTIENT foreign key (LIBELLE)
      references TYPEPRODUIT (LIBELLE) on delete restrict on update restrict;

alter table PRODUIT add constraint FK_POSSEDE3 foreign key (NUMIMAGE)
      references IMAGE (NUMIMAGE) on delete restrict on update restrict;

alter table QUANTITEPRODUIT add constraint FK_CONTIENT foreign key (NUMPRODUIT)
      references PRODUIT (NUMPRODUIT) on delete restrict on update restrict;

alter table QUANTITEPRODUIT add constraint FK_CONTIENT2 foreign key (NUMCOMMANDE)
      references COMMANDE (NUMCOMMANDE) on delete restrict on update restrict;

alter table VOTE add constraint FK_VOTE foreign key (NUMAVIS)
      references AVIS (NUMUSER) on delete restrict on update restrict;

alter table VOTE add constraint FK_VOTE2 foreign key (NUMUSER)
      references UTILISATEUR (NUMUSER) on delete restrict on update restrict;

