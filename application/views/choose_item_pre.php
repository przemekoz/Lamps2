<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
* {
	margin: 0;
	padding:0;
}

</style>

</head>
<body>



<div style="width:100%; height: 120px; text-align:center; background: url('/img/bg.gif') top left; padding: 10px 0 0 0;">

	
</div>
<div style="width: 100%; height: 4px; background: url('/img/break.png') repeat-x;"></div>




<div style="text-align: center;width:100%;margin-top:15px">
	<div style="width:900px; height:600px; background: #fff; margin:0 auto;text-align: left">
		
		
		<?php ob_start(); ?>
		
	<h3>Wybierz kategorie produktów:</h3>	<br>
	<form name="form" action="/index.php/<?php echo $url?>/choose_items">
			<?php echo form_hidden('bgid', $bgid);?>
			<?php echo form_checkbox('street', 1, true);?> Miasto - ulica <br>
			<?php echo form_checkbox('garden', 1, true);?> Dom - ogród<br><br><br>
			<table width="100%" ><tr><td width="50%"><?php showButton('Wstecz', 'location.href=\'/index.php/'.$url.'/drag\'', 'grey') ?></td><td width="50%"><?php showSubmit('Dalej') ?></td></tr></table>
	</form>
		
			<?php 
				$content = ob_get_clean();
				echo divShadow(900, 300, $content);
			?>
				
	</div>
</div>





	<!-- FOOTER -->
<br clear="all">
<div style="background: #67806E; width:100%;height:150px;border-top:2px solid #674A3E;margin-top:0px">
<div style="padding:60px 40px 0 40px">
	<a href="#" title="" style="font-size:15px;font-family:tahoma,sans-serif; color:#fff;text-decoration: none; margin-right: 15px" onmouseover="this.style.borderBottom='1px dotted #fff'" onmouseout="this.style.borderBottom='none'">link1</a>
</div>
</div>			

<script type="text/javascript">
function add_new_element(id, id_user) {
	window.opener.add_element(id, id_user);
}

<?php 

if (!empty($inserted_element_id)) {
	echo 'add_new_element('.$inserted_element_id.',"'.$iduser.'")';
}
?>

</script>

</body>
</html>