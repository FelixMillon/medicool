
/*******************************TABLE VUE*******************************/

create view vallergie as (
    select a.*, p.email 
    from allergie a, patient p
    where a.id_patient = p.id_patient
);

create view vexamen as (
    select e.*, p.email 
    from examen e, patient p
    where e.id_patient = p.id_patient
);

create view vcorrespondance as (
    select c.*, p.email 
    from correspondance c, patient p
    where c.id_patient = p.id_patient
);

create view vfacture as (
    select f.*, p.email 
    from facture f, patient p
    where f.id_patient = p.id_patient
);

create view vhospitalisation as (
    select h.*, p.email 
    from hospitalisation h, patient p
    where h.id_patient = p.id_patient
);

create view voperation as (
    select o.*, p.email 
    from operation o, patient p
    where o.id_patient = p.id_patient
);

create view vpathologie as (
    select pa.*, p.email 
    from pathologie pa, patient p
    where pa.id_patient = p.id_patient
);

create view vtraitement as (
    select t.*, p.email 
    from traitement t, patient p
    where t.id_patient = p.id_patient
);