<?php

class estadocuenta {
    /*
      |--------------------------------------------------------------------------
      | Metodo Agregar usuario de LDAP
      |--------------------------------------------------------------------------
      | creamos el usuario si el no existe
      |en la tabla usuarios
     */

    public function resumen($cedula) {
		$pagonor=0;
		$restanor=0;
		$pagoes=0;
		$restaes=0;
		$cuenta = paraTodos::arrayConsulta("p.ID, tp.NAME, p.SOLICITADO, p.INICIO_NORM", "prest p, tp_prest tp", "p.CEDULA=$cedula and p.TP_PREST=tp.ID");
		foreach($cuenta as $rowp) {
			$normal = paraTodos::arrayConsulta("PAGO, RESTA", "amort_nor an", "an.PREST=$rowp[ID] order by PAGO desc limit 1");
			foreach($normal as $rown){
				$pagonor = $rown[PAGO];
				$restanor = $rown[RESTA];
			}
            $especial = paraTodos::arrayConsulta("PAGO, RESTA", "amort_esp ae", "ae.PREST=$rowp[ID] order by PAGO desc limit 1");
			foreach($especial as $rowes){
				$pagoes = $rowes[PAGO];
				$restaes = $rowes[RESTA];
			}
?>
	<tr>
		<td align="right"><?php echo $rowp[ID];?></td>
		<td><a href="javascript:void(0)" onclick="$.ajax({
                           type: 'POST',
                           url: 'accion.php',
                           ajaxSend: $('#estado_content').html(cargando),
                            data: {
                            	dmn:144,
                            	act:2,
                            	ver:2,
                            	codigo:<?php echo $rowp[ID];?>
                            },
                            success: function(html) {$('#estado_content').html(html); },
                            error: function(xhr,msg,excep) { alert('Error Status ' + xhr.status + ': ' + msg + '/ ' + excep); }
                            }); return false;"><?php echo $rowp[NAME];?></a></td>
		<td align="right"><?php echo $rowp[INICIO_NORM];?></td>
		<td align="right"><?php echo number_format($rowp[SOLICITADO], 2, ',', '.');?></td>
		<td align="right"><?php echo number_format($pagonor, 2, ',', '.');?></td>
		<td align="right"><?php echo number_format($pagoes, 2, ',', '.');?></td>
		<td align="right"><?php echo number_format($restanor, 2, ',', '.');?></td>
		<td align="right"><?php echo number_format($restaes, 2, ',', '.');?></td>
	</tr>
	<?php
		}
	}
	public function resumentotal($cedula) {
		$pagonor=0;
		$restanor=0;
		$pagoes=0;
		$restaes=0;
		$cuenta = paraTodos::arrayConsulta("p.ID,p.SOLICITADO", "prest p, tp_prest tp", "p.CEDULA=$cedula and p.TP_PREST=tp.ID");
		foreach($cuenta as $rowp) {
			$contar = $contar+1;
			$solicitado = $solicitado+$rowp[SOLICITADO];
			$normal = paraTodos::arrayConsulta("PAGO, RESTA", "amort_nor an", "an.PREST=$rowp[ID] order by PAGO desc limit 1");
			foreach($normal as $rown){
				$pagonor = $pagonor + $rown[PAGO];
				$restanor = $restanor + $rown[RESTA];
			}
			$especial = paraTodos::arrayConsulta("PAGO, RESTA", "amort_esp ae", "ae.PREST=$rowp[ID] order by PAGO desc limit 1");
			foreach($especial as $rowes){
				$pagoes = $pagoes + $rowes[PAGO];
				$restaes = $restaes + $rowes[RESTA];
			}
		}
?>
		<tr>
			<td></td>
			<td><strong>Total prestamos que afectan disponibilidad</strong></td>
			<td></td>
			<td align="right"><?php echo number_format($solicitado, 2, ',', '.');?></td>
			<td align="right"><?php echo number_format($pagonor, 2, ',', '.');?></td>
			<td align="right"><?php echo number_format($pagoes, 2, ',', '.');?></td>
			<td align="right"><?php echo number_format($restanor, 2, ',', '.');?></td>
			<td align="right"><?php echo number_format($restaes, 2, ',', '.');?></td>
		</tr>
		<?php
	}
	public function resumen_estadodet($codigo){
		$pagonor=0;
		$restanor=0;
		$pagoes=0;
		$restaes=0;
		$cuenta = paraTodos::arrayConsulta("p.ID,p.SOLICITADO, p.CREADO_EL, p.INICIO_NORM,p.INICIO_ESP", "prest p", "p.ID=$codigo");
		foreach($cuenta as $rowp) {
			$solicitado = $rowp[SOLICITADO];
			$creado = $rowp[CREADO_EL];
			$inicionor = $rowp[INICIO_NORM];
			$inicioes = $rowp[INICIO_ESP];
			$normal = paraTodos::arrayConsulta("PAGO, RESTA", "amort_nor an", "an.PREST=$rowp[ID] order by PAGO desc limit 1");
			foreach($normal as $rown){
				$pagonor = $pagonor + $rown[PAGO];
				$restanor = $restanor + $rown[RESTA];
			}
			$especial = paraTodos::arrayConsulta("PAGO, RESTA", "amort_esp ae", "ae.PREST=$rowp[ID] order by PAGO desc limit 1");
			foreach($especial as $rowes){
				$pagoes = $pagoes + $rowes[PAGO];
				$restaes = $restaes + $rowes[RESTA];
			}
		}
?>
       	<div class="col-sm-4 invoice-col">
        	<h3>Cancelado</h3>
        	<table class="datos">
                <tbody><tr>
                    <td><b>Monto Solicitado:</b></td>
                    <td class="monto"><?php echo number_format($solicitado, 2, ',', '.');?></td>
                </tr>
                <tr>
                    <td><b>Cancelado Normal:</b></td>
                    <td class="monto"><?php echo number_format($pagonor, 2, ',', '.');?></td>
                </tr>
                <tr>
                    <td><b>Cancelado Especial:</b></td>
                    <td class="monto"><?php echo number_format($pagoes, 2, ',', '.');?></td>
                </tr>
            </tbody></table>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
        	<h3>Pendiente</h3>
        	<table class="datos">
                <tbody><tr>
                    <td><b>Pendiente Normal:</b></td>
                    <td class="monto"><?php echo number_format($restanor, 2, ',', '.');?></td>
                </tr>
                <tr>
                    <td><b>Pendiente Especial:</b></td>
                    <td class="monto"><?php echo number_format($restaes, 2, ',', '.');?></td>
                </tr>
            </tbody></table>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
        	<h3>Fechas</h3>
        	<table class="datos">
        		<tbody><tr>
                    <td><b>Creado el:</b></td>
                    <td class="monto"><?php echo $creado?></td>
                </tr>
                <tr>
                    <td><b>Inicio Normal:</b></td>
                    <td class="monto"><?php echo $inicionor?></td>
                </tr>
                <tr>
                    <td><b>Inicio Especial:</b></td>
                    <td class="monto"><?php echo $inicioes?></td>
                </tr>
            </tbody></table>
        </div>
<?php
	}
	public function estadoc_det($codigo){
		$amortiz = paraTodos::arrayConsulta("*", "amort_nor", "PREST=$codigo order by ID");
		foreach ($amortiz as $row){
		?>
		<tr>
			<td align="right"><?php echo $row['ID'];?></td>
			<td align="right"><?php echo number_format($row['MONTO'], 2, ',', '.');?></td>
			<td align="right"><?php echo number_format($row['TASA'], 2, ',', '.');?></td>
			<td align="right"><?php echo $row['VENC'];?></td>
			<td align="right"><?php echo $row['PAGADA_EL'];?></td>
			<td align="right"><?php echo number_format($row['CANC'], 2, ',', '.');?></td>
			<td align="right"><?php echo number_format($row['INTE'], 2, ',', '.');?></td>
			<td align="right"><?php echo number_format($row['ABONO'], 2, ',', '.');?></td>
			<td align="right"><?php echo number_format($row['PAGO'], 2, ',', '.');?></td>
			<td align="right"><?php echo number_format($row['RESTA'], 2, ',', '.');?></td>
		</tr>
	<?php
		}
	}
}
?>
