<html>
<head>
<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
* {
	margin: 0;
	padding:0;
}
 .drophover {
		border: 1px solid #000 !important;
		color: black !important;
	}
	
 .productactive {
		background: #eee !important;
		
	}

</style>

</head>
<body>

<div style="width:100%; height: 120px; text-align:center; background: url('/img/bg.gif') top left; padding: 10px 0 0 0;">

	
</div>
<div style="width: 100%; height: 4px; background: url('/img/break.png') repeat-x;"></div>





	<h1>
	<?php //echo $header; ?>
	</h1>
	<!-- 
	<img src="/uploads/step<?php echo $step; ?>.png" width="553" height="44">
	 -->


<div style="text-align: center;width:100%;margin-top:15px">
	<div style="width:1000px; height:690px; background: #fff; margin:0 auto;text-align: left">

		<p style="margin:10px 0; color: green; border: 1px dotted green; padding: 10px 0; text-align: center">
			<b style="color:black">Wybrana kategoria:
			<?php if (!empty($street)) echo ' "Miasto - ulica" ';?>
			<?php if (!empty($garden)) echo ' "Dom - ogród" ';?>
			<?php if (empty($garden) && empty($street)) echo ' "Wszystkie" ';?>
			</b>
		
			<?php if (!empty($extra_info)) echo '<br><b>INFO:</b> Wybrana kolumna może być łączona bezpośrednio z oprawą (z pominięciem korony).' ?>
		</p>
			
		<div style="clear:both"></div>
		
		<div style="float:left;">
			<?php ob_start(); ?>

<!-- 
				<div id="preview_fitting1" style="color:#aaa;background: url('/uploads/fitting_<?php echo $fittingId; ?>.png') #ddd no-repeat; width: 250px; height: 110px;margin-bottom: 10px; border:1px solid #ccc"><div style="text-align: center; padding: 40px 0 0 0;"> - tutaj opuść oprawę - </div></div>
	  		<div id="preview_crown1" style="color:#aaa;background: url('/uploads/crown_<?php echo $crownId; ?>.png') #ddd no-repeat; width: 250px; height: 100px;margin-bottom: 10px; border:1px solid #ccc"><div style="text-align: center; padding: 35px 0 0 0;"> - tutaj opuść koronę - </div></div>
	  		<div id="preview_column1" style="color:#aaa;background: url('/uploads/column_<?php echo $columnId; ?>.png') #ddd no-repeat; width: 250px; height: 320px; margin-bottom: 0px; border:1px solid #ccc"><div style="text-align: center; padding: 140px 0 0 0;"> - tutaj opuść podstawę - </div></div>
 -->				

				<div title="Lista opraw" onclick="document.getElementById('step').value=2;document.form.submit()" id="preview_fitting1" style="color:#333; width: 250px; height: 110px;margin-bottom: 10px; border:1px solid #ccc; text-align:center; cursor: pointer">
					<?php if (is_file($_SERVER['DOCUMENT_ROOT'].'/uploads/fitting_'.$fittingId.'.png')) {  ?>
						<img id="preview_fitting" src="/uploads/fitting_<?php echo $fittingId?>.png" style="max-height: 100px; margin: 0 auto">
					<?php } else { ?>
						<img id="preview_fitting" src="/uploads/dummy.png" style="max-height: 100px; margin: 0 auto">
						<div id="preview_fitting_text" style="text-align: center; padding: 40px 0 0 0;"> - 3. wybierz oprawę - </div>
					<?php } ?>						
				</div>
	  		<div title="Lista koron" onclick="document.getElementById('step').value=1;document.form.submit()" id="preview_crown1" style="color:#333; width: 250px; height: 100px;margin-bottom: 10px; border:1px solid #ccc;text-align:center; cursor: pointer">
					<?php if (is_file($_SERVER['DOCUMENT_ROOT'].'/uploads/crown_'.$crownId.'.png')) {  ?>
						<img id="preview_crown" src="/uploads/crown_<?php echo $crownId?>.png" style="max-height: 100px; margin: 0 auto">
					<?php } else { ?>
						<img id="preview_crown" src="/uploads/dummy.png" style="max-height: 100px; margin: 0 auto">
	  				<div id="preview_crown_text" style="text-align: center; padding: 35px 0 0 0;"> - 2. wybierz koronę - </div>
					<?php } ?>						
	  		
	  			
	  		</div>
	  		<div title="Lista słupów" onclick="document.getElementById('step').value=0;document.form.submit()" id="preview_column1" style="color:#333; width: 250px; height: 320px; margin-bottom: 0px; border:1px solid #ccc;text-align:center; cursor: pointer">
					<?php if (is_file($_SERVER['DOCUMENT_ROOT'].'/uploads/column_'.$columnId.'.png')) {  ?>
						<img id="preview_column" src="/uploads/column_<?php echo $columnId?>.png" style="max-height: 315px; margin: 0 auto">
					<?php } else { ?>
						<img id="preview_column" src="/uploads/dummy.png" style="max-height: 315px; margin: 0 auto">
	  				<div id="preview_column_text" style="text-align: center; padding: 140px 0 0 0;"> - 1. wybierz słup - </div>
					<?php } ?>						
	  		
	  		</div>
		
		
		
			<?php 
				$content = ob_get_clean();
				echo divShadow(300, 600, $content);
			?>
		
		</div>
		<div style="float:left;" id="items-list">
			<?php echo divShadow(700, 600, showItemsInColumns($list, 2),0) ?>
				
		</div>
		<div style="clear:both"></div>
	</div>
	<form style="margin: 20px auto; width:500px;" name="form">
	
		<input type="hidden" value="<?php echo $columnId; ?>" name="column" id="column"> 
			<input type="hidden" value="<?php echo $crownId; ?>" name="crown" id="crown"> 
			<input type="hidden" value="<?php echo $fittingId; ?>" name="fitting" id="fitting"> 
			<input type="hidden" value="<?php echo $step; ?>" name="step" id="step">
			<?php echo form_hidden('street', $street);?> 
			<?php echo form_hidden('garden', $garden);?> 
			<?php echo form_hidden('bgid', $bgid);?> 
			
			<table cellpadding="5" style="margin:10px 0 10px 0;">
				<tr><td><?php echo getLink('Anuluj', '/index.php/EmailsTemplate/choose_item', '', true) ?></td><td><?php showButton('Zapisz', "save()"); ?></td></tr>
			</table> 
			
	</form>
