-- Function: public.fun_guardarventa(integer)

-- DROP FUNCTION public.fun_guardarventa(integer);

CREATE OR REPLACE FUNCTION public.fun_guardarventa(itotalcompra integer)
  RETURNS integer AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :25/07/19 15:00  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
DECLARE
	idVenta	       int;
BEGIN
	SELECT COALESCE(MAX(idu_venta), 0) + 1 INTO idVenta FROM mov_ventas;
	INSERT INTO mov_ventas(idu_venta, imp_total)VALUES(idVenta, iTotalCompra);
	RETURN idVenta;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100;
ALTER FUNCTION public.fun_guardarventa(integer)
  OWNER TO sysinnovacion;
