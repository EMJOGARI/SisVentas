select  v.idvendedor, p2.nombre, dv.idarticulo, a.nombre, a.idcategoria, c.nombre, dv.cantidad
from tb_venta as v
join tb_persona as p2 on p2.idpersona = v.idvendedor
join tb_detalle_venta as dv on dv.idventa = v.idventa
join tb_articulo as a on a.idarticulo = dv.idarticulo
join tb_categoria as c on c.idcategoria = a.idcategoria

where v.estado <> 'Eliminada' and v.estado <> 'Anulada' and v.fecha_hora >= '2019-10-01' and v.fecha_hora <= '2019-10-31'  and v.idvendedor = 225 and a.idcategoria = 8

group by v.idvendedor, p2.nombre, dv.idarticulo, a.nombre, a.idcategoria, c.nombre, dv.cantidad

order by cantidad desc

/*tablas nota de credito*/
CREATE TABLE tb_nota_credito
(
  idnoce serial NOT NULL,
  idventa integer,
  tipo character varying(15),
  num_noce integer,
  serie_noce integer,
  total_noce numeric(11,2),
  fecha date,
  estado character varying(10),
  CONSTRAINT tb_nota_credito_pkey PRIMARY KEY (idnoce),
  CONSTRAINT tb_nota_credito_idventa_foreing FOREIGN KEY (idventa)
      REFERENCES tb_venta (idventa) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_nota_debito
  OWNER TO postgres;

/*tabla detalle nota de credito*/
CREATE TABLE tb_detalle_noce
(
  id_detalle_noce serial NOT NULL,
  idnoce integer,
  idarticulo integer,
  cantidad integer,
  descuento integer,
  precio_venta numeric(11,2),
  CONSTRAINT tb_detalle_noce_pkey PRIMARY KEY (id_detalle_noce),
  CONSTRAINT tb_detalle_noce_idarticulo_foreign FOREIGN KEY (idarticulo)
      REFERENCES tb_articulo (idarticulo) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT tb_detalle_noce_idnoce_foreign FOREIGN KEY (idnoce)
      REFERENCES tb_nota_credito (idnoce) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_detalle_node
  OWNER TO postgres;

/*tabla ventas */

CREATE TABLE tb_venta
(
  idventa serial NOT NULL,
  idcliente integer NOT NULL,
  tipo_comprobante character varying(10) NOT NULL,
  serie_comprobante character varying(10) NOT NULL,
  num_comprobante character varying(10) NOT NULL,
  total_venta numeric(11,2) NOT NULL,
  estado character varying(10) NOT NULL,
  fecha_hora date NOT NULL,
  idvendedor integer,
  detalle character varying(200),
  fecha_entrega date, /*NUEVOS*/
  idnoce integer, /*NUEVOS*/
  total_noce numeric(11,2), /*NUEVOS*/
  CONSTRAINT tb_venta_pkey PRIMARY KEY (idventa),
  CONSTRAINT tb_venta_idcliente_foreign FOREIGN KEY (idcliente)
      REFERENCES tb_persona (idpersona) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_venta
  OWNER TO postgres;
-------------------------------------------------------------------
http://youtube.com/watch?reload=9&v=7T80LZR850o
-------------------------------------------------------------------
agregar fecha creacion a la base de datos en persona
eliminar el campo codigo de la tabla articulo en la bd
-------------------------------------------------------------------
-------------------------------------------------------------------
https://github.com/fxcosta/laravel-chartjs
https://appdividend.com/2017/07/13/add-charts-laravel-using-chartjs/

https://dev.to/arielsalvadordev/use-laravel-charts-in-laravel-5bbm
-------------------------------------------------------------------
/*select v.idventa, v.idcliente, v.serie_comprobante, v.total_venta
	,(select nd.total_debito from tb_nota_debito as nd where v.idventa = nd.idventa and nd.estado = 'Activo')
	,(v.total_venta - (select total_debito from tb_nota_debito where v.idventa = idventa and estado = 'Activo')) as monto_pagar
from tb_venta as v
where v.estado <> 'Eliminada' and v.estado <> 'Anulada'
order by v.idventa desc*/

select *
from tb_venta as v
FULL OUTER JOIN tb_nota_debito as nd on nd.idventa = v.idventa
-------------------------------------------------------------------
POSGRETS SQL FUNCIONES
wewe

http://www.postgresqltutorial.com/postgresql-extract/
-------------------------------------------------------------------
-------------------------------------------------------------------

The King’s Avatar
https://www6.doramasmp4.com/the-kings-avatar-capitulo-1/?fbclid=IwAR3VMApRxkcykFBC9gyppBQYrUN5gUV2EXy8RDAJzz91QcX-QXehkJ_W2yk
https://www.mundodonghua.com/ver/quan-zhi-gao-shou-all-star/3

Afro zamurai
ouanzhi gaoshou
Radian // radian season 2
assassins pride
fairy gone
noragami
crhome shelled regios
desetsu no yuusha
trigun
 Campione
Tales of Zestiria the X
-------------------------------------------------------------------
COMPRAS POR CLIENTES
-------------------------------------------------------------------
SELECT i.idcliente,di.idarticulo, a.nombre, c.nombre, SUM(cantidad), SUM(cantidad * precio_venta)
FROM tb_venta AS i
JOIN tb_detalle_venta AS di ON di.idventa = i.idventa
JOIN tb_articulo AS a ON a.idarticulo = di.idarticulo
JOIN tb_categoria AS c ON c.idcategoria = a.idcategoria
WHERE i.estado = 'Pagada' and c.idcategoria = 6
GROUP BY i.idcliente,di.idarticulo, a.nombre, c.nombre
ORDER BY i.idcliente
-------------------------------------------------------------------
PARA UPDATEAR TODOS LOS CAMPOS D ELA BD
-------------------------------------------------------------------
CREATE OR REPLACE FUNCTION cargar_bd()
RETURNS void AS
$BODY$BEGIN
	for i in 1..130 loop
		UPDATE tb_ingreso
		SET total_compra = (select SUM(cantidad * precio_compra) from tb_detalle_ingreso WHERE idingreso = i)
		WHERE idingreso = i;
	end loop;
END;$BODY$
LANGUAGE 'plpgsql' VOLATILE;

select cargar_bd(); --PARA CARGAR LOS CAMPOS
-------------------------------------------------------------------
CONSULTAR BD TOTAL INGRESO
-------------------------------------------------------------------
SELECT SUM(total_compra) as total, EXTRACT(MONTH FROM fecha_hora) as mes, to_char(fecha_hora, 'TMMonth') as nombre
FROM tb_ingreso
WHERE estado = 'A' AND EXTRACT(YEAR FROM fecha_hora) = 2019
GROUP BY EXTRACT(MONTH FROM fecha_hora),nombre
ORDER BY  mes
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
/*Articulos no vendidos*/
select *
from tb_articulo
where stock > 0 and estado = 'Activo' and idarticulo not in (select dv.idarticulo
						from tb_detalle_venta as dv
						join tb_venta as v on v.idventa = dv.idventa
						join tb_articulo as a on a.idarticulo = dv.idarticulo
						where v.fecha_hora >= '2019-09-01' and v.fecha_hora <= '2019-09-30' and v.estado <> 'Anulada' and v.estado <> 'Eliminada'
					      )
order by idarticulo
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------
/*Articulos mas vendidos*/
select dv.idarticulo,a.nombre,sum(cantidad) as cantidad
from tb_detalle_venta as dv
join tb_venta as v on v.idventa = dv.idventa
join tb_articulo as a on a.idarticulo = dv.idarticulo
join tb_categoria as c on c.idcategoria = a.idcategoria
where v.fecha_hora >= '2019-09-01' and v.estado <> 'Anulada' and v.estado <> 'Eliminada'

group by dv.idarticulo,a.nombre
order by cantidad desc
------------------------------------------------------------------------------------
------------------------------------------------------------------------------------



https://aprendible.com/series/laravel-excel
