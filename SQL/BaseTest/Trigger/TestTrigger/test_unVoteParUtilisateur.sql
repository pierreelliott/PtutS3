/* On essaye de voter 2 fois au meme avis avec le meme utilisateur */

Insert into vote(NumAvis, NUMUSER, Vote)
values
(1, 3, true),
(1, 3, true);
