-- Function: public.fun_guardarventadetalle(integer, integer, integer, integer, integer)

-- DROP FUNCTION public.fun_guardarventadetalle(integer, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION public.fun_guardarventadetalle(iventa integer, iproducto integer, icantidad integer, iprecio integer, itotalproducto integer)
  RETURNS void AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :25/07/19 15:00  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
DECLARE
idVentaDetalle	       int;
BEGIN
	SELECT COALESCE(MAX(idu_ventadetalle), 0) + 1 INTO idVentaDetalle FROM mov_ventasdetalle WHERE idu_venta = iVenta;
	INSERT INTO mov_ventasdetalle(idu_venta, idu_ventadetalle, idu_producto, num_cantidad, imp_precio, imp_totalproducto) VALUES(iVenta, idVentaDetalle, iProducto, iCantidad, iPrecio, iTotalProducto);
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100;
ALTER FUNCTION public.fun_guardarventadetalle(integer, integer, integer, integer, integer)
  OWNER TO sysinnovacion;
