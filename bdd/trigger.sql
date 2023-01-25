
/****************************TRIGGERS*********************************/

/*********************************TRIGGERS SUR PATIENT***********************************************/

drop trigger if exists patient_before_insert;
delimiter // 
create trigger patient_before_insert 
before insert on patient
for each row
begin
    if new.id_medecin=0
        then set new.id_medecin = null;
    end if;
    if new.email not in (select email from utilisateur)
    then
        set new.blocage = 'unlock';
        insert into utilisateur values(
            null,
            new.email,
            new.mdp,
            new.nom,
            new.prenom,
            new.tel,
            new.date_naissance,
            new.date_enregistrement,
            new.numrue,
            new.rue,
            new.cp,
            new.ville,
            new.question_1,
            new.question_2, 
            new.reponse_secrete_1,
            new.reponse_secrete_2,
            new.blocage,
            new.droits
        );
    else
        set new.nom = (select nom from utilisateur where email = new.email);
        set new.prenom = (select prenom from utilisateur where email = new.email);
        set new.tel = (select tel from utilisateur where email = new.email);
        set new.date_naissance = (select date_naissance from utilisateur where email = new.email);
        set new.date_enregistrement = (select date_enregistrement from utilisateur where email = new.email);
        set new.numrue = (select numrue from utilisateur where email = new.email);
        set new.rue = (select rue from utilisateur where email = new.email);
        set new.cp = (select cp from utilisateur where email = new.email);
        set new.ville = (select ville from utilisateur where email = new.email);
        set new.question_1 = (select question_1 from utilisateur where email = new.email);
        set new.question_2 = (select question_2 from utilisateur where email = new.email);
        set new.blocage = (select blocage from utilisateur where email = new.email);
        set new.droits = (select droits from utilisateur where email = new.email);
    end if;
    set new.id_patient = (select id from utilisateur where email = new.email);
    set new.mdp = (select mdp from utilisateur where email = new.email);
    set new.reponse_secrete_1 = (select reponse_secrete_1 from utilisateur where email = new.email);
    set new.reponse_secrete_2 = (select reponse_secrete_2 from utilisateur where email = new.email);
end //
delimiter ;

drop trigger if exists patient_after_insert;
delimiter // 
create trigger patient_after_insert 
after insert on patient
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),'patient',new.id_patient,current_user());
end //
delimiter ;

drop trigger if exists patient_after_update;
delimiter // 
create trigger patient_after_update 
after update on patient
for each row
begin
    if new.id_patient = old.id_patient
    then
        insert into action_surveillance values(null,"update",sysdate(),'patient',new.id_patient,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),'patient',old.id_patient,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),'patient',new.id_patient,current_user());
    end if;
end //
delimiter ;

drop trigger if exists patient_after_delete;
delimiter // 
create trigger patient_after_delete
after delete on patient
for each row
begin
    if old.id_patient not in (select id_medecin from medecin) and  old.id_patient not in (select id_secretaire from secretaire)
    then
        delete from utilisateur where id = old.id_patient;
    end if;
    insert into archipatient values(
    old.id_patient,
    old.email,
    old.mdp,
    old.nom,
    old.prenom,
    old.tel,
    old.date_naissance,
    old.date_enregistrement,
    old.numrue,
    old.rue,
    old.cp,
    old.ville,
    old.question_1,
    old.question_2,
    old.reponse_secrete_1,
    old.reponse_secrete_2,
    old.blocage,
    old.droits,
    old.numero_dossier,
    old.id_cat_secu,
    old.id_medecin,          
    curdate());
    insert into action_surveillance values(null,"delete",sysdate(),'patient',old.id_patient,current_user());

end //
delimiter ;

/*********************************TRIGGERS SUR MEDECIN***********************************************/

