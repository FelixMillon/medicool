drop database if exists sterces;
create database sterces;
    use sterces;

create table keycrypte
(
    utilisateur varchar(255) not null,
    cle varchar(255) not null,
    primary key (utilisateur)
)engine=innodb;


create table archiv_keycrypte
(
    id_archiv_key int(5) not null auto_increment,
    utilisateur varchar(255) not null,
    cle varchar(255) not null,
    primary key (id_archiv_key)
)engine=innodb;

create table remedles
(
    ruetasilitu varchar(255) not null,
    ednareugedles varchar(255) not null,
    primary key (ruetasilitu)
)engine=innodb;

drop trigger if exists keycrypte_after_delete;
delimiter // 
create trigger keycrypte_after_delete
after delete on keycrypte
for each row
begin
    insert into archiv_keycrypte values(
    null,
    old.utilisateur,
    old.cle);
end //
delimiter ;