<h2 class="title-c">Aprobación o Verificación CDP's&nbsp;&nbsp;&nbsp;&nbsp;</h2>

<?php if (!isset($_SESSION['inspaa'])) { ?>

	<?php // if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>				
	<!--		<a href="<?=base_url?>paa/index&new=1" class="fas fa-plus-square fa-2x" style="color: #f66f16;" title="Nuevo Registro"></a> -->
	<?php //} ?>

<!-- Inicio Selección área Reportes ///////////////////////////////////////////////// -->
 	<div class="row">
 		<div class="form-group col-md-3">
 			<?php if(!isset($pfinandOne)): ?>
				<form class="m-tb-40" action="<?=base_url;?>paa/apro" method="POST">
					<label for="areas">Filtro Total o por áreas</label>
					<select id="areas" name="areSel" class="form-control form-control-sm" style="padding: 0px;" onchange="this.form.submit();">
						<option value="0">Seleccione área</option>
						<?php foreach ($areas2 as $pf){ ?>
							<option value="<?=$pf['valid'];?>"<?= $pf['valid']==$areSel ? ' selected ':''; ?>>
								<?=$pf['valnom'];?>
							</option>
						<?php } ?>
					</select>
				</form>
			<?php endif; ?>
		</div>
		<div class="form-group col-md-3 m-tb-40">
			&nbsp;
		</div>
		<div class="form-group col-md-3 m-tb-40">
			&nbsp;
		</div>
		<div class="form-group col-md-1" style="text-align: right;">
			<form class="m-tb-40" action="<?=base_url;?>views/pdf2.php" target="_blank" method="POST">
				<br>
				<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
				<input type="hidden" name="tot" value="1012">
				<input type="hidden" name="areSel" value="<?=$areSel;?>">
				<input type="hidden" name="ntipo" value="3">
				<input type="hidden" name="idflu" value="<?=$idflu;?>">
				<button type="submit" class="btn" style="color: #0071bc;" title="Imprimir total o área seleccionada">
					<i class="fas fa-print fa-2x"></i>
				</button>
			</form>
		</div>
		<div class="form-group col-md-1" style="text-align: right;">
			<form class="m-tb-40" action="<?=base_url;?>views/pdf2.php" target="_blank" method="POST">
				<br>
				<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
				<input type="hidden" name="tot" value="1012">
				<input type="hidden" name="areSel" value="<?=$areSel;?>">
				<input type="hidden" name="ntipo" value="3">
				<input type="hidden" name="idflu" value="<?=$idflu;?>">
				<input type="hidden" name="pdf" value="1547">
				<button type="submit" class="btn" style="color: #0071bc;" title="PDF total o área seleccionada">
					<i class="fas fa-file-pdf fa-2x"></i>
				</button>
			</form>
		</div>
		<div class="form-group col-md-1" style="text-align: right;">
			<form class="m-tb-40" action="<?=base_url;?>views/csv.php" target="_blank" method="POST">
				<br>
				<input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
				<input type="hidden" name="tot" value="1012">
				<input type="hidden" name="areSel" value="<?=$areSel;?>">
				<input type="hidden" name="ntipo" value="3">
				<input type="hidden" name="idflu" value="<?=$idflu;?>">
				<button type="submit" class="btn" style="color: #0071bc;" title="CSV total o área seleccionada">
					<i class="fas fa-file-excel fa-2x"></i>
				</button>
			</form>
		</div>
	</div>
<!-- Fin Selección área Reportes ///////////////////////////////////////////////// -->

<!-- Inicio tabla CDP ///////////////////////////////////////////////////////////////////////// -->
<?php if($tip==2 OR $tip==0){ ?>
			<!-- <h4 class="title-c">CDP's&nbsp;&nbsp;&nbsp;&nbsp;</h4> -->
			<?php if(isset($pfcdp)): ?>
				<br><br>
				<div class="table-responsive">
				<form name="frmchk" action="<?=base_url;?>paa/apromas" method="POST">
					<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
						<thead>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Valor CDP's &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>Estado&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
							<?php 
							$creachk = false;
							foreach ($pfcdp as $pf){ ?>

								<?php if($pf['idmcdp']==NULL): ?>
									<tr>
										<td 
											<?php
												if($pf['color']){
													echo ' style="background-color: #'.$pf['color'].';"';
												}
											?>
										><small><?=$ninipaa.$pf['codrub'];?></small></td>
											<!-- <td><?//=$pf['unspsc'];?></td> -->
										<td>
											<?php if ($pf['nomcont']) {?>
												<strong>Contratista </strong><?=$pf['nomcont'];?><br>
											<?php } ?>
											<?=$pf['nobjeto'];?>
											
											<br><br>
												<?php if ($pf['nexpcdp']) {?>
													<strong>No. Solicitud: </strong><?=$pf['nexpcdp'];?>
													<br>
												<?php } ?>
												<?php if ($pf['nbogdata']) {?>
													<strong>No. Bogdata: </strong><?=$pf['nbogdata'];?>
													<br>
												<?php } ?>
												<strong>Área: </strong><?=$pf['are'];?>
											<br>
											<small>
												<strong>Fecha Inicio: </strong><?=$pf['fecinidpa'];?>
												<br>
												<strong>Fecha Fin: </strong>
												<?=$pf['fecfindpa'];?>
												<br>
												<strong>Modalidad:</strong>
												<?=$pf['moda'];?>
												<br>
												<strong>Fuente: </strong>
												<?=$pf['fuen'];?>
												<br>
												<strong>Proceso: 
												<?=$pf['nompro'];?>
												</strong>
												
											</small>
										</td>
										<td align="right">$ <?=number_format($pf['asidpa'], 0, ',', '.');?></td>
										<?php 
											$dtcdp = $pfinan->sumcdp($pf['iddpa'],$areas,$_SESSION['vig']);
											$dtrp = $pfinan->sumrp($pf['iddpa'],$areas,$_SESSION['vig']);
											$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
											$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
											$dispo = ($pf['asidpa']-$cdp-$rp);
											$sumasi += $pf['asidpa'];
											$sumdis += $dispo;
											$sumcdp += $cdp;
											$sumrp += $rp;
										?>
										<td align="center">
											<?=$pf['actflu'];?>
											<?php $stra = $pfinan->seltrad($pf['iddpa'],$pf['idflu']); ?>
											<br>
											<small><small><strong>
												<?php
													if($stra AND $stra[0]['fec']){
														echo $stra[0]['fec'];
													}
												?>
											</strong></small></small>
											<br>
											<?php 
												$numflu=$pfinan->getVFlujoPro($pf['idpro'],3);
											?>

											<!-- Check Inicio -->
											<?php if($pf["idflu"]==$numflu[0]["mini"]){ ?>
												<br>
												<input type="checkbox" class="form-control" id="chk" name="chk[]" value="<?=$pf['iddpa'];?>" >
												<input type="hidden" class="form-control" id="idf" name="idf[]" value="<?=$pf['idflu'];?>" >
												<input type="hidden" class="form-control" id="fte" name="fte[]" value="<?=$pf['ftefindpa'];?>" >
												
											<?php 
											$creachk = true;
											} ?>
											<!-- Check Fin -->


											<br>

											<?php if($pf["idflu"]>$numflu[0]["mini"]){ ?>
												<div class="mestCDP">
													<a href="<?=base_url?>views/pdf.php?iddpa=<?=$pf['iddpa'];?>" target="_blank" title="Imprimir Solicitud CDP">
														<i class="fas fa-print fa-2x"></i>
													</a>
													&nbsp;
													<a href="<?=base_url?>views/pdf.php?pdf=1547&iddpa=<?=$pf['iddpa'];?>" target="_blank" title="PDF Solicitud CDP">
														<i class="fas fa-file-pdf fa-2x"></i>
													</a>
													<span><br><br>
														Solicitud CDP
													</span>
												</div>
											<?php } ?>
											<?php if($pf['rutcdp']){ ?>
												<div class="mestCDP">
													<a href="<?=path_filem;?><?=$pf['rutcdp'];?>" target="_blank" title="PDF CDP Bogdata">
														<i class="fas fa-file-pdf fa-2x"></i>
													</a>
													<span><br><br>
														CDP B.
													</span>
												</div>
											<?php } ?>
										</td>

										<td>
											<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
												<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
							                		<i class="fas fa-eye" style="color: #0071bc;"></i>
							                	</a>
							                <?php } ?>
											<br><br>
						                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&apro=1" title="Aprobar o Rechazar">
						                		<i class="fas fa-arrow-alt-circle-right" style="color: #0071bc;"></i>
						                	</a>
						                	<br><br>

						                	<?php					                	 

						                	 if(($pf['idflu']>=$numflu[0]["mini"] AND $pf['idflu']<=$numflu[0]["maxi"]+1) ){ ?>	
							                	<a href="<?=base_url?>paa/delcdp&iddpa=<?=$pf['iddpa'];?>" title="Anular y Liberar CDP" onclick="return elimObj();">
							                		<i class="fas fa-trash-alt" style="color: #0071bc;"></i>
							                	</a>
							                <?php } ?>
										</td>
									</tr>
								<?php endif; ?>
								
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>						
								<td align="right"><strong>$ <?=number_format($sumasi, 0, ',', '.');?></strong></td>
								<td colspan="2">
									<?php if($creachk == true){ ?>
										<button type="submit" name="btn" value="aprobar">
											<i class="fas fa-check-circle fa-2x" style="color: #0071bc;"></i>
										</button>
										
										&nbsp;&nbsp;&nbsp;

	            					<button type="submit"  name="boton" value="rechazar">
			                			<i class="fas fa-times-circle fa-2x" style="color: #f00;"></i>
			                		</button>
			                	<?php } ?>
								</td>
							</tr>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Valor CDP's&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>Estado&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th></th>
							</tr>
				    </tfoot>
					</table>
				</form>				
				</div>
			<?php endif; ?>	
<?php }?>
<!-- Fin tabla CDP ///////////////////////////////////////////////////////////////////////// -->

<!-- Inicio tabla RP ///////////////////////////////////////////////////////////////////////// -->
<!-- 	<?php if($pfrp): ?>
		<?php if($tip==3 OR $tip==0){ ?>
			<br><br>
			<h4 class="title-c">RP's&nbsp;&nbsp;&nbsp;&nbsp;</h4>
			<?php if(isset($pfrp)): ?>
				<br><br>
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">
						<thead>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Valor RP's&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>Estado</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pfrp as $pf){ ?>
								<tr>
									<td 
										<?php
											if($pf['color']){
												echo ' style="background-color: #'.$pf['color'].';"';
											}
										?>
									><small><?=$ninipaa.$pf['codrub'];?></small></td>
									<td>
										<?php if ($pf['nomcont']) {?>
											<strong>Contratista </strong><?=$pf['nomcont'];?><br>
										<?php } ?>

										<?=$pf['nobjeto'];?>
										<br><br>
										    <?php if ($pf['nexpcdp']) {?>
												<strong>No. Solicitud: </strong><?=$pf['nexpcdp'];?>
												<br>
											<?php } ?>
											<?php if ($pf['nbogdata']) {?>
												<strong>No. Bogdata: </strong><?=$pf['nbogdata'];?>
												<br>
											<?php } ?>
											<strong>Área: </strong><?=$pf['are'];?>
										<br>
										<small>
											<strong>Fecha Inicio: </strong><?=$pf['fecinidpa'];?>
											<br>
											<strong>Fecha Fin: </strong>
											<?=$pf['fecfindpa'];?>
											<br>
											<strong>Modalidad:</strong>
											<?=$pf['moda'];?>
											<br>
											<strong>Fuente: </strong>
											<?=$pf['fuen'];?>
										</small>
									</td>
									<td align="right">$ <?=number_format($pf['asidpa'], 0, ',', '.');?></td>
									<?php 
										$dtcdp = $pfinan->sumcdp($pf['iddpa'],$areas);
										$dtrp = $pfinan->sumrp($pf['iddpa'],$areas);
										$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
										$rp= isset($dtrp[0]['rp']) ? $dtrp[0]['rp']:0;
										$dispo = ($pf['asidpa']-$cdp-$rp);
										$sumasi += $pf['asidpa'];
										$sumdis += $dispo;
										$sumcdp += $cdp;
										$sumrp += $rp;
										$numflu=$pfinan->getVFlujoPro($pf['idpro'],3);
									?>
									<td>
										<?=$pf['actflu'];?>
										<br>
										<?php if($pf["idflu"]>$numflu[0]["mini"]){ ?>
											<div class="mestCDP">
												<a href="<?=base_url?>views/pdf.php?iddpa=<?=$pf['iddpa'];?>" target="_blank" title="Imprimir Solicitud CDP">
													<i class="fas fa-print fa-2x"></i>
												</a>
												&nbsp;
												<a href="<?=base_url?>views/pdf.php?pdf=1547&iddpa=<?=$pf['iddpa'];?>" target="_blank" title="PDF Solicitud CDP">
													<i class="fas fa-file-pdf fa-2x"></i>
												</a>
												<span><br><br>
													Solicitud CDP
												</span>
											</div>
										<?php } ?>
										<?php if($pf['rutcdp']){ ?>
											<div class="mestCDP">
												<a href="<?=path_filem;?><?=$pf['rutcdp'];?>" target="_blank" title="PDF CDP Bogdata">
													<i class="fas fa-file-pdf fa-2x"></i>
												</a>
												<span><br><br>
													CDP B.
												</span>
											</div>
										<?php } ?>
										<?php if($pf['rutrp']){ ?>
											<div class="mestCDP">
												<a href="<?=path_filem;?><?=$pf['rutrp'];?>" target="_blank" title="PDF RP Bogdata">
													<i class="fas fa-file-pdf fa-2x"></i>
												</a>
												<span><br><br>
													RP B.
												</span>
											</div>
										<?php } ?>
									</td>
									<td>
										<?php if($_SESSION['pefid']==21 OR $_SESSION['pefid']==34){ ?>	
											<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>" title="Editar">
		                		<i class="fas fa-edit" style="color: #0071bc;"></i>
		                	</a>
		                <?php } ?>
											<br><br>

		                	<a href="<?=base_url?>paa/getRub&codrub=<?=$pf['codrub'];?>&iddpa=<?=$pf['iddpa'];?>&apro=1" title="Aprobar o Rechazar">
					                		<i class="fas fa-arrow-alt-circle-right" style="color: #0071bc;"></i>
					                	</a>


		                	<br><br>
		                	<?php if($_SESSION['depid']==1026){ ?>
			                	<a href="<?=base_url?>paa/delcdp&iddpa=<?=$pf['iddpa'];?>" title="Anular y Liberar RP" onclick="return elimObj();">
			                		<i class="fas fa-trash-alt" style="color: #0071bc;"></i>
			                	</a>
			                <?php } ?>
									</td>
								</tr>
							<?php } ?>		
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td></td>						
								<td align="right"><strong>$ <?=number_format($sumasi, 0, ',', '.');?></strong></td>
								<td></td>
							</tr>
							<tr>
								<th>Código</th>
								<th>Objeto</th>						
								<th>Valor RP's&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>Estado</th>
								<th></th>
							</tr>
				    </tfoot>
					</table>					
				</div>
			<?php endif; ?>	
		<?php } ?>
	<?php endif; ?> -->
