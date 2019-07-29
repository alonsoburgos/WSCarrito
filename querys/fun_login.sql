-- Function: public.fun_login(character varying, character varying)

-- DROP FUNCTION public.fun_login(character varying, character varying);

CREATE OR REPLACE FUNCTION public.fun_login(IN semail character varying, IN spassword character varying)
  RETURNS TABLE(idu_usuario integer, nom_usuario character varying) AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :26/07/19 16:10  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
BEGIN
	IF EXISTS(SELECT * FROM cat_usuarios WHERE des_email = sEmail AND des_password = sPassword) THEN
		RETURN QUERY 
			SELECT 	U.idu_usuario,
				U.nom_usuario
			FROM cat_usuarios U
			WHERE U.des_email = sEmail AND U.des_password = sPassword;
	ELSE
		RETURN QUERY SELECT 0, ''::varchar;
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100
  ROWS 1000;
ALTER FUNCTION public.fun_login(character varying, character varying)
  OWNER TO sysinnovacion;
