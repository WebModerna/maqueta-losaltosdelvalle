<?php 
require_once('mi_conexion.php');  // Incluimos la conexión 
// Recogemos las variables 
if (isset($_REQUEST['val_rating'])) {
	$val_rating = strip_tags(addslashes($_REQUEST['val_rating']));
	}
if (isset($_REQUEST['numero_post'])) {
	$numero_post = strip_tags(addslashes($_REQUEST['numero_post']));	
	}
if (isset($_REQUEST['ip'])) {
	$ip_user = strip_tags(addslashes($_REQUEST['ip']));	
	}	
?>
<?php
		// Insertamos los datos en la base de datos
		if (isset($val_rating) && isset($numero_post) && isset($ip_user)) {
				$indexar_valoracion= $link_id->query("INSERT INTO wordpress_rating_post (ip_user, numero_post, val_rating,timestamp_rating )
												VALUES ('$ip_user','$numero_post','$val_rating',NOW())");
			}
?>

<!-- snippet estrellicas -->
<?php // Sacamos el número de votos y la valoración hasta el momento
	$resultado_rating = $link_id->query("SELECT val_rating FROM wordpress_rating_post WHERE numero_post='$numero_post'");
	$row_rating = $resultado_rating->num_rows;
	
	$contador = 0;		
	while($filas_resultado_rating=$resultado_rating->fetch_assoc()){ 
		$contador = $contador+$filas_resultado_rating['val_rating'];
	}
	$total = round(($contador/$row_rating),1);
	$total_redondeado = round($total);
	
	/* Añadimos tantas estrellas amarillas como hay en el total redondeado y grises como faltan para llegar a 5
	(se podrían añadir medias estrellas, pero eso lo dejo para otro día) */	?>
	<p><b>valoraci&oacute;n de los lectores: </b></p>	
	<ul style="list-style-type:none;padding:3px; overflow:hidden;">	
	<?php for ($i=0; $i<$total_redondeado;$i++) { ?>
	<li style="float:left"><img src="<?php echo get_template_directory_uri(); ?>/images/sm_estrella.gif" width="18px" height="18px" alt="estrellica valoraci&oacute;n positiva" /></li> 
	<?php } ?>
	<?php for ($i=0; $i<(5-$total_redondeado);$i++) { ?>
	<li style="float:left"><img src="<?php echo get_template_directory_uri(); ?>/images/estrellica_blanca.png" width="18px" height="18px" alt="estrellica valoraci&oacute;n negativa" /></li> 
	<?php } ?>
	<li style="float:left; margin-left:1em;">	
		<div itemscope itemtype="http://schema.org/Article">
		<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<?php echo " <span itemprop='ratingValue'>".$total."</span> sobre <span itemprop='bestRating'>5</span> (<span itemprop='ratingCount'>".$row_rating."</span> votos)"; ?>
		</div> <!-- #itemprop-->
		</div> <!-- #itemscope-->
	</li> 
	</ul>	
<!-- #snippet estrellicas -->
<?php 
	echo "Muchas gracias por aportar tu opini&oacute;n";			
?>



