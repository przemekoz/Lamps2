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
		<div onclick="window.open('/index.php/EmailsTemplate/pdf', '_blank')" class="btn_out" title="Wydrukuj">
			<div class="btn_in">Wydrukuj</div>
		</div>
		<div onclick="window.open('/index.php/EmailsTemplate/downloadjpg', '_blank')" class="btn_out" title="Pobierz JPG">
			<div class="btn_in">Pobierz JPG</div>
		</div>
		<div onclick="window.open('/index.php/EmailsTemplate/downloadpdf', '_blank')" class="btn_out" title="Pobierz PDF">
			<div class="btn_in">Pobierz PDF</div>
		</div>
		<div onclick="window.open('/index.php/EmailsTemplate/send_form', '_blank')" class="btn_out" title="Wyślij email">
			<div class="btn_in" style="font-size:10px">Wyślij Zapytanie</div>
		</div>

		
		<div style="clear: both"></div>
	</div>
</div>
<div style="width: 100%; height: 4px; background: url('/img/break.png') repeat-x;"></div>


<div style="text-align: center;width:100%;margin-top:15px">
	<div style="width:300px; height:610px; background: #fff; margin:0 auto;text-align: left">
		
	<h3 style="color:green">Email został wysłany...<br><b>Dziękujemy.</b></h3>

				
	</div>
</div>
<textarea id="elements_msg" style="border:none; width:100%; height:100px"></textarea>

<!-- FOOTER -->
<br clear="all">
<div style="background: #67806E; width:100%;height:150px;border-top:2px solid #674A3E;margin-top:40px">
<div style="padding:60px 40px 0 40px">
	<a href="#" title="" style="font-size:15px;font-family:tahoma,sans-serif; color:#fff;text-decoration: none; margin-right: 15px" onmouseover="this.style.borderBottom='1px dotted #fff'" onmouseout="this.style.borderBottom='none'">link1</a>
</div>
</div>



</body>
</html>