drop trigger if exists medecin_before_insert;
delimiter // 
create trigger medecin_before_insert
before insert on medecin
for each row
begin
    if new.email in (select email from secretaire)
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Insertion impossible, utilisateur déjà existant dans "secretaire"';
    END IF;
    if new.email not in (select email from utilisateur)
    then
        set new.blocage = 'unlock';
        insert into utilisateur values(
            null,
            new.email,
            new.mdp,
            new.nom,
            new.prenom,
            new.tel,
            new.date_naissance,
            new.date_enregistrement,
            new.numrue,
            new.rue,
            new.cp,
            new.ville,
            new.question_1,
            new.question_2,
            new.reponse_secrete_1,
            new.reponse_secrete_2,
            new.blocage,
            new.droits
        );
    else
        set new.nom = (select nom from utilisateur where email = new.email);
        set new.prenom = (select prenom from utilisateur where email = new.email);
        set new.tel = (select tel from utilisateur where email = new.email);
        set new.date_naissance = (select date_naissance from utilisateur where email = new.email);
        set new.date_enregistrement = (select date_enregistrement from utilisateur where email = new.email);
        set new.numrue = (select numrue from utilisateur where email = new.email);
        set new.rue = (select rue from utilisateur where email = new.email);
        set new.cp = (select cp from utilisateur where email = new.email);
        set new.ville = (select ville from utilisateur where email = new.email);
        set new.question_1 = (select question_1 from utilisateur where email = new.email);
        set new.question_2 = (select question_2 from utilisateur where email = new.email);
        set new.blocage = (select blocage from utilisateur where email = new.email);
        set new.droits = (select droits from utilisateur where email = new.email);
    end if;
    set new.id_medecin = (select id from utilisateur where email = new.email);
    set new.mdp = (select mdp from utilisateur where email = new.email);
    set new.reponse_secrete_1 = (select reponse_secrete_1 from utilisateur where email = new.email);
    set new.reponse_secrete_2 = (select reponse_secrete_2 from utilisateur where email = new.email);
end //
delimiter ;

drop trigger if exists medecin_after_insert;
delimiter // 
create trigger medecin_after_insert 
after insert on medecin
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),'medecin',new.id_medecin,current_user());
end //
delimiter ;

drop trigger if exists medecin_after_update;
delimiter // 
create trigger medecin_after_update 
after update on medecin
for each row
begin
    if new.id_medecin = old.id_medecin
    then
        insert into action_surveillance values(null,"update",sysdate(),'medecin',new.id_medecin,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),'medecin',old.id_medecin,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),'medecin',new.id_medecin,current_user());
    end if;
end //
delimiter ;

drop trigger if exists medecin_after_delete;
delimiter // 
create trigger medecin_after_delete 
after delete on medecin
for each row
begin
    if old.id_medecin not in (select id_patient from patient)
    then
        delete from utilisateur where id = old.id_medecin;
    end if;
    insert into action_surveillance values(null,"delete",sysdate(),'medecin',old.id_medecin,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR SECRETAIRE***********************************************/

drop trigger if exists secretaire_before_insert;
delimiter // 
create trigger secretaire_before_insert
before insert on secretaire
for each row
begin
    if new.email in (select email from medecin)
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Insertion impossible, utilisateur déjà existant dans "medecin"';
    END IF;
    if new.email not in (select email from utilisateur)
    then
        set new.blocage = 'unlock';
        insert into utilisateur values(
            null,
            new.email,
            new.mdp,
            new.nom,
            new.prenom,
            new.tel,
            new.date_naissance,
            new.date_enregistrement,
            new.numrue,
            new.rue,
            new.cp,
            new.ville,
            new.question_1,
            new.question_2,
            new.reponse_secrete_1,
            new.reponse_secrete_2,
            new.blocage,
            new.droits
        );
    else
        set new.nom = (select nom from utilisateur where email = new.email);
        set new.prenom = (select prenom from utilisateur where email = new.email);
        set new.tel = (select tel from utilisateur where email = new.email);
        set new.date_naissance = (select date_naissance from utilisateur where email = new.email);
        set new.date_enregistrement = (select date_enregistrement from utilisateur where email = new.email);
        set new.numrue = (select numrue from utilisateur where email = new.email);
        set new.rue = (select rue from utilisateur where email = new.email);
        set new.cp = (select cp from utilisateur where email = new.email);
        set new.ville = (select ville from utilisateur where email = new.email);
        set new.question_1 = (select question_1 from utilisateur where email = new.email);
        set new.question_2 = (select question_2 from utilisateur where email = new.email);
        set new.blocage = (select blocage from utilisateur where email = new.email);
        set new.droits = (select droits from utilisateur where email = new.email);
    end if;
    set new.id_secretaire = (select id from utilisateur where email = new.email);
    set new.mdp = (select mdp from utilisateur where email = new.email);
    set new.reponse_secrete_1 = (select reponse_secrete_1 from utilisateur where email = new.email);
    set new.reponse_secrete_2 = (select reponse_secrete_2 from utilisateur where email = new.email);
end //
delimiter ;

drop trigger if exists secretaire_after_insert;
delimiter // 
create trigger secretaire_after_insert 
after insert on secretaire
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),'secretaire',new.id_secretaire,current_user());
end //
delimiter ;

