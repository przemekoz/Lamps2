<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">

* {
	margin: 0;
	padding:0;
}
body {
	text-align: center;
	background: #f8f8f8;
	font-family: arial, sans-serif;
	color: #393939;
}

a.top_menu {
	font-size: 20px;
}
a.menu {
	color: #89AB93;
}

a.top {
	font-size: 13px;
	display: block;
	position: absolute;
	top: 10px;
	left: 870px;
}

a {
	color: #926958;
}
a:hover {
	text-decoration: none;
}

li {
	line-height: 1.5em;
	font-size: 18px;

}

h1,h3 {
	text-align: center;
	line-height: 1.2em;
}
h3 {
	font-size: 24px;
}
h4 {
	text-align: center;
	font-size: 20px;	
}


.box {
	background: #f8f8f8;
	border: 1px dotted #B8C5B1;
	padding: 10px 20px 20px 20px;
	margin: 15px 0 50px 0; 
	position: relative;
}
.screenshot {
	max-width: 850px;
	margin: 10px 0;
	/* border-bottom: 1px dotted #B8C5B1; */
	margin: 0 auto;
}

.boximg {
	display: none;	
	text-align: center;
}
.foot {
	text-align: center;
	margin-bottom: 15px;	
}

i {
	font-size: 13px;
}
small {
	color: #999
}
</style>
</head>
<body>



<div style="width: 1000px; margin: 30px auto 0 auto; text-align: left; background: #fff;border: 1px dotted #b8b8b8">
	<div style="padding: 20px 50px;">
	
		<h1>Instrukcja użytkownika</h1><br><br>

		<div class="box">
			<h3>Dodawanie nowej lampy</h3>
			<a href="javascript:void(0)" onclick="hide_all()" class="top" title="ukryj">[x]</a>
			
			<ul style="margin-left: 50px; list-style: square;">
				<li><a href="javascript:void(0)" onclick="show('lamp')" class="menu" title="Jak utworzyć nową lampę">Jak utworzyć nową lampę</a></li>
				<li><a href="javascript:void(0)" onclick="show('lampwork')" class="menu" title="Jak utworzyć nową lampę">Jak utworzyć nową lampę - obszar roboczy</a></li>
			</ul>

			<div class="boximg" id="lamp">
				<h4>Tworzenie nowej lampy</h4>
				<i><a target="_blank" href="<?php echo $url;?>/emailstemplate/drag"><?php echo $url;?>/emailstemplate/drag</a></i>
				<img src="/img/instr/user/add_lamp/dodaj_1.png" class="screenshot"><div class="foot"><i>Tworzenie lampy - ekran 1</i></div> 
				<i><a target="_blank" href="<?php echo $url;?>/emailstemplate/choose_item"><?php echo $url;?>/emailstemplate/choose_item</a></i>
				<img src="/img/instr/user/add_lamp/dodaj_2.png" class="screenshot"><div class="foot"><i>Tworzenie lampy - ekran 2</i></div> 
				<i><a target="_blank" href="<?php echo $url;?>/emailstemplate/choose_item?step=1"><?php echo $url;?>/emailstemplate/choose_item?step=1</a></i>
				<img src="/img/instr/user/add_lamp/dodaj_3.png" class="screenshot"><div class="foot"><i>Tworzenie lampy - ekran 3</i></div> 
				<i><a target="_blank" href="<?php echo $url;?>/emailstemplate/choose_item?step=2"><?php echo $url;?>/emailstemplate/choose_item?step=2</a></i>
				<img src="/img/instr/user/add_lamp/dodaj_4.png" class="screenshot"><div class="foot"><i>Tworzenie lampy - ekran 4</i></div> 
				<img src="/img/instr/user/add_lamp/dodaj_5.png" class="screenshot"><div class="foot"><i>Tworzenie lampy - ekran 5</i></div> 
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>

			<div class="boximg" id="lampwork">
				<h4>Tworzenie nowej lampy - obszar roboczy</h4>
				<i><a target="_blank" href="<?php echo $url;?>/emailstemplate/choose_item"><?php echo $url;?>/emailstemplate/choose_item</a></i>
				<img src="/img/instr/user/add_lamp/obszar_roboczy.png" class="screenshot"><div class="foot"><i>Tworzenie lampy - obszar roboczy</i></div> 
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
			
		</div>
			
		<div class="box">
			<h3>Obsługa aplikacji</h3>
			<a href="javascript:void(0)" onclick="hide_all()" class="top" title="ukryj">[x]</a>
			
			<ul style="margin-left: 50px; list-style: square;">
				<li><a href="javascript:void(0)" onclick="show('lampbg')" class="menu" title="Jak umieścić lampę na obrazku tła">Jak umieścić lampę na obrazku tła</a></li>
				<li><a href="javascript:void(0)" onclick="show('imgbg')" class="menu" title="Jak zapisać układ">Jak zapisać układ</a></li>
				<li><a href="javascript:void(0)" onclick="show('imgbgwork')" class="menu" title="Jak zapisać układ - obszar roboczy">Jak zapisać układ - obszar roboczy</a></li>
			</ul>

			<div class="boximg" id="lampbg">
				<h4>Umieszczenie lampy na tle</h4>
				<i><a target="_blank" href="<?php echo $url;?>/emailstemplate/drag"><?php echo $url;?>/emailstemplate/drag</a></i>
				<img src="/img/instr/user/lamp_bg/1.png" class="screenshot"><div class="foot"><i>Umieszczenie lampy na tle - ekran 1</i></div> 
				<img src="/img/instr/user/lamp_bg/2.png" class="screenshot"><div class="foot"><i>Umieszczenie lampy na tle - ekran 2</i></div> 
				<img src="/img/instr/user/lamp_bg/3.png" class="screenshot"><div class="foot"><i>Umieszczenie lampy na tle - skalowanie</i></div> 
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>

			<div class="boximg" id="imgbg">
				<h4>Zapisywanie układu elementów</h4>
				<i><a target="_blank" href="<?php echo $url;?>/emailstemplate/drag"><?php echo $url;?>/emailstemplate/drag</a></i>
				<img src="/img/instr/user/img_bg/2.png" class="screenshot"><div class="foot"><i>Układ elementów - ekran 1</i></div> 
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
			
			<div class="boximg" id="imgbgwork">
				<h4>Zapisywanie układu elementów - obszar roboczy</h4>
				<i><a target="_blank" href="<?php echo $url;?>/emailstemplate/drag"><?php echo $url;?>/emailstemplate/drag</a></i>
				<img src="/img/instr/user/img_bg/1.png" class="screenshot"><div class="foot"><i>Układ elementów - obszar roboczy</i></div> 
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
			
			
			
			
		</div>


	
	
	</div>
</div>




<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/main.js" type="text/javascript"></script>
<script type="text/javascript">

	var aList = new Array('lamp', 'lampwork', 'lampbg', 'imgbg', 'imgbgwork');

	function hide_all() {
		for (var i=0; i<aList.length; i++) {
			$('#'+aList[i]).fadeOut();
		}
	}
	
	function show(what) {
		hide_all();
		$('#'+what).fadeIn();
	}
	
</script>
</body>
</html>