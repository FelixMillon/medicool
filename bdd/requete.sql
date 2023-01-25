
/*******************************************INSERTS*******************************************/
insert into mutuelle values(null,'lmde',55);
insert into mutuelle values(null,'lmdesriches',95);
insert into mutuelle values(null,'lmdespauvres',2);
insert into categorie_secu values(null,'cmu de base',30);
insert into categorie_secu values(null,'handicap',60);
insert into categorie_secu values(null,'retraite',15);

insert into medecin values(null,'emailmedecin@gmail.com','123','nommedecin','prenom_medecin','01234567879','1980-01-01',sysdate(),'12','rue_medecin','750medeci','medecinville',4,6,"Chouaki","Moby-Dick",null,'super_administrateur','speci_med',null);
insert into patient values(null,'emailpat@gmail.com','123','balloch','patoch','01857467879','2000-01-01','2012-12-12','666','rue_patoch','66666','enfer',4,6,"Chouaki","Moby-Dick",null,'utilisateur','6666666666',2,null);
insert into patient values(null,'email_minouche@gmail.com','123','Nouchnouch','minouch','0987654321','1895-01-01','2000-12-24','5','rue patouch','7minouch','hess',4,6,"Chouaki","Moby-Dick",null,'utilisateur','0000000001',3,1);
insert into medecin values(null,'totaltout@gmail.com','123','total','tout','01234562879','1985-01-01',sysdate(),'15','rue du tout','750tout','toutville',4,6,"Chouaki","Moby-Dick",null,'super_administrateur','touticien',null);
insert into patient values(null,'totaltout@gmail.com','m','n','p','t','2000-10-10','2000-10-10','n','r','c','v',4,6,"Chouaki","Moby-Dick",null,'super_administrateur','0123495874',1,1);
insert into secretaire values(null,'emailsecretaire@gmail.com','123','nomsecretaire','prenom_secretaire','01234567879','1980-01-01',sysdate(),'12','rue_secretaire','750secretaire','secretaireville',4,6,"Chouaki","Moby-Dick",null,'administrateur');

insert into posseder_mutuelle values(2,2);
insert into posseder_mutuelle values(3,3);
insert into posseder_mutuelle values(4,2);
insert into posseder_mutuelle values(2,3);
insert into posseder_mutuelle values(2,1);

insert into medecin values(0,'toto@gmail.com','123','toto','toto','toto','1980-01-01',sysdate(),'toto','toto','toto','toto',4,6,"toto","toto",null,'super_administrateur','toto',null);
/**************************************INSERTS TEST SURVEY ACTIONS NE PAS SUPPRIMER (TESTS UNITAIRES)**************************************/
/*
insert into mutuelle values(5,'testmutuelle',10);
insert into categorie_secu values(5,'testcatsecu',10);
insert into medecin values(5,'test@test.com','testmdp','testnom','testprenom','testtel',curdate(),curdate(),'testnumrue','testrue','testcp','testville',4,6,"Chouaki","Moby-Dick",null,'super_administrateur','testspecialisation',null);
insert into patient values(5,'test@test.com','testmdp','testnom','testprenom','testtel',curdate(),curdate(),'testnumrue','testrue','testcp','testville',4,6,"Chouaki","Moby-Dick",null,'super_administrateur','testnumdoc',5,5);
insert into posseder_mutuelle values(5,1);
update posseder_mutuelle set id_mutuelle=5 where id_patient=5 and id_mutuelle=1;
delete from posseder_mutuelle where id_mutuelle=5 and id_patient=5;
update mutuelle set libelle='testupdatemutuelle' where id_mutuelle=5;
update mutuelle set id_mutuelle=6 where id_mutuelle=5;
delete from mutuelle where id_mutuelle=6;
call facturation(100,5,5,'test_insert_facture');
update facture set libelle='test_update_facture' where id_medecin=5 and id_patient=5;
update facture set id_facture=5 where id_medecin=5;
delete from facture where id_medecin=5 and id_patient=5 and id_patient=5;
insert into correspondance values(5,'testinsertcorrespondance','testcontenu',5,5,5);
update correspondance set titre='testupdatecorrespondance' where id_correspondance=5;
update correspondance set id_correspondance = 6 where id_correspondance=5;
delete from correspondance where id_correspondance=6;
insert into pathologie values(5,'testinsertpathologie',curdate(),curdate(),5,5);
update pathologie set libelle='testupdatepathologie' where id_path=5;
update pathologie set id_path=6 where id_path=5;
delete from pathologie where id_path=6;
insert into operation values(5,'testinsertoperation',sysdate(),'01:00:00',1000,'attente resultat','attente commentaire',5,5);
insert into operer values(1,5);
update operer set id_medecin=5 where id_medecin=1 and id_patient=5;
delete from operer where id_medecin=5 and id_patient=5;
update operation set libelle='testupdateoperation' where id_operation=5;
update operation set id_operation = 6 where id_operation=5;
delete from operation where id_operation=6;
insert into hopital values(5,'testinserthopital','testnumrue','testrue','testcp','testville','testspecialisation');
insert into hospitalisation values(5,'testinserthospitalisation',curdate(),curdate(),curdate(),10,5,5,5);
update hospitalisation set raison='testupdatehospitalisation' where id_hospitalisation=5;
update hospitalisation set id_hospitalisation=6 where id_hospitalisation=5;
delete from hospitalisation where id_hospitalisation=6;
update hopital set nom='testupdatehopital' where id_hopital=5;
update hopital set id_hopital=6 where id_hopital=5;
delete from hopital where id_hopital=6;
insert into traitement values(5,'testinserttraitement','testposologie',curdate(),curdate(),100,5,5);
update traitement set libelle='testupdatetraitement' where id_traitement=5;
update traitement set id_traitement=6 where id_traitement=5;
delete from traitement where id_traitement=6;
insert into allergie values(5,'testinsertallergie',curdate(),curdate(),5,5);
update allergie set libelle='testupdateallergie' where id_allergie=5;
update allergie set id_allergie=6 where id_allergie=5;
delete from allergie where id_allergie=6;
insert into examen values(5,'testinsertexamen',curdate(),100,'attente resultat','attente commentaire',5,5);
update examen set libelle='testupdateexamen' where id_examen=5;
update examen set id_examen=6 where id_examen=5;
delete from examen where id_examen=6;
insert into planning values(5,'2000','12','2','testinsertplanning',5);
insert into prendre_rendez_vous values(2,5,sysdate(),'01:00:00');
update prendre_rendez_vous set duree='02:00:00' where id_patient=2 and id_planning=5;
update prendre_rendez_vous set id_patient=5 where id_patient=2 and id_planning=5;
delete from prendre_rendez_vous where id_patient = 5 and id_planning=5;
update planning set url='testupdateplanning'where id_planning=5;
update planning set id_planning=6 where id_planning=5;
delete from planning where id_planning=6;
update utilisateur set nom ='testnomtest' where id=5;
update utilisateur set id=6 where id=5;
update patient set id_patient=6 where id_patient=5;
update medecin set id_medecin=6 where id_medecin=5;
delete from patient where id_patient=6;
delete from medecin where id_medecin=6;
*/