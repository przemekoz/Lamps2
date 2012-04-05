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
	padding: 10px 20px;
	margin: 15px 0 50px 0; 
}
.screenshot {
	max-width: 850px;
	margin-top: 10px;
}

.boximg {
	display: none;	
}
.foot {
	text-align: center;
	margin-bottom: 15px;	
}

i {
	font-size: 13px;
}
</style>
</head>
<body>



<div style="width: 1000px; margin: 30px auto 0 auto; text-align: left; background: #fff;border: 1px dotted #b8b8b8">
	<div style="padding: 20px 50px;">
	
	
		<a name="top"></a>
		<h1>Instrukcja użytkownika - panel administracyjny</h1><br><br>
		
		<h2>Zarządzanie bazami:</h2>
		<ul style="margin-left: 50px; list-style: square;">
			<li><a href="#clients" class="top_menu">Klientów</a></li>
			<li><a href="#column" class="top_menu">Słupów</a></li>
			<li><a href="#crown" class="top_menu">Koron</a></li>
			<li><a href="#fitting" class="top_menu">Opraw</a></li>
		</ul>
		
		
		<div class="box">
			<a name="crown"></a>
			<h3>Baza koron</h3>
			
			<ul style="margin-left: 50px; list-style: square;">
				<li><a href="javascript:void(0)" onclick="showAdd('crown')" class="menu" title="Zobacz jak dodać koronę">Dodawanie</a></li>
				<li><a href="javascript:void(0)" onclick="showEdit('crown')" class="menu" title="Zobacz jak edytować koronę">Edycja</a></li>
				<li><a href="javascript:void(0)" onclick="showDel('crown')" class="menu" title="Zobacz jak usunąć koronę">Usuwanie</a></li>
			</ul>

			<div class="boximg" id="crownadd">
				<h4>Dodawanie</h4>
				<img src="/img/instr/panel/crown/dodaj.png" class="screenshot">		<div class="foot"><i>Dodanie korony krok I</i></div> 
				<img src="/img/instr/panel/crown/dodaj_2.png" class="screenshot">	<div class="foot"><i>Dodanie korony krok II</i></div> 
			</div>
			
			<div class="boximg" id="crownedit">
				<h4>Edycja</h4>
				<img src="/img/instr/panel/crown/edycja.png" class="screenshot">	<div class="foot"><i>Edycja danych korony</i></div> 
			</div>
			
			<div class="boximg" id="crowndel">
				<h4>Usuwanie</h4>
				<img id="crown3" src="/img/instr/panel/crown/usun.png" class="screenshot">	<div class="foot"><i>Usunięcie korony</i></div> 
			</div>
			
			<br><a href="#top" onclick="hide_all()" class="top">do spisu</a>
		</div>

		<div class="box">
			<a name="fitting"></a>
			<h3>Baza opraw</h3>
			
			<ul style="margin-left: 50px; list-style: square;">
				<li><a href="javascript:void(0)" onclick="showAdd('fitting')" class="menu" title="Zobacz jak dodać oprawę">Dodawanie</a></li>
				<li><a href="javascript:void(0)" onclick="showEdit('fitting')" class="menu" title="Zobacz jak edytować oprawę">Edycja</a></li>
				<li><a href="javascript:void(0)" onclick="showDel('fitting')" class="menu" title="Zobacz jak usunąć oprawę">Usuwanie</a></li>
			</ul>

			<div class="boximg" id="fittingadd">
				<h4>Dodawanie</h4>
				<img src="/img/instr/panel/fitting/dodaj.png" class="screenshot">		<div class="foot"><i>Dodanie oprawy krok I</i></div> 
				<img src="/img/instr/panel/fitting/dodaj_2.png" class="screenshot">	<div class="foot"><i>Dodanie oprawy krok II</i></div> 
			</div>
			
			<div class="boximg" id="fittingedit">
				<h4>Edycja</h4>
				<img src="/img/instr/panel/fitting/edycja.png" class="screenshot">	<div class="foot"><i>Edycja danych oprawy</i></div> 
			</div>
			
			<div class="boximg" id="fittingdel">
				<h4>Usuwanie</h4>
				<img id="fitting3" src="/img/instr/panel/fitting/usun.png" class="screenshot">	<div class="foot"><i>Usunięcie oprawy</i></div> 
			</div>
			
			<br><a href="#top" onclick="hide_all()" class="top">do spisu</a>
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