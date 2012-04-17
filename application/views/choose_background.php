<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">

* {
	margin: 0;
	padding:0;
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
<body >


<div style="width:100%; height: 126px; text-align:center; background: url('/img/bg.gif') top left; padding: 10px 0 0 0;">

	<div style="width: 956px; height: 126px; background: url('/img/toolbar2.png') top left no-repeat; margin: 0 auto; text-align: left">

<!-- 
		<div onclick="save_all()" class="btn_out" title="Zapisz">
			<div class="btn_in">Zapisz</div>
		</div>
 -->
		<div style="margin-left: 95px" onclick="window.open('/uploads/tmp/u<?php echo $userid ?>_saved.jpg', '_blank')" class="btn_out" title="Podgląd">
			<div class="btn_in">Podgląd</div>
		</div>
		<div onclick="clear_canvas()" class="btn_out" title="Wyczyść">
			<div class="btn_in">Wyczyść</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/pdf', '_blank')" class="btn_out" title="Wydrukuj">
			<div class="btn_in">Wydrukuj</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/downloadjpg', '_blank')" class="btn_out" title="Pobierz JPG">
			<div class="btn_in">Pobierz JPG</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/downloadpdf', '_blank')" class="btn_out" title="Pobierz PDF">
			<div class="btn_in">Pobierz PDF</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/send', '_blank')" class="btn_out" title="Wyślij email">
			<div class="btn_in">Wyślij email</div>
		</div>

		
		<div style="clear: both"></div>
	</div>
</div>
<div style="width: 100%; height: 4px; background: url('/img/break.png') repeat-x;"></div>


<div style="text-align: center;width:100%;margin-top:15px">
	<div style="width:1000px; height:600px; background: #fff; margin:0 auto;text-align: left">
		<div style="float:left;">
		
		<?php ob_start(); ?>

			<form enctype="multipart/form-data" name="form" method="post" action="/index.php/<?php echo $url ?>/upload_bg">


		<h4 style="padding: 0 0 0 15px">Wybierz plik z dysku</h4>
		<div style="float:left;padding: 15px 10px 0 15px">
			<?php echo inputFile('Obrazek (JPG):', 'file') ?>
		</div>
		<div style="float:left;">
			
			<?php echo getButton('Dodaj', 'if(document.form.file.value == \'\'){alert(\'Musisz wybrać plik z dysku...\')}else{document.form.submit()}') ?>
		</div>
		<div style="clear:both"></div>
	
</form>
						
		<br>				
		<h4 style="padding: 0 0 0 15px">lub wybierz dostępne tło</h4>
		
		<div id="items-list" style=" height:450px; overflow: auto">
				<?php
						foreach ($list as $row) {
							//echo '<a href="/index.php/'.$url.'/drag?bg='.$row->id.'" title="Wybierz tło"><img src="/uploads/background_'.$row->id.'.jpg" style="max-width:200px; max-height:200px;padding: 2px; border: 1px solid #ddd"></a>';
							echo '<div style="float:left; margin: 15px"><a href="/index.php/'.$url.'/drag?bg='.$row->id.'" title="Wybierz tło"><img src="/uploads/background_'.$row->id.'.jpg" style="max-width:200px; max-height:200px;padding: 2px; border: 1px solid #ddd"></a></div>';
						}//foreach
						
				?>
		
			<div style="clear:both"></div>
		</div>
		
			<?php 
				$content = ob_get_clean();
				echo divShadow(1000, 600, $content,0) 
			?>
				
						
	</div>
</div>

<!-- FOOTER -->
<br clear="all">
<div style="background: #67806E; width:100%;height:150px;border-top:2px solid #674A3E;margin-top:40px">
<div style="padding:60px 40px 0 40px">
	<a href="#" title="" style="font-size:15px;font-family:tahoma,sans-serif; color:#fff;text-decoration: none; margin-right: 15px" onmouseover="this.style.borderBottom='1px dotted #fff'" onmouseout="this.style.borderBottom='none'">link1</a>
</div>
</div>

<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script type="text/javascript">

       $(document).ready(function(){

          $("div#items-list img").each(function() {

           //Get the width of the image
           var width = $(this).width();
           var height = $(this).height();

           //Max-width substitution (works for all browsers)
           if (width > 200) {
             $(this).css("width", "200px");
           }
           //Max-height substitution (works for all browsers)
           if (height > 200) {
             $(this).css("height", "200px");
           }

         });

       });

      </script>
</body>
</html>