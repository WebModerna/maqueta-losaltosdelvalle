<script type="text/javascript">

function rating(val_rating, ip, numero_post) {
var val_rating;
var ip;
var numero_post;
var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("div_rating").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","<?php echo get_template_directory_uri(); ?>/op_rating.php?val_rating="+val_rating+"&ip="+ip+"&numero_post="+numero_post,true);
	xmlhttp.send();
	}

</script>

