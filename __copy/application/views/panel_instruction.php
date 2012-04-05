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
	
		<h1>Instrukcja użytkownika<br><small>Panel administracyjny</small></h1><br><br>

		<div class="box">
			<h3>Słupy - <small>zarządzanie bazą</small></h3>
			<a href="javascript:void(0)" onclick="hide_all()" class="top" title="ukryj">[x]</a>
			
			<ul style="margin-left: 50px; list-style: square;">
				<li><a href="javascript:void(0)" onclick="showAdd('column')" class="menu" title="Zobacz jak dodać koronę">Dodawanie</a></li>
				<li><a href="javascript:void(0)" onclick="showEdit('column')" class="menu" title="Zobacz jak edytować koronę">Edycja</a></li>
				<li><a href="javascript:void(0)" onclick="showDel('column')" class="menu" title="Zobacz jak usunąć koronę">Usuwanie</a></li>
			</ul>

			<div class="boximg" id="columnadd">
				<h4>Dodawanie</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Slupy/edycja/0"><?php echo $url;?>/Slupy/edycja/0</a></i>
				<img src="/img/instr/panel/column/dodaj.png" class="screenshot">		<div class="foot"><i>Dodanie słupa krok I</i></div> 
				<img src="/img/instr/panel/column/dodaj_2.png" class="screenshot">	<div class="foot"><i>Dodanie słupa krok II</i></div>
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
			
			<div class="boximg" id="columnedit">
				<h4>Edycja</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Slupy/edycja/1"><?php echo $url;?>/Slupy/edycja/1</a></i>
				<img src="/img/instr/panel/column/edycja.png" class="screenshot">	<div class="foot"><i>Edycja danych słupa</i></div>
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
			
			<div class="boximg" id="columndel">
				<h4>Usuwanie</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Slupy"><?php echo $url;?>/slupy</a></i>
				<img id="column3" src="/img/instr/panel/column/usun.png" class="screenshot">	<div class="foot"><i>Usunięcie słupa</i></div>
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
		</div>
		
		<div class="box">
			<h3>Korony - <small>zarządzanie bazą</small></h3>
			<a href="javascript:void(0)" onclick="hide_all()" class="top" title="ukryj">[x]</a>
			
			<ul style="margin-left: 50px; list-style: square;">
				<li><a href="javascript:void(0)" onclick="showAdd('crown')" class="menu" title="Zobacz jak dodać koronę">Dodawanie</a></li>
				<li><a href="javascript:void(0)" onclick="showEdit('crown')" class="menu" title="Zobacz jak edytować koronę">Edycja</a></li>
				<li><a href="javascript:void(0)" onclick="showDel('crown')" class="menu" title="Zobacz jak usunąć koronę">Usuwanie</a></li>
			</ul>

			<div class="boximg" id="crownadd">
				<h4>Dodawanie</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Korony/edycja/0"><?php echo $url;?>/korony/edycja/0</a></i>
				<img src="/img/instr/panel/crown/dodaj.png" class="screenshot">		<div class="foot"><i>Dodanie korony krok I</i></div> 
				<img src="/img/instr/panel/crown/dodaj_2.png" class="screenshot">	<div class="foot"><i>Dodanie korony krok II</i></div>
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
			
			<div class="boximg" id="crownedit">
				<h4>Edycja</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Korony/edycja/1"><?php echo $url;?>/korony/edycja/1</a></i>
				<img src="/img/instr/panel/crown/edycja.png" class="screenshot">	<div class="foot"><i>Edycja danych korony</i></div>
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
			
			<div class="boximg" id="crowndel">
				<h4>Usuwanie</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Korony"><?php echo $url;?>/korony</a></i>
				<img id="crown3" src="/img/instr/panel/crown/usun.png" class="screenshot">	<div class="foot"><i>Usunięcie korony</i></div>
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
		</div>

		<div class="box">
			<h3>Oprawy - <small>zarządzanie bazą</small></h3>
			<a href="javascript:void(0)" onclick="hide_all()" class="top" title="ukryj">[x]</a>
			
			<ul style="margin-left: 50px; list-style: square;">
				<li><a href="javascript:void(0)" onclick="showAdd('fitting')" class="menu" title="Zobacz jak dodać oprawę">Dodawanie</a></li>
				<li><a href="javascript:void(0)" onclick="showEdit('fitting')" class="menu" title="Zobacz jak edytować oprawę">Edycja</a></li>
				<li><a href="javascript:void(0)" onclick="showDel('fitting')" class="menu" title="Zobacz jak usunąć oprawę">Usuwanie</a></li>
			</ul>

			<div class="boximg" id="fittingadd">
				<h4>Dodawanie</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Oprawy/edycja/0"><?php echo $url;?>/Oprawy/edycja/0</a></i>
				<img src="/img/instr/panel/fitting/dodaj.png" class="screenshot">		<div class="foot"><i>Dodanie oprawy krok I</i></div> 
				<img src="/img/instr/panel/fitting/dodaj_2.png" class="screenshot">	<div class="foot"><i>Dodanie oprawy krok II</i></div>
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
			
			<div class="boximg" id="fittingedit">
				<h4>Edycja</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Oprawy/edycja/1"><?php echo $url;?>/Oprawy/edycja/1</a></i>
				<img src="/img/instr/panel/fitting/edycja.png" class="screenshot">	<div class="foot"><i>Edycja danych oprawy</i></div>
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
			
			<div class="boximg" id="fittingdel">
				<h4>Usuwanie</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Oprawy"><?php echo $url;?>/oprawy</a></i>
				<img id="fitting3" src="/img/instr/panel/fitting/usun.png" class="screenshot">	<div class="foot"><i>Usunięcie oprawy</i></div>
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a> 
			</div>
		</div>
		
		<div class="box">
			<h3>Klienci - <small>zarządzanie bazą</small></h3>
			<a href="javascript:void(0)" onclick="hide_all()" class="top" title="ukryj">[x]</a>
			
			<ul style="margin-left: 50px; list-style: square;">
				<li><a href="javascript:void(0)" onclick="showAdd('client')" class="menu" title="Zobacz jak dodać oprawę">Dodawanie</a></li>
				<li><a href="javascript:void(0)" onclick="showEdit('client')" class="menu" title="Zobacz jak edytować oprawę">Edycja</a></li>
				<li><a href="javascript:void(0)" onclick="showDel('client')" class="menu" title="Zobacz jak usunąć oprawę">Usuwanie</a></li>
			</ul>

			<div class="boximg" id="clientadd">
				<h4>Dodawanie</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Klienci/edycja/0"><?php echo $url;?>/Klienci/edycja/0</a></i>
				<img src="/img/instr/panel/client/dodaj.png" class="screenshot">		<div class="foot"><i>Dodanie klienta krok I</i></div> 
				<img src="/img/instr/panel/client/dodaj_2.png" class="screenshot">	<div class="foot"><i>Dodanie klienta krok II</i></div> 
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a>
			</div>
			
			<div class="boximg" id="clientedit">
				<h4>Edycja</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Klienci/edycja/1"><?php echo $url;?>/Klienci/edycja/1</a></i>
				<img src="/img/instr/panel/client/edycja.png" class="screenshot">	<div class="foot"><i>Edycja danych klienta (bez zmiany hasła)</i></div> 
				<img src="/img/instr/panel/client/edycja_2.png" class="screenshot">	<div class="foot"><i>Edycja danych klienta (ze zmianą hasła)</i></div> 
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a>
			</div>
			
			<div class="boximg" id="clientdel">
				<h4>Usuwanie</h4>
				<i><a target="_blank" href="<?php echo $url;?>/Klienci"><?php echo $url;?>/Klienci</a></i>
				<img id="client3" src="/img/instr/panel/client/usun.png" class="screenshot">	<div class="foot"><i>Usunięcie klienta</i></div> 
				<br><a href="javascript:void(0)" onclick="hide_all()" title="ukryj">[zamknij]</a>
			</div>
		</div>

	
	</div>
</div>




<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/main.js" type="text/javascript"></script>
<script type="text/javascript">

	var aList = new Array('column', 'crown', 'fitting', 'client');

	function hide_all() {
		for (var i=0; i<aList.length; i++) {
			$('#'+aList[i]+'add').fadeOut();
			$('#'+aList[i]+'edit').fadeOut();
			$('#'+aList[i]+'del').fadeOut();
		}
	}
	
	function show(what, action) {
		hide_all();
		$('#'+what+''+action).fadeIn();
	}

	function showAdd(what) {
		show(what, 'add')
	}
	
	function showEdit(what) {
		show(what, 'edit')
	}

	function showDel(what) {
		show(what, 'del')
	}
	
</script>
</body>
</html>