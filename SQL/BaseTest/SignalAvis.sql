create table signalavis
(
    numSignal           int not null AUTO_INCREMENT,
    remarque            varchar(1024),
    NUMAVIS             int not null,
    numUser             int not null,
    primary key(numSignal)
);

alter table signalavis add constraint FK_AVIS foreign key (NUMAVIS)
      references avis (NUMUSER) on delete restrict on update restrict;

alter table signalavis add constraint FK_USER foreign key (NUMUSER)
      references utilisateur (NUMUSER) on delete restrict on update restrict;
