<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">

* {
	margin: 0;
	padding:0;
}

.draggable {
	z-index: 200;
}
.draggable img {
	border: 1px dotted #eee;
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
    	font-family: arial;
    	margin: 3px 0 15px 0;
    }

</style>
</head>
<body onContextMenu="return false;">


<div style="width:100%; height: 126px; text-align:center; background: url('/img/bg.gif') top left; padding: 10px 0 0 0;">

	<div style="width: 956px; height: 126px; background: url('/img/toolbar2.png') top left no-repeat; margin: 0 auto; text-align: left">

		<div onclick="show_prods()" style="cursor:pointer; float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Zapisz">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold; font-family:tahoma,sans-serif;font-size:11px">Zapisz</div>
		</div>
		<div onclick="window.open('/uploads/tmp/u<?php echo $userid ?>_saved.jpg', '_blank')" style="cursor:pointer; float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Podgląd">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold; font-family:tahoma,sans-serif;font-size:11px">Podgląd</div>
		</div>
		<div onclick="clear_canvas()" style="cursor:pointer; float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Wyczyść">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Wyczyść</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/pdf', '_blank')" style="cursor:pointer;float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Wydrukuj">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Wydrukuj</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/downloadjpg', '_blank')" style="cursor:pointer;float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Pobierz JPG">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Pobierz JPG</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/downloadpdf', '_blank')" style="cursor:pointer;float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Pobierz PDF">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Pobierz PDF</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/send', '_blank')" style="cursor:pointer;float:left; margin:44px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; " title="Wyślij email">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Wyślij email</div>
		</div>

		
		<div style="clear: both"></div>
	</div>
</div>
<div style="width: 100%; height: 4px; background: url('/img/break.png') repeat-x;"></div>


<div style="text-align: center;width:100%;margin-top:15px">
	<div style="width:1000px; height:600px; background: #fff; margin:0 auto;text-align: left">
		<h1><?php echo $title; ?></h1>
		<br><a href="/index.php/emailstemplate/drag" title="powrót">powrót</a>
		
		
		
	</div>
</div>

<!-- FOOTER -->
<br clear="all">
<div style="background: #67806E; width:100%;height:150px;border-top:2px solid #674A3E;margin-top:20px">
<div style="padding:60px 40px 0 40px">
	<a href="#" title="" style="font-size:15px;font-family:tahoma,sans-serif; color:#fff;text-decoration: none; margin-right: 15px" onmouseover="this.style.borderBottom='1px dotted #fff'" onmouseout="this.style.borderBottom='none'">link1</a>
</div>
</div>

</body>
</html>