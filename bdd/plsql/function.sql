
/*******************************FONCTION*******************************/

drop function if exists remedless;
DELIMITER // 
create function remedless(leemailuser varchar(100))
returns varchar(255)
begin
    declare mavar varchar(255);
    select ednareugedles into mavar from sterces.remedles where ruetasilitu = sha2(leemailuser,256);
    return (mavar);
end //
DELIMITER ;