-- Function: public.fun_eliminacarrito(integer)

-- DROP FUNCTION public.fun_eliminacarrito(integer);

CREATE OR REPLACE FUNCTION public.fun_eliminacarrito(iusuario integer)
  RETURNS void AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :25/07/19 12:06  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
BEGIN
	DELETE FROM ctl_carrito WHERE idu_usuario = iUsuario;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100;
ALTER FUNCTION public.fun_eliminacarrito(integer)
  OWNER TO sysinnovacion;