</div>



<!-- FOOTER -->
<?php echo footer_html() ?>			




				
				

	<script type="text/javascript">


	function save() {
		
		var column = document.getElementById('column').value;
		var crown = document.getElementById('crown').value;
		var fitting = document.getElementById('fitting').value;

		if ((column == 'undefined' || column == 0) && (crown == 'undefined' || crown == 0) && (fitting == 'undefined' || fitting == 0)) {
			alert('Musisz wybrać przynajmniej jeden element...');
			return false;
		}
		
		document.getElementById('step').value=3;
		document.form.submit();
	}
	

function setElement(type, imgFile) {
	$('#preview_'+type).attr('src', '/uploads/<?php echo $type; ?>_'+imgFile+'.png');

	var height = $('#preview_'+type).height();
  if (height > 100 && type != 'column') {
  	 $("#preview_"+type).css("height", "100px");
  }
  else if (type == 'column' && height > 315 ) {
  	 $("#preview_column").css("height", "315px");
	}
    
	$('#preview_'+type+'_text').css('display', 'none');
	//$('#'+type).attr('value', imgFile);
	document.getElementById(type).value = imgFile;
}

function back() {
	document.form.step.value = parseInt(document.form.step.value - 2);
	if (document.form.step.value < 0) {
		document.form.step.value = 0;
		location.href='/index.php/EmailsTemplate/choose_item';
	} else {
		document.form.submit(); 
	}
}

</script>

<script type="text/javascript">

       $(document).ready(function(){

          $("div#items-list img.columns").each(function() {

           var height = $(this).height();

           //Max-height substitution (works for all browsers)
           if (height > 315) {
             $(this).css("height", "315px");
           }

         });
          
          $("div#items-list img.others").each(function() {

           var height = $(this).height();

           //Max-height substitution (works for all browsers)
           if (height > 100) {
             $(this).css("height", "100px");
           }

         });



          init();
       });

          function init() {
	          var height = $("#preview_crown").height();
	          if (height > 100) {
	        	  $("#preview_crown").css("height", "100px");
	          }
	          
	          var height = $("#preview_fitting").height();
	          if (height > 100) {
	        	  $("#preview_fitting").css("height", "100px");
	          }
	          
	          var height = $("#preview_column").height();
	          if (height > 315) {
	        	  $("#preview_column").css("height", "315px");
	          }
          }
      </script>
	
</body>
</html>