drop trigger if exists secretaire_after_update;
delimiter // 
create trigger secretaire_after_update 
after update on secretaire
for each row
begin
    if new.id_secretaire = old.id_secretaire
    then
        insert into action_surveillance values(null,"update",sysdate(),'secretaire',new.id_secretaire,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),'secretaire',old.id_secretaire,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),'secretaire',new.id_secretaire,current_user());
    end if;
end //
delimiter ;

drop trigger if exists secretaire_after_delete;
delimiter // 
create trigger secretaire_after_delete 
after delete on secretaire
for each row
begin
    if old.id_secretaire not in (select id_patient from patient)
    then
        delete from utilisateur where id = old.id_secretaire;
    end if;
    insert into action_surveillance values(null,"delete",sysdate(),'secretaire',old.id_secretaire,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR UTILISATEUR***********************************************/

drop trigger if exists utilisateur_before_insert;
delimiter // 
create trigger utilisateur_before_insert
before insert on utilisateur
for each row
begin
    insert into sterces.remedles values(
        sha2(new.email,256),
        sha2(concat(new.email,new.nom,new.prenom,new.tel),256)
    );
    set new.mdp = sha2(
        concat(
            (select ednareugedles from sterces.remedles where ruetasilitu=sha2(new.email,256)),
            new.mdp
            ),256
        );
    set new.reponse_secrete_1 = sha2(
        concat(
            (select ednareugedles from sterces.remedles where ruetasilitu=sha2(new.email,256)),
            new.reponse_secrete_1
        ),256
    );
    set new.reponse_secrete_2 = sha2(
        concat(
            (select ednareugedles from sterces.remedles where ruetasilitu=sha2(new.email,256)),
            new.reponse_secrete_2
        ),256
    );
end //
delimiter ;

drop trigger if exists utilisateur_before_update;
delimiter // 
create trigger utilisateur_before_update
before update on utilisateur
for each row
begin
    if new.email != old.email
    then
        update sterces.remedles set ruetasilitu = sha2(new.email,256) where ruetasilitu=sha2(old.email,256);
    end if;
    if new.mdp not like old.mdp
    then
        set new.mdp = sha2(
        concat(
            (select ednareugedles from sterces.remedles where ruetasilitu=sha2(new.email,256)),
            new.mdp
            ),256
        );
    end if;
    if new.reponse_secrete_1 not like old.reponse_secrete_1
    then
        set new.reponse_secrete_1 = sha2(
            concat(
                (select ednareugedles from sterces.remedles where ruetasilitu=sha2(new.email,256)),
                new.reponse_secrete_1
            ),256
        );
    end if;
    if new.reponse_secrete_2 not like old.reponse_secrete_2
    then
        set new.reponse_secrete_2 = sha2(
            concat(
                (select ednareugedles from sterces.remedles where ruetasilitu=sha2(new.email,256)),
                new.reponse_secrete_2
            ),256
        );
    end if;
    if new.id in (select id_patient from patient)
    then 
        update patient set
            email = new.email,
            mdp = new.mdp,
            nom = new.nom,
            prenom = new.prenom,
            tel = new.tel,
            date_naissance = new.date_naissance,
            date_enregistrement = new.date_enregistrement,
            numrue = new.numrue,
            rue = new.rue,
            cp = new.cp,
            ville = new.ville,
            question_1 = new.question_1,
            question_2 = new.question_2,
            reponse_secrete_1 = new.reponse_secrete_1,
            reponse_secrete_2 = new.reponse_secrete_2,
            blocage = new.blocage,
            droits = new.droits
            where id_patient = new.id;
    end if;
    if new.id in (select id_medecin from medecin)
    then 
        update medecin set
            email = new.email,
            mdp = new.mdp,
            nom = new.nom,
            prenom = new.prenom,
            tel = new.tel,
            date_naissance = new.date_naissance,
            date_enregistrement = new.date_enregistrement,
            numrue = new.numrue,
            rue = new.rue,
            cp = new.cp,
            ville = new.ville,
            question_1 = new.question_1,
            question_2 = new.question_2,
            reponse_secrete_1 = new.reponse_secrete_1,
            reponse_secrete_2 = new.reponse_secrete_2,
            blocage = new.blocage,
            droits = new.droits
            where id_medecin = new.id;
    end if;
    if new.id in (select id_secretaire from secretaire)
    then 
        update medecin set
            email = new.email,
            mdp = new.mdp,
            nom = new.nom,
            prenom = new.prenom,
            tel = new.tel,
            date_naissance = new.date_naissance,
            date_enregistrement = new.date_enregistrement,
            numrue = new.numrue,
            rue = new.rue,
            cp = new.cp,
            ville = new.ville,
            question_1 = new.question_1,
            question_2 = new.question_2,
            reponse_secrete_1 = new.reponse_secrete_1,
            reponse_secrete_2 = new.reponse_secrete_2,
            blocage = new.blocage,
            droits = new.droits
            where id_medecin = new.id;
    end if;
end //
delimiter ;

drop trigger if exists utilisateur_after_insert;
delimiter // 
create trigger utilisateur_after_insert 
after insert on utilisateur
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"utilisateur",new.id,current_user());
end //
delimiter ;

