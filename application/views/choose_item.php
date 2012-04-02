<html>
<head>
<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/ui.draggable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.droppable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.resizable.min.js" type="text/javascript"></script>
<!-- 
<script src="/javascript/json.js" type="text/javascript"></script>
 -->
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
		
			<?php if (!empty($extra_info)) echo '<br><b>INFO:</b> Wybrana kolumna może być łączona bezpośrednio z oprawą (z pominięciem korony).<br>Kliknij przycisk "<b>Dalej</b>" jeśli chcesz wybrać od razu oprawę .' ?>
		</p>
			
		<div style="clear:both"></div>
		<div style="float:left;">
		
			<?php 
				echo divShadow(700, 600, showItemsInColumns($list, 2),0) ?>
		</div>
		<div style="float:left;">
		
		<?php ob_start(); ?>
				<div id="preview_fitting1" style="color:#aaa;background: url('/uploads/fitting_<?php echo $fittingId; ?>.png') #ddd no-repeat; width: 250px; height: 110px;margin-bottom: 10px; border:1px solid #ccc"><div style="text-align: center; padding: 40px 0 0 0;"> - tutaj opuść oprawę - </div></div>
	  		<div id="preview_crown1" style="color:#aaa;background: url('/uploads/crown_<?php echo $crownId; ?>.png') #ddd no-repeat; width: 250px; height: 100px;margin-bottom: 10px; border:1px solid #ccc"><div style="text-align: center; padding: 35px 0 0 0;"> - tutaj opuść koronę - </div></div>
	  		<div id="preview_column1" style="color:#aaa;background: url('/uploads/column_<?php echo $columnId; ?>.png') #ddd no-repeat; width: 250px; height: 320px; margin-bottom: 0px; border:1px solid #ccc"><div style="text-align: center; padding: 140px 0 0 0;"> - tutaj opuść podstawę - </div></div>
		
		
		
			<?php 
				$content = ob_get_clean();
				echo divShadow(300, 600, $content);
			?>
				
		</div>
		<div style="clear:both"></div>
	</div>
	<form style="margin: 20px auto; width:500px;" name="form">
	
		<input type="hidden" value="<?php echo $columnId; ?>" name="column" id="column"> 
			<input type="hidden" value="<?php echo $crownId; ?>" name="crown" id="crown"> 
			<input type="hidden" value="<?php echo $fittingId; ?>" name="fitting" id="fitting"> 
			<input type="hidden" value="<?php echo $step; ?>" name="step">
			<?php echo form_hidden('street', $street);?> 
			<?php echo form_hidden('garden', $garden);?> 
			<?php echo form_hidden('bgid', $bgid);?> 
			<table width="100%"><tr><td width="50%"><?php showButton('Wstecz', 'back()', 'grey') ?></td><td width="50%"><?php showSubmit('Dalej') ?></td></tr></table>
	</form>
</div>





	<!-- FOOTER -->
<br clear="all">
<div style="background: #67806E; width:100%;height:150px;border-top:2px solid #674A3E;margin-top:0px">
<div style="padding:60px 40px 0 40px">
	<a href="#" title="" style="font-size:15px;font-family:tahoma,sans-serif; color:#fff;text-decoration: none; margin-right: 15px" onmouseover="this.style.borderBottom='1px dotted #fff'" onmouseout="this.style.borderBottom='none'">link1</a>
</div>
</div>			





				
				

	<script type="text/javascript">

function setElement(type, imgFile) {
	$('#preview_'+type).attr('src', '/uploads/<?php echo $type; ?>/'+imgFile+'.jpg');
	$('#'+type).attr('value', imgFile);
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
        $(document).ready(function() {
            $(".draggable").draggable({ hoverClass: "productactive", revert: "invalid", cursor: 'move', opacity: 0.35, addClasses: false, helper: 'clone', containment: "document" });


            
            $("#preview_column1").droppable({
                 accept: ".column", 
                 hoverClass: 'drophover',
                 drop: function(event, ui){

									//za kazdym razem czysci podglad - tylko jeden element wybrany
									$("#preview_column1").text('');
									$("#preview_column1").css('background', 'none');
									
                	 var dragObject = ui.draggable;
                	 var clone = dragObject.clone();
                	 
                	 clone.appendTo($("#preview_column1"));
                	 $('#column').attr('value', clone.attr('id'));
						
                  }  
              });

            $("#preview_crown1").droppable({
                 accept: ".crown", 
                 hoverClass: 'drophover',
                 drop: function(event, ui){

									//za kazdym razem czysci podglad - tylko jeden element wybrany
									$("#preview_crown1").text('');
									$("#preview_crown1").css('background', 'none');
									
                	 var dragObject = ui.draggable;
                	 var clone = dragObject.clone();
                	 
                	 clone.appendTo($("#preview_crown1"));
                	 $('#crown').attr('value', clone.attr('id'));
						
                  }  
              });
            
            $("#preview_fitting1").droppable({
                 accept: ".fitting", 
                 hoverClass: 'drophover',
                 drop: function(event, ui){

									//za kazdym razem czysci podglad - tylko jeden element wybrany
									$("#preview_fitting1").text('');
									$("#preview_fitting1").css('background', 'none');
									
                	 var dragObject = ui.draggable;
                	 var clone = dragObject.clone();
                	 
                	 clone.appendTo($("#preview_fitting1"));
                	 $('#fitting').attr('value', clone.attr('id'));
						
                  }  
              });


            	/*
            	 * jak zostal wybrany jakis element skasowanie tekstu z opuszczanych pól
            	 */
							var colid = <?php echo $columnId; ?>;
							var croid = <?php echo $crownId; ?>;
							var fitid = <?php echo $fittingId; ?>;
							function hide_text() {
								if (colid > 0) {
									$('#preview_column1').text('');
								}
								if (croid > 0) {
									$('#preview_crown1').text('');
								}
								if (fitid > 0) {
									$('#preview_fitting1').text('');
								}
							}
							hide_text();
           });//ready document

            

    </script>

</body>
</html>