<!-- Fin tabla RP ///////////////////////////////////////////////////////////////////////// -->


<!-- MÚLTIPLE CDP -->

   <br><br>

	<?php if($_SESSION['depid']==1026 OR $_SESSION['depid']==1016 OR $_SESSION['depid']==1027 OR ($_SESSION['depid']==1025 AND $idflu==503) ){ ?>
		<h3 class="title-c">CDP's - Múltiples Solicitados&nbsp;&nbsp;&nbsp;&nbsp;</h3>
		<br>
		<br><br>
		<div class="table-responsive">
			<table id="example" class="table table-striped table-bordered dterpcMCDP" style="width:100%;">
				<thead>
					<tr>
						<th>Códigos</th>
						<th>Tipo</th>						
						<th>Valor CDP's </th>
						<!-- <th>CDPs</th>
						<th>RPs</th> -->

						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					// var_dump($mcdt[0][0]["codrub"]);
					// die();		


					 ?>
					 <?php for ($i=0;$i<$NMcdps;$i++){ ?>
					 	
			            <tr>
			            	<td>
				            	<?php foreach ($mcdt[$i] as $mc){ ?>      	
				                	<?=$ninipaa.$mc['codrub'];?>
				                <?php } ?>	
			                </td>
			                <td>						                	    	
				                <?=$mcdt[$i][0]['valnom'];?>	
				                <br>
				                <small>
				                	<strong><?=$mcdt[$i][0]['nompro'];?>	</strong>
				                </small>
				                			               
			                </td>
			                <td>	
			                	$ <?=number_format($sumMCdp[$i][0]['Asig'], 0, ',', '.');?>    
			                </td>	
			                
			                <!-- <td>
			                	$ <?=number_format($cdp, 0, ',', '.');?>
			                	&nbsp;&nbsp;
			                	<br><br>
			                	<a href="<?=base_url?>paa/detpaa&codrub=<?=$mc['codrub'];?>&tip=2&tot=<?=$tot;?>" class="btn-primary-ccapital btable" title="Ver CP's">
                					<i class="fas fa-eye" ></i> CP's
                				</a> 
                				
                				<?php if($calCDP[0]['alerta']>0){ ?>
                					<div class="contspan"><span class="spCanalPT1"><?=$calCDP[0]['alerta'];?></span></div>
                				<?php } ?>
			                </td> -->
			               <!--  <td> -->
			                	<!-- $ <?=number_format($rp, 0, ',', '.');?> -->
			                	<!-- &nbsp;&nbsp;
			                	<br><br>
			                	<a href="<?=base_url?>paa/detpaa&codrub=<?=$mc['codrub'];?>&tip=3&tot=<?=$tot;?>" class="btn-primary-ccapital btable" title="Ver RP's">
                					<i class="fas fa-eye"></i> RP's
                				</a>  -->

                				<!-- <?php if($calRP[0]['alerta']>0){ ?>
                					<div class="contspan"><span class="spCanalPT1"><?=$calRP[0]['alerta'];?></span></div>
                				<?php } ?>  -->
                				
			                <!-- </td> -->
			                <td>						                	     	
			                	<!-- <a href="<?=base_url?>paa/detpaa&codrub=<?=$pf['codrub'];?>&tot=<?=$tot;?>" title="Ver Todo">
                					<i class="fas fa-eye" style="color: #0071bc;"></i>
                				</a>		 -->

                				
                				<?php 
                					// var_dump($idflu);
                					// var_dump($_SESSION['depid']);
                					// var_dump($mcdt[$i][0]['idflu']);
                					
                					// 	foreach ($mcdt[$i] as $mc){      	
						               //  	var_dump($ninipaa.$mc['codrub']);
						               //   } 
                					
                					// die();
                				 ?>

                				<!-- <span><?=$actflu[$i][0]['actflu']?><?=$mcdt[$i][0]['idflu']?></span> -->
                				<span><?=$actflu[$i][0]['actflu']?></span>

                				<?php if($_SESSION['depid']==1027 AND $mcdt[$i][0]['idflu']<503){ ?>
                					<a href="<?=base_url?>paa/getRubMcdp&codrub=<?=$mc["codrub"];?>&iddpa=<?=$mc['iddpa'];?>&apro=1&suma=<?=$sumMCdp[$i][0]['Asig']?>" title="Aprobar o Rechazar">
                					<i class="fas fa-arrow-alt-circle-right" style="color: #0071bc;"></i>	
                				<?php } ?>
                				<?php if($_SESSION['depid']==1025 AND $mcdt[$i][0]['idflu']==503){ ?>
                					<a href="<?=base_url?>paa/getRubMcdp&codrub=<?=$mc["codrub"];?>&iddpa=<?=$mc['iddpa'];?>&apro=1&suma=<?=$sumMCdp[$i][0]['Asig']?>" title="Aprobar o Rechazar">
                					<i class="fas fa-arrow-alt-circle-right" style="color: #0071bc;"></i>	
                				<?php } ?>
                				<?php if($_SESSION['depid']==1026 AND $mcdt[$i][0]['idflu']>503 AND $idflu<508){ ?>
                					<!-- <a href="<?=base_url?>paa/getRubMcdp<?php foreach ($mcdt[$i] as $mc){ echo '&codrub[]='.$mc['codrub'].'&iddpa[]='.$mc['iddpa'];}?>&apro=1&suma=<?=$sumMCdp[$i][0]['Asig']?>" title="Aprobar3 o Rechazar"> -->

                					<a href="<?=base_url?>paa/getRubMcdp&codrub=<?=$mc["codrub"];?>&iddpa=<?=$mc['iddpa'];?>&apro=1&suma=<?=$sumMCdp[$i][0]['Asig']?>" title="Aprobar3 o Rechazar"> 
                					<i class="fas fa-arrow-alt-circle-right" style="color: #0071bc;"></i>	
                				<?php } ?>

                				<?php  
                					$numflu=$pfinan->getVFlujoPro($mc['idpro'],3);

                					//var_dump($mcdt[$i][0]['idflu']);
                					//var_dump($mcdt);
                				?>
                				<?php if($mcdt[$i][0]['idflu']>$numflu[0]["mini"]){ ?>
                					<br>
									<div class="mestCDP">
										<!-- <a href="<?=base_url?>views/pdf.php?iddpa=<?=$mcdt[$i][0]['iddpa'];?>" target="_blank" title="Imprimir Solicitud CDP">
											<i class="fas fa-print fa-2x"></i>
										</a> -->
										<a href="<?=base_url?>views/pdf3.php?cdpm=1<?php foreach ($mcdt[$i] as $mc){ echo '&iddpa[]='.$mc['iddpa'];}?>" target="_blank" title="Imprimir Solicitud CDP">
											<i class="fas fa-print fa-2x"></i>
										</a>

										


										&nbsp;
										<a href="<?=base_url?>views/pdf3.php?cdpm=1<?php foreach ($mcdt[$i] as $mc){ echo '&iddpa[]='.$mc['iddpa'];}?>" target="_blank" title="PDF Solicitud CDP">
											<i class="fas fa-file-pdf fa-2x"></i>
										</a>
					<!--					<a href="<?=base_url?>views/pdf.php?pdf=1547&iddpa=<?=$mcdt[$i][0]['iddpa'];?>" target="_blank" title="PDF Solicitud CDP">
											<i class="fas fa-file-pdf fa-2x"></i>
										</a> -->
										<span><br><br>
											Solicitud CDP
										</span>
									</div>
								<?php } ?>
                				
                					                
			                	
			                </td>	

			            </tr>		           			

					 <?php } ?>
					
					
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>						
						<td align="right"><strong> </strong></td>
						<td></td>	
						<td></td>
					</tr>
					<tr>
						<th>Código</th>
						<th>Objeto</th>						
						<th>Valor CDP's&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<!-- <th>CDPs</th>
						<th>RPs</th> -->
						<th></th>
					</tr>
		    	</tfoot>
				
			</table>
		</div>
	<?php } ?>

<?php } ?>