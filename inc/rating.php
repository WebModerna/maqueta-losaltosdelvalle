<?php 	require_once('funciones_ajax.inc'); 
		require_once('conexion.php');  // Incluimos la conexión ?>
<script type="text/javascript">
var recoge_ip;
recoge_ip = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
var recoge_numero_post;
recoge_numero_post = <?php the_ID(); ?>;
</script>

<div>

<!-- snippet estrellicas -->
<?php $numero_post= get_the_ID(); ?>
<?php // Sacamos el número de votos y la valoración hasta el momento
	$resultado_rating = $link_id->query("SELECT val_rating FROM wordpress_rating_post WHERE numero_post='$numero_post'");
	$row_rating = $resultado_rating->num_rows;
	
// Si nadie ha votado aún, mostramos un mensaje explicándolo 
?>
 <?php
if ($row_rating	== 0) { ?>
	<p>Este art&iacute;culo a&uacute;n no ha sido valorado.</p>

<?php } else { // de lo contrario, mostramos las estrellas normales e incluimos microdatos 	
	$contador = 0;		
	while($filas_resultado_rating=$resultado_rating->fetch_assoc()){ 
		$contador = $contador+$filas_resultado_rating['val_rating'];
	}
	$total = round(($contador/$row_rating),1);	
	$total_redondeado = round($total);

	/* Añadimos tantas estrellas amarillas como hay en el total redondeado y grises como faltan para llegar a 5
	(se podrían añadir medias estrellas, pero eso lo dejo para otro día) */	?>
	 
	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">	
	<p><b>valoraci&oacute;n de los lectores sobre <i><span itemprop="itemreviewed"><?php echo get_the_title(); ?></span></i> </b></p>	
	<ul style="list-style-type:none;padding:3px; overflow:hidden;">	
	<?php for ($i=0; $i<$total_redondeado;$i++) { ?>
	<li style="float:left"><img src="<?php echo get_template_directory_uri(); ?>/images/sm_estrella.gif" width="18px" height="18px" alt="estrellica valoraci&oacute;n positiva" /></li> 
	<?php } ?>
	<?php for ($i=0; $i<(5-$total_redondeado);$i++) { ?>
	<li style="float:left"><img src="<?php echo get_template_directory_uri(); ?>/images/estrellica_blanca.png" width="18px" height="18px" alt="estrellica valoraci&oacute;n negativa" /></li> 
	<?php } ?>	
	<li style="float:left; margin-left:1em;">				
		<?php echo  " <span itemprop='ratingValue'>".$total."</span> sobre <span itemprop='bestRating'>5</span> (<span itemprop='reviewCount'>".$row_rating."</span> votos)"; ?>		
	
	</li> 
	</ul>
	</div><!-- #itemscope aggregateRating-->
	

<?php	}  // #estrellas normales ?>	
<!-- #snippet estrellicas -->	

<?php /* Chequeamos que el usuario aún no ha valorado la entrada.
Si no lo ha hecho, ofrecemos la posibilidad de que vote */

$ip_user = $_SERVER['REMOTE_ADDR']; // Saca la IP del usuario

$resultado_user = $link_id->query("SELECT ip_user FROM wordpress_rating_post WHERE ip_user='$ip_user' AND numero_post='$numero_post'");	
$row_cnt = $resultado_user->num_rows;		
	if ($row_cnt==0) { ?>
		<p><b>&iquest;Te ha parecido &uacute;til o interesante? </b><br />
		<a onclick="javascript: rating(1, recoge_ip, recoge_numero_post)">nada</a> &#8212;
		<a onclick="javascript: rating(2, recoge_ip, recoge_numero_post)">un poco </a> &#8212;
		<a onclick="javascript: rating(3, recoge_ip, recoge_numero_post)">a medias </a> &#8212;
		<a onclick="javascript: rating(4, recoge_ip, recoge_numero_post)"> bastante </a> &#8212;  
		<a onclick="javascript: rating(5, recoge_ip, recoge_numero_post)">mucho </a></p>
		T&uacute; opini&oacute;n es importante, gracias!
	<?php } else { // Si ya votó, le damos las gracias ?>
	Ya valoraste este art&iacute;culo, gracias!
	<?php } ?>

	
</div> <!-- #div_rating -->