drop trigger if exists utilisateur_after_update;
delimiter // 
create trigger utilisateur_after_update 
after update on utilisateur
for each row
begin
    if new.id = old.id
    then
        insert into action_surveillance values(null,"update",sysdate(),"utilisateur",new.id,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"utilisateur",old.id,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"utilisateur",new.id,current_user());
    end if;
end //
delimiter ;

drop trigger if exists utilisateur_after_delete;
delimiter // 
create trigger utilisateur_after_delete 
after delete on utilisateur
for each row
begin
   insert into action_surveillance values(null,"delete",sysdate(),"utilisateur",old.id,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR FACTURE***********************************************/

drop trigger if exists facture_before_insert;
delimiter // 
create trigger facture_before_insert
before insert on facture
for each row
begin
    if new.montant_paye = new.prix_a_payer 
    then 
    set new.etat ='reglee'; 

    elseif new.montant_paye > new.prix_a_payer 
    then 
    signal sqlstate '45000' SET MESSAGE_TEXT = "paiement refuse : le montant est superieur a la somme due";
    end if; 
   
end //
delimiter ;

drop trigger if exists facture_before_update;
delimiter // 
create trigger facture_before_update
before update on facture
for each row
begin
    if new.montant_paye = new.prix_a_payer 
    then 
    set new.etat ='reglee'; 

    elseif new.montant_paye > new.prix_a_payer 
    then 
    signal sqlstate '45000' SET MESSAGE_TEXT = "paiement refuse : le montant est superieur a la somme due";
    end if; 
   
end //
delimiter ;

drop trigger if exists facture_after_insert;
delimiter // 
create trigger facture_after_insert 
after insert on facture
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"facture",new.id_facture,current_user());
end //
delimiter ;

drop trigger if exists facture_after_update;
delimiter // 
create trigger facture_after_update 
after update on facture
for each row
begin
    if new.id_facture = old.id_facture
    then
        insert into action_surveillance values(null,"update",sysdate(),"facture",new.id_facture,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"facture",old.id_facture,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"facture",new.id_facture,current_user());
    end if;
end //
delimiter ;

