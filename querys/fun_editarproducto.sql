-- Function: public.fun_editarproducto(integer, character varying, integer, integer)

-- DROP FUNCTION public.fun_editarproducto(integer, character varying, integer, integer);

CREATE OR REPLACE FUNCTION public.fun_editarproducto(iproducto integer, sproducto character varying, iprecio integer, iexistencia integer)
  RETURNS void AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :25/07/19 16:26  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
BEGIN
	UPDATE cat_productos SET nom_producto = sProducto, imp_precio = iPrecio, num_existencia = iExistencia WHERE idu_producto = iProducto;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100;
ALTER FUNCTION public.fun_editarproducto(integer, character varying, integer, integer)
  OWNER TO sysinnovacion;
