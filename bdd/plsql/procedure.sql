
/****************************PROCEDURE*********************************/

/*procédure pour débloquer un utilisateur quand après qu'il ai eu 3 echecs de connexion*/
drop procedure if exists unlockuser;
DELIMITER // 
create procedure unlockuser(
    in le_id_user int(5)
)
BEGIN
    DECLARE le_id_echec int;
    if (select count(id_echec) from nb_echec_co where id_utilisateur = le_id_user) != 0
    then
        if(select nb_essai_restant from nb_echec_co where id_utilisateur = le_id_user
            and id_echec >=all (select id_echec from nb_echec_co where id_utilisateur = le_id_user)) !=3
        then
            insert into nb_echec_co values(null,'unlock',3,sysdate(),le_id_user);
            update nb_echec_co set etat_blocage='unlock', nb_essai_restant=3
                where id_utilisateur = le_id_user 
                and id_echec >=all (select id_echec from nb_echec_co where id_utilisateur = le_id_user);
        end if;
    else update utilisateur set blocage='unlock' where id = le_id_user;
    end if;
    
END //
DELIMITER ;

/*procédure qui insert le clé de chiffrement dans la base de donnée secret*/

drop procedure if exists genekey;
DELIMITER // 
create procedure genekey(in utilisateurs varchar(100), in cle varchar(100))
BEGIN
    insert into sterces.keycrypte values(utilisateurs, cle);
END //
DELIMITER ;

drop procedure if exists Updatekey;
DELIMITER // 
create procedure Updatekey(in utilisateurs varchar(100), in cles varchar(100))
BEGIN
    update sterces.keycrypte set cle = cles where utilisateur = utilisateurs;
END //
DELIMITER ;

drop procedure if exists getkey;
DELIMITER // 
create procedure getkey(in utilisateurs varchar(100))
BEGIN
    select cle from sterces.keycrypte where utilisateur = utilisateurs;
END //
DELIMITER ;

/*procédure pour créer un facture en comptant les remboursements de la secu et des eventuelles mutuelles*/
drop procedure if exists facturation;
DELIMITER //
create procedure facturation(
    in le_prix decimal(7,2),
    in le_id_patient int,
    in le_id_medecin int,
    in le_libelle varchar(255)
)
BEGIN
    DECLARE prix_cal decimal(7,2);
    DECLARE le_montant_mutuelle decimal(7,2);
    DECLARE le_montant_secu decimal(7,2);
    DECLARE pourcent_rembourse_tot decimal(6,2) default 0;
    DECLARE le_pourcent_rembourse decimal(5,2);
    DECLARE done INT DEFAULT FALSE;

DECLARE mutuelle_curseur CURSOR FOR
select m.pourcent_rembourse from posseder_mutuelle p, mutuelle m where p.id_patient = le_id_patient and p.id_mutuelle = m.id_mutuelle;
    
DECLARE
    CONTINUE HANDLER FOR NOT FOUND
SET
    done = TRUE;

OPEN mutuelle_curseur;
la_loop:
LOOP
    FETCH mutuelle_curseur INTO le_pourcent_rembourse;
IF done THEN LEAVE la_loop;
END IF;
SET pourcent_rembourse_tot = pourcent_rembourse_tot + le_pourcent_rembourse;
END 
LOOP
    la_loop;

CLOSE mutuelle_curseur;

    if pourcent_rembourse_tot >= 100-(select pourcent_rembourse from categorie_secu c, patient p where id_patient = le_id_patient and p.id_cat_secu = c.id_cat_secu)
    then
        set prix_cal = 0;
        set le_montant_secu = (select pourcent_rembourse from categorie_secu c, patient p where id_patient = le_id_patient and p.id_cat_secu = c.id_cat_secu);
        set le_montant_mutuelle = 100 - le_montant_secu;
    else
        set le_montant_mutuelle = pourcent_rembourse_tot;
        set pourcent_rembourse_tot = pourcent_rembourse_tot + (select pourcent_rembourse from categorie_secu c, patient p where id_patient = le_id_patient and p.id_cat_secu = c.id_cat_secu);
        set prix_cal = le_prix - le_prix*pourcent_rembourse_tot/100;
        set le_montant_secu = (select pourcent_rembourse from categorie_secu c, patient p where id_patient = le_id_patient and p.id_cat_secu = c.id_cat_secu);      
    end if;
    set le_montant_mutuelle = le_prix*le_montant_mutuelle/100;
    set le_montant_secu = le_prix*le_montant_secu/100;
    insert into facture values(null,le_libelle,curdate(),le_prix,le_montant_secu,le_montant_mutuelle,prix_cal,0,'non reglee',le_id_medecin,le_id_patient);
END //
DELIMITER ;