drop trigger if exists facture_after_delete;
delimiter // 
create trigger facture_after_delete 
after delete on facture
for each row
begin
    insert into archifacture values(
        old.id_facture,
        old.libelle,
        old.date_facturation,
        old.montant_total,
        old.montant_secu,
        old.montant_mutuelle,
        old.prix_a_payer,
        old.montant_paye,
        old.etat,
        old.id_medecin,
        old.id_patient,
        curdate());
    insert into action_surveillance values(null,"delete",sysdate(),"facture",old.id_facture,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR RENDEZ_VOUS***********************************************/

drop trigger if exists prendre_rendez_vous_after_insert;
delimiter // 
create trigger prendre_rendez_vous_after_insert 
after insert on prendre_rendez_vous
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"prendre_rendez_vous",concat(new.id_patient,',',new.id_planning),current_user());
end //
delimiter ;

drop trigger if exists prendre_rendez_vous_after_update;
delimiter // 
create trigger prendre_rendez_vous_after_update 
after update on prendre_rendez_vous
for each row
begin
    if new.id_patient = old.id_patient and new.id_planning = old.id_planning
    then
        insert into action_surveillance values(null,"update",sysdate(),"prendre_rendez_vous",concat(new.id_patient,',',new.id_planning),current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"prendre_rendez_vous",concat(old.id_patient,',',old.id_planning),current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"prendre_rendez_vous",concat(new.id_patient,',',new.id_planning),current_user());
    end if;
end //
delimiter ;

drop trigger if exists prendre_rendez_vous_after_delete;
delimiter // 
create trigger prendre_rendez_vous_after_delete 
after delete on prendre_rendez_vous
for each row
begin
    insert into archiprendre_rendez_vous values(
        old.id_patient,
        old.id_planning,
        old.date_heure_debut,
        old.duree,
        curdate());
    insert into action_surveillance values(null,"delete",sysdate(),"prendre_rendez_vous",concat(old.id_patient,',',old.id_planning),current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR MUTUELLE***********************************************/

drop trigger if exists mutuelle_after_insert;
delimiter // 
create trigger mutuelle_after_insert 
after insert on mutuelle
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"mutuelle",new.id_mutuelle,current_user());
end //
delimiter ;

drop trigger if exists mutuelle_after_update;
delimiter // 
create trigger mutuelle_after_update 
after update on mutuelle
for each row
begin
    if new.id_mutuelle = old.id_mutuelle
    then
        insert into action_surveillance values(null,"update",sysdate(),"mutuelle",new.id_mutuelle,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"mutuelle",old.id_mutuelle,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"mutuelle",new.id_mutuelle,current_user());
    end if;
end //
delimiter ;

drop trigger if exists mutuelle_after_delete;
delimiter // 
create trigger mutuelle_after_delete 
after delete on mutuelle
for each row
begin
   insert into action_surveillance values(null,"delete",sysdate(),"mutuelle",old.id_mutuelle,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR CATEGORIE_SECU***********************************************/

drop trigger if exists categorie_secu_after_insert;
delimiter // 
create trigger categorie_secu_after_insert 
after insert on categorie_secu
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"categorie_secu",new.id_cat_secu,current_user());
end //
delimiter ;

drop trigger if exists categorie_secu_after_update;
delimiter // 
create trigger categorie_secu_after_update 
after update on categorie_secu
for each row
begin
    if new.id_cat_secu = old.id_cat_secu
    then
        insert into action_surveillance values(null,"update",sysdate(),"categorie_secu",new.id_cat_secu,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"categorie_secu",old.id_cat_secu,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"categorie_secu",new.id_cat_secu,current_user());
    end if;
end //
delimiter ;

drop trigger if exists categorie_secu_after_delete;
delimiter // 
create trigger categorie_secu_after_delete 
after delete on categorie_secu
for each row
begin
   insert into action_surveillance values(null,"delete",sysdate(),"categorie_secu",old.id_cat_secu,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR POSSEDER_MUTUELLE***********************************************/

drop trigger if exists posseder_mutuelle_after_insert;
delimiter // 
create trigger posseder_mutuelle_after_insert 
after insert on posseder_mutuelle
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"posseder_mutuelle",concat(new.id_patient,',',new.id_mutuelle),current_user());
end //
delimiter ;

