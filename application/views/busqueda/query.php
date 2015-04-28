select 
TB.id_Boleta, TB.numero_boleta, TB.monto_boleta, TB.fecha_recepcion, TB.fecha_emision, TB.fecha_vencimiento, TB.denominacion,
TE.rut, TE.nombre,
TBC.nombre_banco,
TM.nombre_moneda, TM.codigo,
TTG.descripcion,
TTB.descripcion_tipo_boleta,
TEB.descripcion

from 
tbl_boleta as TB, 
tbl_entidad as TE,
tbl_banco as TBC, 
tbl_moneda as TM, 
tbl_tipogarantia as TTG, 
tbl_tipoboleta as TTB, 
tbl_estadoboleta as TEB

where
TB.tbl_Entidad_idEntidad = TE.idEntidad and
TB.tbl_Banco_idBanco = TBC.idBanco and
TB.tbl_Moneda_idMoneda = TM.idMoneda and
TB.tbl_TipoGarantia_idTipoGarantia = TTG.idTipoGarantia and
TB.tbl_TipoBoleta_idTipoBoleta = TTB.idTipoBoleta and
TB.tbl_EstadoBoleta_idEstadoBoleta = TEB.idEstadoBoleta