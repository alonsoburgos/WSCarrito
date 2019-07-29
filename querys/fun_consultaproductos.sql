-- Function: public.fun_consultaproductos()

-- DROP FUNCTION public.fun_consultaproductos();

CREATE OR REPLACE FUNCTION public.fun_consultaproductos()
  RETURNS TABLE(idu_producto integer, nom_producto character varying, imp_precio bigint, num_existencia integer) AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :24/07/19 14:50  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------

BEGIN
	RETURN QUERY 
		SELECT 	P.idu_producto,
			P.nom_producto,
			P.imp_precio,
			P.num_existencia
		FROM cat_productos P;
                  
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100
  ROWS 1000;
ALTER FUNCTION public.fun_consultaproductos()
  OWNER TO sysinnovacion;