drop trigger if exists posseder_mutuelle_after_update;
delimiter // 
create trigger posseder_mutuelle_after_update 
after update on posseder_mutuelle
for each row
begin
    if new.id_patient = old.id_patient and new.id_mutuelle = old.id_mutuelle
    then
        insert into action_surveillance values(null,"update",sysdate(),"posseder_mutuelle",concat(new.id_patient,',',new.id_mutuelle),current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"posseder_mutuelle",concat(old.id_patient,',',old.id_mutuelle),current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"posseder_mutuelle",concat(new.id_patient,',',new.id_mutuelle),current_user());
    end if;
end //
delimiter ;

drop trigger if exists posseder_mutuelle_after_delete;
delimiter // 
create trigger posseder_mutuelle_after_delete 
after delete on posseder_mutuelle
for each row
begin
    insert into action_surveillance values(null,"delete",sysdate(),"posseder_mutuelle",concat(old.id_patient,',',old.id_mutuelle),current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR CORRESPONDANCE***********************************************/

drop trigger if exists correspondance_after_insert;
delimiter // 
create trigger correspondance_after_insert 
after insert on correspondance
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"correspondance",new.id_correspondance,current_user());
end //
delimiter ;

drop trigger if exists correspondance_after_update;
delimiter // 
create trigger correspondance_after_update 
after update on correspondance
for each row
begin
    if new.id_correspondance = old.id_correspondance
    then
        insert into action_surveillance values(null,"update",sysdate(),"correspondance",new.id_correspondance,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"correspondance",old.id_correspondance,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"correspondance",new.id_correspondance,current_user());
    end if;
end //
delimiter ;

drop trigger if exists correspondance_after_delete;
delimiter // 
create trigger correspondance_after_delete 
after delete on correspondance
for each row
begin
   insert into action_surveillance values(null,"delete",sysdate(),"correspondance",old.id_correspondance,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR PATHOLOGIE***********************************************/

drop trigger if exists pathologie_after_insert;
delimiter // 
create trigger pathologie_after_insert 
after insert on pathologie
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"pathologie",new.id_path,current_user());
end //
delimiter ;

drop trigger if exists pathologie_after_update;
delimiter // 
create trigger pathologie_after_update 
after update on pathologie
for each row
begin
    if new.id_path = old.id_path
    then
        insert into action_surveillance values(null,"update",sysdate(),"pathologie",new.id_path,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"pathologie",old.id_path,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"pathologie",new.id_path,current_user());
    end if;
end //
delimiter ;

drop trigger if exists pathologie_after_delete;
delimiter // 
create trigger pathologie_after_delete 
after delete on pathologie
for each row
begin
   insert into action_surveillance values(null,"delete",sysdate(),"pathologie",old.id_path,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR OPERATION***********************************************/

drop trigger if exists operation_after_insert;
delimiter // 
create trigger operation_after_insert 
after insert on operation
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"operation",new.id_operation,current_user());
end //
delimiter ;

drop trigger if exists operation_after_update;
delimiter // 
create trigger operation_after_update 
after update on operation
for each row
begin
    if new.id_operation = old.id_operation
    then
        insert into action_surveillance values(null,"update",sysdate(),"operation",new.id_operation,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"operation",old.id_operation,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"operation",new.id_operation,current_user());
    end if;
end //
delimiter ;

drop trigger if exists operation_after_delete;
delimiter // 
create trigger operation_after_delete 
after delete on operation
for each row
begin
    insert into archioperation values(
    old.id_operation,
    old.libelle,
    old.date_heure_time,
    old.duree,
    old.prix,
    old.resultat,
    old.commentaire,
    old.id_patient,
    curdate());
   insert into action_surveillance values(null,"delete",sysdate(),"operation",old.id_operation,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR OPERER***********************************************/

drop trigger if exists operer_after_insert;
delimiter // 
create trigger operer_after_insert 
after insert on operer
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"operer",concat(new.id_medecin,',',new.id_operation),current_user());
end //
delimiter ;

drop trigger if exists operer_after_update;
delimiter // 
create trigger operer_after_update 
after update on operer
for each row
begin
    if new.id_medecin = old.id_medecin and new.id_operation = old.id_operation
    then
        insert into action_surveillance values(null,"update",sysdate(),"operer",concat(new.id_medecin,',',new.id_operation),current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"operer",concat(old.id_medecin,',',old.id_operation),current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"operer",concat(new.id_medecin,',',new.id_operation),current_user());
    end if;
