drop database if exists  sterces ;
create database sterces;
    use sterces;

create table remedles
(
    ruetasilitu varchar(255) not null,
    ednareugedles varchar(255) not null,
    primary key (ruetasilitu)
)engine=innodb;

drop database if exists bdd_medicool;
create database bdd_medicool;
	use bdd_medicool;

create table utilisateur
(
    id int(5) not null auto_increment,
	email varchar(60) not null UNIQUE,
	mdp varchar(100) not null,
    nom varchar(50) not null,
    prenom varchar(50) not null,
    tel varchar(20) not null,
    date_naissance date not null,
    date_enregistrement date not null,
    numrue varchar(50) not null,
    rue varchar(100) not null,
    cp varchar(10) not null,
    ville varchar(100) not null,
    question enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    reponse_secrete varchar(255) not null,
    blocage enum('unlock','lock') default('unlock'),
    primary key (id)
)engine=innodb;

create table mutuelle
(
    id_mutuelle int(5) not null auto_increment,
	libelle varchar(100) not null,
	pourcent_rembourse decimal(5,2) not null,
    primary key (id_mutuelle)
)engine=innodb;

create table categorie_secu
(
    id_cat_secu int(5) not null auto_increment,
	libelle varchar(100) not null,
	pourcent_rembourse decimal(5,2) not null,
    primary key (id_cat_secu)
)engine=innodb;

create table medecin
(
    id_medecin int(5) not null auto_increment,
	email varchar(60) not null UNIQUE,
	mdp varchar(100) not null,
    nom varchar(50) not null,
    prenom varchar(50) not null,
    tel varchar(20) not null,
    date_naissance date not null,
    date_enregistrement date not null,
    numrue varchar(50) not null,
    rue varchar(100) not null,
    cp varchar(10) not null,
    ville varchar(100) not null,
    question enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    reponse_secrete varchar(255) not null,
    blocage enum('unlock','lock') default('unlock'),
    specialisation varchar(150) not null,
    date_depart_cabinet date,
    primary key (id_medecin)
)engine=innodb;

create table patient
(
    id_patient int(5) not null auto_increment,
	email varchar(60) not null UNIQUE,
	mdp varchar(100) not null,
    nom varchar(50) not null,
    prenom varchar(50) not null,
    tel varchar(20) not null,
    date_naissance date not null,
    date_enregistrement date not null,
    numrue varchar(50) not null,
    rue varchar(100) not null,
    cp varchar(10) not null,
    ville varchar(100) not null,
    question enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    reponse_secrete varchar(255) not null,
    blocage enum('unlock','lock') default('unlock'),
    numero_dossier varchar(30) not null,
    id_cat_secu int(5) not null,
    id_medecin int(5),
    primary key (id_patient),
    foreign key(id_cat_secu) references categorie_secu(id_cat_secu)
    on update cascade,
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
)engine=innodb;

create table posseder_mutuelle
(
    id_patient int(5) not null,
    id_mutuelle int(5) not null,
    primary key(id_patient,id_mutuelle)
)engine=innodb;

