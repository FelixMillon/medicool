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
    numero_dossier varchar(30) not null,
    id_cat_secu int(5) not null,
    id_medecin int(5),
    primary key (id_patient),
    foreign key(id_cat_secu) references categorie_secu(id_cat_secu)
    on update cascade
    on delete cascade,
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade
)engine=innodb;

create table posseder_mutuelle
(
    id_patient int(5) not null,
    id_mutuelle int(5) not null
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
    date_heure datetime not null,
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
    date_estimee date not null,
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
    date date not null,
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
    date_heure_debut date not null,
    duree time not null,
    primary key (id_planning),
    foreign key(id_planning) references planning(id_planning)
    on update cascade
    on delete cascade,
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;


create table archifacture  
as 
    select * , NOW() datearchiv
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
end //
delimiter ;





create table avertissmentABS as select 
    numsecu,
    nome,
    prenome,
    datenaiss,
    numq,
    numa,
    total_abs,
    user histouser,
    sysdate datearchi
from employe 
where 2=0;


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







drop trigger if exists patient_before_insert;
delimiter // 
create trigger patient_before_insert 
before insert on patient
for each row
begin
    if new.email not in (select email from utilisateur)
    then
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
            new.ville
        );
    else
        set new.mdp = (select mdp from utilisateur where email = new.email);
        set new.nom = (select nom from utilisateur where email = new.email);
        set new.prenom = (select prenom from utilisateur where email = new.email);
        set new.tel = (select tel from utilisateur where email = new.email);
        set new.date_naissance = (select date_naissance from utilisateur where email = new.email);
        set new.date_enregistrement = (select date_enregistrement from utilisateur where email = new.email);
        set new.numrue = (select numrue from utilisateur where email = new.email);
        set new.rue = (select rue from utilisateur where email = new.email);
        set new.cp = (select cp from utilisateur where email = new.email);
        set new.ville = (select ville from utilisateur where email = new.email);
    end if;
    set new.id_patient = (select id from utilisateur where email = new.email);
end //
delimiter ;

drop trigger if exists medecin_before_insert;
delimiter // 
create trigger medecin_before_insert 
before insert on medecin
for each row
begin
    if new.email not in (select email from utilisateur)
    then
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
            new.ville
        );
    else
        set new.mdp = (select mdp from utilisateur where email = new.email);
        set new.nom = (select nom from utilisateur where email = new.email);
        set new.prenom = (select prenom from utilisateur where email = new.email);
        set new.tel = (select tel from utilisateur where email = new.email);
        set new.date_naissance = (select date_naissance from utilisateur where email = new.email);
        set new.date_enregistrement = (select date_enregistrement from utilisateur where email = new.email);
        set new.numrue = (select numrue from utilisateur where email = new.email);
        set new.rue = (select rue from utilisateur where email = new.email);
        set new.cp = (select cp from utilisateur where email = new.email);
        set new.ville = (select ville from utilisateur where email = new.email);
    end if;
    set new.id_medecin = (select id from utilisateur where email = new.email);
end //
delimiter ;

drop trigger if exists utilisateur_before_update;
delimiter // 
create trigger utilisateur_before_update 
before update on utilisateur
for each row
begin
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
            ville = new.ville 
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
            ville = new.ville 
            where id_medecin = new.id;
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
end //
delimiter ;

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



insert into mutuelle values(null,'lmde',55);
insert into mutuelle values(null,'lmdesriches',95);
insert into mutuelle values(null,'lmdespauvres',2);
insert into categorie_secu values(null,'cmu de base',30);
insert into categorie_secu values(null,'handicap',60);
insert into categorie_secu values(null,'retraite',15);


insert into medecin values(null,'emailmedecin@gmail.com','123','nommedecin','prenom_medecin','01234567879','1980-01-01',sysdate(),'12','rue_medecin','750medeci','medecinville','speci_med',null);
insert into patient values(null,'emailpat@gmail.com','123','balloch','patoch','01857467879','2000-01-01','2012-12-12','666','rue_patoch','66666','enfer','6666666666',2,null);
insert into patient values(null,'email_minouche@gmail.com','123','Nouchnouch','minouch','0987654321','1895-01-01','2000-12-24','5','rue patouch','7minouch','hess','0000000001',3,1);
insert into medecin values(null,'totaltout@gmail.com','123','total','tout','01234562879','1985-01-01',sysdate(),'15','rue du tout','750tout','toutville','touticien',null);

insert into patient values(null,'totaltout@gmail.com','m','n','p','t','2000-10-10','2000-10-10','n','r','c','v','0123495874',1,1);

insert into posseder_mutuelle values(2,2);
insert into posseder_mutuelle values(3,3);
insert into posseder_mutuelle values(4,2);
insert into posseder_mutuelle values(2,3);
insert into posseder_mutuelle values(2,1);