end //
delimiter ;

drop trigger if exists operer_after_delete;
delimiter // 
create trigger operer_after_delete 
after delete on operer
for each row
begin
    insert into action_surveillance values(null,"delete",sysdate(),"operer",concat(old.id_medecin,',',old.id_operation),current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR HOPITAL***********************************************/

drop trigger if exists hopital_after_insert;
delimiter // 
create trigger hopital_after_insert 
after insert on hopital
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"hopital",new.id_hopital,current_user());
end //
delimiter ;

drop trigger if exists hopital_after_update;
delimiter // 
create trigger hopital_after_update 
after update on hopital
for each row
begin
    if new.id_hopital = old.id_hopital
    then
        insert into action_surveillance values(null,"update",sysdate(),"hopital",new.id_hopital,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"hopital",old.id_hopital,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"hopital",new.id_hopital,current_user());
    end if;
end //
delimiter ;

drop trigger if exists hopital_after_delete;
delimiter // 
create trigger hopital_after_delete 
after delete on hopital
for each row
begin
   insert into action_surveillance values(null,"delete",sysdate(),"hopital",old.id_hopital,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR HOSPITALISATION***********************************************/

drop trigger if exists hospitalisation_after_insert;
delimiter // 
create trigger hospitalisation_after_insert 
after insert on hospitalisation
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"hospitalisation",new.id_hospitalisation,current_user());
end //
delimiter ;

drop trigger if exists hospitalisation_after_update;
delimiter // 
create trigger hospitalisation_after_update 
after update on hospitalisation
for each row
begin
    if new.id_hospitalisation = old.id_hospitalisation
    then
        insert into action_surveillance values(null,"update",sysdate(),"hospitalisation",new.id_hospitalisation,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"hospitalisation",old.id_hospitalisation,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"hospitalisation",new.id_hospitalisation,current_user());
    end if;
end //
delimiter ;

drop trigger if exists hospitalisation_after_delete;
delimiter // 
create trigger hospitalisation_after_delete 
after delete on hospitalisation
for each row
begin
    insert into archihospitalisation values(
        old.id_hospitalisation,
        old.raison,
        old.date_debut,
        old.date_fin_estimee,
        old.date_fin,
        old.id_hopital,
        old.id_patient,
        old.id_medecin,
        curdate());
   insert into action_surveillance values(null,"delete",sysdate(),"hospitalisation",old.id_hospitalisation,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR TRAITEMENT***********************************************/

drop trigger if exists traitement_after_insert;
delimiter // 
create trigger traitement_after_insert 
after insert on traitement
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"traitement",new.id_traitement,current_user());
end //
delimiter ;

drop trigger if exists traitement_after_update;
delimiter // 
create trigger traitement_after_update 
after update on traitement
for each row
begin
    if new.id_traitement = old.id_traitement
    then
        insert into action_surveillance values(null,"update",sysdate(),"traitement",new.id_traitement,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"traitement",old.id_traitement,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"traitement",new.id_traitement,current_user());
    end if;
end //
delimiter ;

drop trigger if exists traitement_after_delete;
delimiter // 
create trigger traitement_after_delete 
after delete on traitement
for each row
begin
    insert into architraitement values(
    old.id_traitement,
    old.libelle,
    old.posologie,
    old.date_debut,
    old.date_fin,
    old.prix_par_unite,
    old.id_medecin,
    old.id_patient,
    curdate());
   insert into action_surveillance values(null,"delete",sysdate(),"traitement",old.id_traitement,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR ALLERGIE***********************************************/

drop trigger if exists allergie_after_insert;
delimiter // 
create trigger allergie_after_insert 
after insert on allergie
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"allergie",new.id_allergie,current_user());
end //
delimiter ;

drop trigger if exists allergie_after_update;
delimiter // 
create trigger allergie_after_update 
after update on allergie
for each row
begin
    if new.id_allergie = old.id_allergie
    then
        insert into action_surveillance values(null,"update",sysdate(),"allergie",new.id_allergie,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"allergie",old.id_allergie,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"allergie",new.id_allergie,current_user());
    end if;
