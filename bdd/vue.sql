patient --> libelle de cat secu 
        --> nom et prenom du medecin

create or replace view vPatient as 
(
    select  P.*, C.libelle, M.nom as NM, M.prenom as PM
    from patient P, categorie_secu C, medecin M
    where P.id_cat_secu = C.id_cat_secu 
    and P.id_medecin = M.id_medecin  
);


facture --> nom prenom du medecin 
        --> nom et prenom du patient 

create or replace view vFacture as 
(
    select  F.*, P.nom as NP, P.prenom as PP , M.nom, M.prenom
    from patient P, facture F, medecin M
    where F.id_patient = P.id_patient 
    and F.id_medecin = M.id_medecin  
);

correspondance --> nom prenom du medecin cible
               --> nom prenom du medecin source
               --> nom prenom du patient
create or replace view vCorrespondance as 
(
    select  C.*, P.nom as NP, P.prenom as PP , M.nom, M.prenom
    from patient P, correspondance C, medecin M
    where C.id_patient = P.id_patient 
    and C.id_medecin_source = M.id_medecin  
    and C.id_medecin_cible = M.id_medecin  
);

pathologie --> nom prenom du medecin 
           --> nom et prenom du patient 
create or replace view vPathologie as 
(
    select  Pa.*, P.nom as NP, P.prenom as PP , M.nom, M.prenom
    from patient P, pathologie Pa, medecin M
    where Pa.id_patient = P.id_patient 
    and Pa.id_medecin = M.id_medecin  
);

operation --> nom et prenom du patient 
create or replace view vOperation as 
(
    select  O.*, P.nom, P.prenom
    from Patient P, operation O
    where O.id_patient = P.id_patient 
);

operer --> libelle de l'operation
       --> nom prenom du medecin 
create or replace view vOperer as 
(
    select  Op.*, M.nom, M.prenom, O.libelle
    from operation O, operer Op, medecin M
    where Op.id_operation = O.id_operation 
    and Op.id_medecin = M.id_medecin  
);

hospitalisation --> nom et ville hopital 
                --> nom prenom du medecin 
                --> nom et prenom du patient 
create or replace view vHospitalisation as 
(
    select  H.*, P.nom as NP, P.prenom as PP , M.nom, M.prenom, Ho.nom as hopital, Ho.ville
    from patient P, hospitalisation H, medecin M, hopital Ho
    where H.id_patient = P.id_patient 
    and H.id_medecin = M.id_medecin  
    and H.id_hopital = Ho.id_hopital 
);
traitement --> nom prenom du medecin 
           --> nom et prenom du patient 
create or replace view vTraitement as 
(
    select  T.*, P.nom as NP, P.prenom as PP , M.nom, M.prenom
    from patient P, traitement T, medecin M
    where T.id_patient = P.id_patient 
    and T.id_medecin = M.id_medecin  
);

allergie --> nom prenom du medecin 
         --> nom et prenom du patient 

create or replace view vAllergie as 
(
    select  A.*, P.nom as NP, P.prenom as PP , M.nom, M.prenom
    from patient P, allergie A, medecin M
    where A.id_patient = P.id_patient 
    and A.id_medecin = M.id_medecin  
);

examen --> nom prenom du medecin 
       --> nom et prenom du patient 
create or replace view vExamen as 
(
    select  E.*, P.nom as NP, P.prenom as PP , M.nom, M.prenom
    from patient P, examen E, medecin M
    where E.id_patient = P.id_patient 
    and E.id_medecin = M.id_medecin  
);
