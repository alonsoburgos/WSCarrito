-- Function: public.fun_consultaproductoscarrito(integer)

-- DROP FUNCTION public.fun_consultaproductoscarrito(integer);

CREATE OR REPLACE FUNCTION public.fun_consultaproductoscarrito(IN iusuario integer)
  RETURNS TABLE(idu_usuario integer, idu_producto integer, nom_producto character varying, num_cantidad integer, imp_precio bigint, imp_totalproducto bigint) AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :24/07/19 16:10  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------

BEGIN
	RETURN QUERY 
		SELECT 	C.idu_usuario,
			C.idu_producto,
			P.nom_producto,
			C.num_cantidad,
			P.imp_precio,
			P.imp_precio * C.num_cantidad
		FROM ctl_carrito C
		LEFT JOIN cat_productos P ON P.idu_producto = C.idu_producto
		WHERE C.idu_usuario = iUsuario;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100
  ROWS 1000;
ALTER FUNCTION public.fun_consultaproductoscarrito(integer)
  OWNER TO sysinnovacion;
