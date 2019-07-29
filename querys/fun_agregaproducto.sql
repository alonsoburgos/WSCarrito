-- Function: public.fun_agregaproducto(character varying, integer, integer)

-- DROP FUNCTION public.fun_agregaproducto(character varying, integer, integer);

CREATE OR REPLACE FUNCTION public.fun_agregaproducto(sproducto character varying, iprecio integer, iexistencia integer)
  RETURNS void AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :25/07/19 16:00  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
BEGIN
	INSERT INTO cat_productos(nom_producto,imp_precio,num_existencia) VALUES(sProducto, iPrecio, iExistencia);
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100;
ALTER FUNCTION public.fun_agregaproducto(character varying, integer, integer)
  OWNER TO sysinnovacion;
