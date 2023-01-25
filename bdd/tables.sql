/********************************************Base pour stocker les secrets (les salts)********************************************************************/

drop database if exists  sterces ;
create database sterces;
    use sterces;

/*Table stock utilisateur associé à leurs salt*/
create table remedles
(
    ruetasilitu varchar(255) not null,
    ednareugedles varchar(255) not null,
    primary key (ruetasilitu)
)engine=innodb;

/****************************************************************** Base medicool ********************************************************************/
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
    question_1 enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    question_2 enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    reponse_secrete_1 varchar(255) not null,
    reponse_secrete_2 varchar(255) not null,
    blocage enum('unlock','lock') default 'unlock',
    droits enum('utilisateur','developpeur','administrateur','super_administrateur') not null,
    primary key (id)
)engine=innodb;

create table secretaire
(
    id_secretaire int(5) not null auto_increment,
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
    question_1 enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    question_2 enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    reponse_secrete_1 varchar(255) not null,
    reponse_secrete_2 varchar(255) not null,
    blocage enum('unlock','lock') default 'unlock',
    droits enum('utilisateur','developpeur','administrateur','super_administrateur') not null,
    primary key (id_secretaire)
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
    question_1 enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    question_2 enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    reponse_secrete_1 varchar(255) not null,
    reponse_secrete_2 varchar(255) not null,
    blocage enum('unlock','lock') default 'unlock',
    droits enum('utilisateur','developpeur','administrateur','super_administrateur') not null,
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
    question_1 enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    question_2 enum(
        'Nom de votre ecole primaire',
        'Nom de jeune fille de votre mère',
        'Nom de votre premier amour',
        'Nom de votre professeur prefere',
        'Ville de rencontre de vos parents',
        'Nom de votre roman prefere'
    ) not null,
    reponse_secrete_1 varchar(255) not null,
    reponse_secrete_2 varchar(255) not null,
    blocage enum('unlock','lock') default 'unlock',
    droits enum('utilisateur','developpeur','administrateur','super_administrateur') not null,
    numero_dossier varchar(30) not null,
    id_cat_secu int(5) not null,
    id_medecin int(5),
    primary key (id_patient),
    foreign key(id_cat_secu) references categorie_secu(id_cat_secu),
    foreign key(id_medecin) references medecin(id_medecin)
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
    titre varchar(255) not null,
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
    libelle varchar(255) not null,
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
    libelle varchar(255) not null,
    date_heure_time datetime not null,
    duree time not null,
    prix decimal(7,2) not null,
    resultat varchar(255) not null,
    commentaire varchar(255) not null,
    id_patient int(5) not null,
    primary key (id_operation),
    foreign key(id_patient) references patient(id_patient)
    on update cascade
    on delete cascade
)engine=innodb;

create table operer
(
    id_medecin int(5) not null,
    id_operation int(5) not null,
    primary key (id_medecin,id_operation),
    foreign key(id_medecin) references medecin(id_medecin)
    on update cascade
    on delete cascade,
    foreign key(id_operation) references operation(id_operation)
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
    raison varchar(255) not null,
    date_debut date not null,
    date_fin_estimee date not null,
    date_fin date,
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
    libelle varchar(255) not null,
    posologie varchar(255) not null,
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
    libelle varchar(255) not null,
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
    libelle varchar(255) not null,
    date date not null,
    prix_examen float(7,2),
    resultat varchar(255) not null,
    commentaire varchar(255),
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

create table archiprendre_rendez_vous  
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

/*Table conservant l'ensemble des insert update et deletes sur la base de donnée*/
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

/*Table stockant les echecs de connexion par utilisateur*/
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