end //
delimiter ;

drop trigger if exists allergie_after_delete;
delimiter // 
create trigger allergie_after_delete 
after delete on allergie
for each row
begin
   insert into action_surveillance values(null,"delete",sysdate(),"allergie",old.id_allergie,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR EXAMEN***********************************************/

drop trigger if exists examen_after_insert;
delimiter // 
create trigger examen_after_insert 
after insert on examen
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"examen",new.id_examen,current_user());
end //
delimiter ;

drop trigger if exists examen_after_update;
delimiter // 
create trigger examen_after_update 
after update on examen
for each row
begin
    if new.id_examen = old.id_examen
    then
        insert into action_surveillance values(null,"update",sysdate(),"examen",new.id_examen,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"examen",old.id_examen,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"examen",new.id_examen,current_user());
    end if;
end //
delimiter ;

drop trigger if exists examen_after_delete;
delimiter // 
create trigger examen_after_delete 
after delete on examen
for each row
begin
    insert into archiexamen values(
    old.id_examen,
    old.libelle,
    old.date,
    old.prix_examen,
    old.resultat,
    old.commentaire,
    old.id_medecin,
    old.id_patient,
    curdate());

   insert into action_surveillance values(null,"delete",sysdate(),"examen",old.id_examen,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR PLANNING***********************************************/

drop trigger if exists planning_after_insert;
delimiter // 
create trigger planning_after_insert 
after insert on planning
for each row
begin
   insert into action_surveillance values(null,"insert",sysdate(),"planning",new.id_planning,current_user());
end //
delimiter ;

drop trigger if exists planning_after_update;
delimiter // 
create trigger planning_after_update 
after update on planning
for each row
begin
    if new.id_planning = old.id_planning
    then
        insert into action_surveillance values(null,"update",sysdate(),"planning",new.id_planning,current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"planning",old.id_planning,current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"planning",new.id_planning,current_user());
    end if;
end //
delimiter ;

drop trigger if exists planning_after_delete;
delimiter // 
create trigger planning_after_delete 
after delete on planning
for each row
begin
    insert into archiplanning values(
    old.id_planning,
    old.annee,
    old.mois,
    old.semaine,
    old.url,
    old.id_medecin,
    curdate()); 
   insert into action_surveillance values(null,"delete",sysdate(),"planning",old.id_planning,current_user());
end //
delimiter ;

/*********************************TRIGGERS SUR NB_ECHEC_CO***********************************************/

drop trigger if exists nb_echec_co_before_insert;
delimiter // 
create trigger nb_echec_co_before_insert 
before insert on nb_echec_co
for each row
begin
    set new.date_heure_echec = sysdate();
    if (select count(id_echec) from nb_echec_co where id_utilisateur = new.id_utilisateur) = 0
    then
        set new.nb_essai_restant = 2;
        set new.etat_blocage = 'unlock';
    else
        set new.nb_essai_restant = (select nb_essai_restant-1
            from nb_echec_co
            where id_utilisateur = new.id_utilisateur 
            and id_echec >=all (select id_echec from nb_echec_co where id_utilisateur = new.id_utilisateur));
    end if;

    if new.nb_essai_restant <= 0
        then
            set new.etat_blocage = 'lock';
        else
            set new.etat_blocage = 'unlock';
    end if;

end //
delimiter ;

drop trigger if exists nb_echec_co_after_insert;
delimiter // 
create trigger nb_echec_co_after_insert 
after insert on nb_echec_co
for each row
begin
    if new.etat_blocage not like (select blocage from utilisateur where id= new.id_utilisateur)
    then
        update utilisateur set blocage = new.etat_blocage where id = new.id_utilisateur;
    end if;

end //
delimiter ;

drop trigger if exists nb_echec_co_after_update;
delimiter // 
create trigger nb_echec_co_after_update 
after update on nb_echec_co
for each row
begin
    if new.etat_blocage not like old.etat_blocage
    then
        update utilisateur set blocage = new.etat_blocage where id = new.id_utilisateur;
    end if;
end //
delimiter ;
