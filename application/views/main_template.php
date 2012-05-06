<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<style type="text/css">

* {
	margin: 0;
	padding:0;
}

.product-resize {
	border: 1px solid black;
}
.draggable {
	z-index: 200;
}
.draggable img {
	/* border: 1px dotted #000; */
	z-index: 200;
}


#resizable {
	width: 200px;
	border: 1px dotted #eee;
	height: 300px;
}


.canvas-active {
	opacity: 0.8;
}

.product-active {
	border: 1px solid black;
}

.draggable:hover {
	opacity: 0.8;
	/* border: 1px dotted #ddd; */
	cursor: move;
}
     .input_text {
    	height: 40px;
    	font-size:17px;
    	color: black;
    	padding: 0 0 0 0;
    	width: 100%;
    	height: 134px;
    	font-family: arial;
    	margin: 3px 0 15px 0;
    }

.btn_in{
	padding:8px 4px 0 0; 
	text-align:center; 
	color:#67806E;
	font-weight:bold; 
	font-family:tahoma,sans-serif;
	font-size:11px
}	

.btn_out {
	cursor:pointer; 
	float:left; 
	margin:44px 0 0 38px; 
	width: 94px; 
	height: 34px; 
	background: url('/img/btn.png') top left no-repeat;
}	


</style>

</head>
<body onContextMenu="return false;">


<div style="width:100%; height: 126px; text-align:center; background: url('/img/bg.gif') top left; padding: 10px 0 0 0;">

	<div style="width: 956px; height: 126px; background: url('/img/toolbar2.png') top left no-repeat; margin: 0 auto; text-align: left">

<!-- 
		<div onclick="save_all()" class="btn_out" title="Zapisz">
			<div class="btn_in">Zapisz</div>
		</div>
 -->
		<div style="margin-left: 95px" onclick="window.open('/uploads/u<?php echo $userid ?>_saved.jpg?r=<?php echo rand(0,99)?>', '_blank')" class="btn_out" title="Podgląd">
			<div class="btn_in">Podgląd</div>
		</div>
		<div onclick="clear_canvas()" class="btn_out" title="Wyczyść">
			<div class="btn_in">Wyczyść</div>
		</div>
		<div onclick="window.open('/konfigurator.php/EmailsTemplate/pdf', '_blank')" class="btn_out" title="Wydrukuj">
			<div class="btn_in">Wydrukuj</div>
		</div>
		<div onclick="window.open('/konfigurator.php/EmailsTemplate/downloadjpg', '_blank')" class="btn_out" title="Pobierz JPG">
			<div class="btn_in">Pobierz JPG</div>
		</div>
		<div onclick="window.open('/konfigurator.php/EmailsTemplate/downloadpdf', '_blank')" class="btn_out" title="Pobierz PDF">
			<div class="btn_in">Pobierz PDF</div>
		</div>
		<div onclick="window.open('/konfigurator.php/EmailsTemplate/send_form', '_blank')" class="btn_out" title="Wyślij email">
			<div class="btn_in" style="font-size:10px">Wyślij Zapytanie</div>
		</div>

		
		<div style="clear: both"></div>
	</div>
</div>
<div style="width: 100%; height: 4px; background: url('/img/break.png') repeat-x;"></div>


<div style="text-align: center;width:100%;margin-top:15px">
	<div style="width:600px; height:100px; background: #fff; margin:0 auto;text-align: center">
		<h3 style="line-height: 1.3em">Wyślij zapytanie do firmy PROMAR.</h3>	
		<h4 style="line-height: 1.3em">W załączniku automatycznie zostanie dodany Twój układ tła oraz lamp.</h4>
		<h5 style="line-height: 1.3em">Podaj swoje dane kontaktowe (imie, email). Możesz wpisać dodatkowe pytania</h5>
	</div>
	<div style="width:300px;  background: #fff; margin:0 auto;text-align: left">
		
		
	<form name="form" action="/konfigurator.php/<?php echo $url?>/send" method="post">
	<?php echo inputText('Imię nazwisko:', 'my_name', '', 'small'); ?><br>	
	<?php echo inputText('Nazwa firmy:', 'my_company', '', 'small'); ?><br>	
	<?php echo inputText('Email:<font color=red>*</font>', 'my_email', '', 'small'); ?><br>	
	<?php echo inputTextarea('Treść:', 'my_text', '', 'small'); ?>	<br>
	<?php echo getButton('Wyślij', 'check_submit()') ?>
	</form>	

				
	</div>
</div>
<textarea id="elements_msg" style="border:none; width:100%; height:100px"></textarea>

<!-- FOOTER -->
<?php echo footer_html() ?>


<script type="text/javascript">
function check_submit() {

	var email = document.form.my_email.value; 
	if ( email.length > 3) {
		document.form.submit();
		return true;
	}
	
	alert('Wypełnj pole Email');
	return false;

}
</script>

</body>
</html>