create table facture
(
    id_facture int(5) not null auto_increment,
    libelle varchar(100) not null,
    date_facturation date not null,
    montant_total decimal(7,2) not null,
    montant_secu decimal(7,2) not null,
    montant_mutuelle decimal(7,2) not null,
    prix_a_payer decimal(7,2) not null,
    montant_paye decimal(7,2) not null,
    etat enum('non reglee','reglee'),
    id_medecin int(5) not null,
    id_patient int(5) not null,
    primary key (id_facture),
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

create table correspondance
(
    id_correspondance int(5) not null auto_increment,
    titre varchar(100) not null,
    contenu varchar(255) not null,
    id_medecin_source int(5) not null,
    id_medecin_cible int(5) not null,
    id_patient int(5) not null,
    primary key (id_correspondance),
    foreign key(id_medecin_source) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_medecin_cible) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

create table pathologie
(
    id_path int(5) not null auto_increment,
    libelle varchar(100) not null,
    date_diagnostique date not null,
    date_guerison date,
    id_medecin int(5) not null,
    id_patient int(5) not null,
    primary key (id_path),
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

create table operation
(
    id_operation int(5) not null auto_increment,
    libelle varchar(100) not null,
    date_heure_time datetime not null,
    duree time not null,
    prix decimal(7,2) not null,
    resultat varchar(255) not null,
    commentaire varchar(255) not null,
    id_medecin int(5) not null,
    id_patient int(5) not null,
    primary key (id_operation),
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

create table operer
(
    id_medecin int(5) not null,
    id_patient int(5) not null,
    primary key (id_medecin,id_patient),
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

create table hopital
(
	id_hopital int(5) not null auto_increment,
    nom varchar(200) not null,
    numrue varchar(20) not null,
    rue varchar(100) not null,
    cp varchar(5) not null,
    ville varchar(50) not null,
    specialisation varchar(100),
    primary key (id_hopital)
)engine=innodb;

create table hospitalisation 
(
    id_hospitalisation int(5) not null auto_increment,
    raison varchar(200) not null,
    date_debut date not null,
    date_fin_estimee date not null,
    date_fin date,
    prix_par_jour float(7,2),
    id_hopital int(5) not null,
    id_patient int(5) not null,
    id_medecin int(5) not null,
    primary key (id_hospitalisation),
    foreign key(id_hopital) references hopital(id_hopital)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade,
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade
)engine=innodb;

create table traitement 
(
    id_traitement int(5) not null auto_increment,
    libelle varchar(200) not null,
    posologie varchar(200) not null,
    date_debut date not null,
    date_fin date,
    prix_par_unite float(7,2),
    id_medecin int(5) not null,
    id_patient int(5) not null,
    primary key (id_traitement),
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

create table allergie 
(
    id_allergie int(5) not null auto_increment,
    libelle varchar(200) not null,
    date_diagnostique date not null,
    date_guerison date,
    id_medecin int(5) not null,
    id_patient int(5) not null,
    primary key (id_allergie),
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

create table examen
(
    id_examen int(5) not null auto_increment,
    libelle varchar(200) not null,
    date date not null,
    prix_examen float(7,2),
    resultat date not null,
    commentaire varchar(200),
    id_medecin int(5) not null,
    id_patient int(5) not null, 
    primary key (id_examen),
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

create table planning
(
    id_planning int(5) not null auto_increment,
    annee varchar(4),
    mois varchar(2),
    semaine varchar(1),
    url varchar(255),
    id_medecin int(5) not null,
    primary key (id_planning),
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade
)engine=innodb;

create table prendre_rendez_vous
(
    id_patient int(5) not null,
    id_planning int(5) not null,
    date_heure_debut datetime not null,
    duree time not null,
    primary key (id_patient,id_planning),
    foreign key(id_planning) references planning(id_planning)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

/****************************TABLES ARCHIVE*********************************/

create table archifacture  
as 
    select * , curdate() datearchiv
    from facture 
where 2=0;

create or replace table archiprendre_rendez_vous  
as 
    select * , curdate() datearchiv
    from prendre_rendez_vous  
where 2=0;

create table archipatient  
as 
    select * , curdate() datearchiv
    from patient  
where 2=0;

create table archihospitalisation  
as 
    select * , curdate() datearchiv
    from hospitalisation  
where 2=0;

create table archiexamen   
as 
    select * , curdate() datearchiv
    from examen  
where 2=0;

create table archioperation 
as 
    select * , curdate() datearchiv
    from operation 
where 2=0;

create table architraitement  
as 
    select * , curdate() datearchiv
    from traitement  
where 2=0;

create table archiplanning 
as 
    select * , curdate() datearchiv
    from planning  
where 2=0;

/****************************TABLES SECURITE*********************************/

create table action_surveillance
(
    id_action int(5) not null auto_increment,
    type_action enum("insert","update","delete","update_old","update_new") not null,
    date_heure_action datetime not null,
    nom_table varchar(50) not null,
    id_objet varchar(20) not null,
    utilisateur varchar(100) not null,
    primary key (id_action)
)engine=innodb;

create table nb_echec_co
(
    id_echec int auto_increment not null,
    etat_blocage enum('lock','unlock') not null,
    nb_essai_restant int(1) not null,
    date_heure_echec datetime not null,
    id_utilisateur int(50) not null,
    primary key (id_echec),
    foreign key(id_utilisateur) references utilisateur(id)
    on update cascade
    on delete cascade
)engine=innodb;

/****************************PROCEDURE*********************************/

drop procedure if exists unlockuser;
DELIMITER // 
create procedure unlockuser(
    in le_id_user int(5)
)
BEGIN
    DECLARE le_id_echec int;
    if (select count(id_echec) from nb_echec_co where id_utilisateur = le_id_user) != 0
    then
        insert into nb_echec_co values(null,'unlock',3,sysdate(),le_id_user);
        update nb_echec_co set etat_blocage='unlock', nb_essai_restant=3
            where id_utilisateur = le_id_user 
            and id_echec >=all (select id_echec from nb_echec_co where id_utilisateur = le_id_user);
    end if;
    
END //
DELIMITER ;

DELIMITER // 
create procedure facturation(
    in le_prix decimal(7,2),
    in le_id_patient int,
    in le_id_medecin int,
    in le_libelle varchar(100)
)
BEGIN
    DECLARE prix_cal decimal(7,2);
    DECLARE le_montant_mutuelle decimal(7,2);
    DECLARE le_montant_secu decimal(7,2);
    DECLARE pourcent_rembourse_tot decimal(6,2) default(0);
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


/****************************TRIGGERS*********************************/

/*********************************TRIGGERS SUR PATIENT***********************************************/

drop trigger if exists patient_before_insert;
delimiter // 
create trigger patient_before_insert 
before insert on patient
for each row
begin
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
            new.question,
            new.reponse_secrete,
            new.blocage
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
        set new.question = (select question from utilisateur where email = new.email);
        set new.blocage = (select blocage from utilisateur where email = new.email);
    end if;
    set new.id_patient = (select id from utilisateur where email = new.email);
    set new.mdp = (select mdp from utilisateur where email = new.email);
    set new.reponse_secrete = (select reponse_secrete from utilisateur where email = new.email);
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
    if old.id_patient not in (select id_medecin from medecin)
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
    old.question,
    old.reponse_secrete,
    old.blocage,
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
            new.question,
            new.reponse_secrete,
            new.blocage
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
        set new.question = (select question from utilisateur where email = new.email);
        set new.blocage = (select blocage from utilisateur where email = new.email);
    end if;
    set new.id_medecin = (select id from utilisateur where email = new.email);
    set new.mdp = (select mdp from utilisateur where email = new.email);
    set new.reponse_secrete = (select reponse_secrete from utilisateur where email = new.email);
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
    set new.reponse_secrete = sha2(
        concat(
            (select ednareugedles from sterces.remedles where ruetasilitu=sha2(new.email,256)),
            new.reponse_secrete
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
    if new.mdp not like old.mdp
    then
        set new.mdp = sha2(
        concat(
            (select ednareugedles from sterces.remedles where ruetasilitu=sha2(new.email,256)),
            new.mdp
            ),256
        );
    end if;
    if new.reponse_secrete not like old.reponse_secrete
    then
        set new.reponse_secrete = sha2(
            concat(
                (select ednareugedles from sterces.remedles where ruetasilitu=sha2(new.email,256)),
                new.reponse_secrete
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
            question = new.question,
            reponse_secrete = new.reponse_secrete,
            blocage = new.blocage
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
            question = new.question,
            reponse_secrete = new.reponse_secrete,
            blocage = new.blocage
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
    old.id_medecin,
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
   insert into action_surveillance values(null,"insert",sysdate(),"operer",concat(new.id_medecin,',',new.id_patient),current_user());
end //
delimiter ;

drop trigger if exists operer_after_update;
delimiter // 
create trigger operer_after_update 
after update on operer
for each row
begin
    if new.id_medecin = old.id_medecin and new.id_patient = old.id_patient
    then
        insert into action_surveillance values(null,"update",sysdate(),"operer",concat(new.id_medecin,',',new.id_patient),current_user());
    else
        insert into action_surveillance values(null,"update_old",sysdate(),"operer",concat(old.id_medecin,',',old.id_patient),current_user());
        insert into action_surveillance values(null,"update_new",sysdate(),"operer",concat(new.id_medecin,',',new.id_patient),current_user());
    end if;
end //
delimiter ;

drop trigger if exists operer_after_delete;
delimiter // 
create trigger operer_after_delete 
after delete on operer
for each row
begin
    insert into action_surveillance values(null,"delete",sysdate(),"operer",concat(old.id_medecin,',',old.id_patient),current_user());
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
        old.prix_par_jour,
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

/*******************************************INSERTS*******************************************/
insert into mutuelle values(null,'lmde',55);
insert into mutuelle values(null,'lmdesriches',95);
insert into mutuelle values(null,'lmdespauvres',2);
insert into categorie_secu values(null,'cmu de base',30);
insert into categorie_secu values(null,'handicap',60);
insert into categorie_secu values(null,'retraite',15);

insert into medecin values(null,'emailmedecin@gmail.com','123','nommedecin','prenom_medecin','01234567879','1980-01-01',sysdate(),'12','rue_medecin','750medeci','medecinville',4,"Chouaki",null,'speci_med',null);
insert into patient values(null,'emailpat@gmail.com','123','balloch','patoch','01857467879','2000-01-01','2012-12-12','666','rue_patoch','66666','enfer',4,"Chouaki",null,'6666666666',2,null);
insert into patient values(null,'email_minouche@gmail.com','123','Nouchnouch','minouch','0987654321','1895-01-01','2000-12-24','5','rue patouch','7minouch','hess',4,"Chouaki",null,'0000000001',3,1);
insert into medecin values(null,'totaltout@gmail.com','123','total','tout','01234562879','1985-01-01',sysdate(),'15','rue du tout','750tout','toutville',4,"Chouaki",null,'touticien',null);
insert into patient values(null,'totaltout@gmail.com','m','n','p','t','2000-10-10','2000-10-10','n','r','c','v',4,"Chouaki",null,'0123495874',1,1);

insert into posseder_mutuelle values(2,2);
insert into posseder_mutuelle values(3,3);
insert into posseder_mutuelle values(4,2);
insert into posseder_mutuelle values(2,3);
insert into posseder_mutuelle values(2,1);

/**************************************INSERTS TEST SURVEY ACTIONS NE PAS SUPPRIMER (TESTS UNITAIRES)**************************************/
/*
insert into mutuelle values(5,'testmutuelle',10);
insert into categorie_secu values(5,'testcatsecu',10);
insert into medecin values(5,'test@test.com','testmdp','testnom','testprenom','testtel',curdate(),curdate(),'testnumrue','testrue','testcp','testville',4,"Chouaki",null,'testspecialisation',null);
insert into patient values(5,'test@test.com','testmdp','testnom','testprenom','testtel',curdate(),curdate(),'testnumrue','testrue','testcp','testville',4,"Chouaki",null,'testnumdoc',5,5);
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