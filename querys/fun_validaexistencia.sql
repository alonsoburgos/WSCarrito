-- Function: public.fun_validaexistencia(integer, integer)

-- DROP FUNCTION public.fun_validaexistencia(integer, integer);

CREATE OR REPLACE FUNCTION public.fun_validaexistencia(iproducto integer, icantidad integer)
  RETURNS smallint AS
$BODY$
--  -----------------------------------------------------------------------------------
--    Fecha    :24/07/19 14:50  ( dd-mm-aa )
--    Elabor¢  :Alonso Burgos Astorga
--   -----------------------------------------------------------------------------------
    --iFlag:      0 = La cantidad del producto en existencia es menor
    --            1 = La cantidad del producto existe en inventario

DECLARE
    iFlag     		int2 = 0;

BEGIN

	IF ((SELECT num_existencia FROM cat_productos  WHERE idu_producto = iProducto)>= iCantidad) THEN
	    iFlag=1;
	END IF;

    RETURN iFlag;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER
  COST 100;
ALTER FUNCTION public.fun_validaexistencia(integer, integer)
  OWNER TO sysinnovacion;
