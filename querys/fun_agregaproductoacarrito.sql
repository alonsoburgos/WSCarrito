-- Function: public.fun_agregaproductoacarrito(integer, integer, integer)

-- DROP FUNCTION public.fun_agregaproductoacarrito(integer, integer, integer);

CREATE OR REPLACE FUNCTION public.fun_agregaproductoacarrito(iusuario integer, iproducto integer, icantidad integer)
  RETURNS void AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :24/07/19 14:50  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
BEGIN
	IF EXISTS (SELECT idu_producto FROM ctl_carrito WHERE idu_usuario = iUsuario AND idu_producto = iProducto) THEN
	   UPDATE ctl_carrito SET num_cantidad = iCantidad WHERE idu_usuario = iUsuario AND idu_producto = iProducto;
	ELSE 
	   INSERT INTO ctl_carrito(idu_usuario, idu_producto, num_cantidad)VALUES(iUsuario,iProducto,iCantidad);
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100;
ALTER FUNCTION public.fun_agregaproductoacarrito(integer, integer, integer)
  OWNER TO sysinnovacion;
