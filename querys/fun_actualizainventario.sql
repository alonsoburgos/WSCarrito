-- Function: public.fun_actualizainventario(integer, integer)

-- DROP FUNCTION public.fun_actualizainventario(integer, integer);

CREATE OR REPLACE FUNCTION public.fun_actualizainventario(iproducto integer, icantidad integer)
  RETURNS void AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :25/07/19 15:53  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
DECLARE
iExistencia	       int;
BEGIN
	SELECT num_existencia INTO iExistencia FROM cat_productos WHERE idu_producto = iProducto;
	iExistencia := iExistencia - iCantidad;
	UPDATE cat_productos SET num_existencia = iExistencia WHERE idu_producto = iProducto;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100;
ALTER FUNCTION public.fun_actualizainventario(integer, integer)
  OWNER TO sysinnovacion;
