-- Function: public.fun_eliminaproductodelcarrito(integer, integer)

-- DROP FUNCTION public.fun_eliminaproductodelcarrito(integer, integer);

CREATE OR REPLACE FUNCTION public.fun_eliminaproductodelcarrito(iusuario integer, iproducto integer)
  RETURNS void AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :24/07/19 18:06  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
BEGIN
	DELETE FROM ctl_carrito WHERE idu_usuario = iUsuario AND idu_producto = iProducto;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100;
ALTER FUNCTION public.fun_eliminaproductodelcarrito(integer, integer)
  OWNER TO sysinnovacion;
