<html>
<head>
<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/ui.draggable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.droppable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.resizable.min.js" type="text/javascript"></script>
<script src="/javascript/json.js" type="text/javascript"></script>

<style type="text/css">

 .drophover {
		border: 1px solid #000 !important;
	}

</style>

</head>
<body>

	<h1>
	<?php echo $header; ?>
	</h1>
	
	<img src="/uploads/step<?php echo $step; ?>.png" width="553" height="44">



	<div style="width: 1000px; text-align:center">
	  
	  <div style="float:left; width:800px">
	  	<div style="padding:0 10px">
				Wybierz element
				
				<?php echo showItemsInColumns($list, 2); ?>
				
	  	</div>
	  </div>
	  <div style="float:left; width:200px">
	  	<div style="padding:0 10px">
	  		
	  		<div id="preview_fitting1" style="background: url('/uploads/fitting_<?php echo $fittingId; ?>.png') #ddd no-repeat; width: 150px; height: 150px;margin-bottom: 20px; border:1px solid #ccc"> </div>
	  		
	  		<div id="preview_crown1" style="background: url('/uploads/crown_<?php echo $crownId; ?>.png') #ddd no-repeat; width: 150px; height: 150px;margin-bottom: 20px; border:1px solid #ccc"> </div>
	  		
	  		<div id="preview_column1" style="background: url('/uploads/column_<?php echo $columnId; ?>.png') #ddd no-repeat; width: 150px; height: 300px; margin-bottom: 20px; border:1px solid #ccc"> </div>
	  	
	  	</div>
	  	</div>
		<div style="clear:both"></div>
	</div>


<!-- 
				Podgl�d 
				<img id="preview_fitting" src="/uploads/fitting_<?php echo $fittingId; ?>.png" width="50"height="50"> 
				<img id="preview_crown"src="/uploads/crown_<?php echo $crownId; ?>.png" width="50"height="50"> 
				<img id="preview_column"src="/uploads/column_<?php echo $columnId; ?>.png" width="50"height="50"> 
 -->
				



	<form name="form">
		<input type="hidden" value="<?php echo $columnId; ?>" name="column" id="column"> 
			<input type="hidden" value="<?php echo $crownId; ?>" name="crown" id="crown"> 
			<input type="hidden" value="<?php echo $fittingId; ?>" name="fitting" id="fitting"> 
			<input type="hidden" value="<?php echo $step; ?>" name="step"> 
			<table width="100%"><tr><td width="50%"><?php showButton('Wstecz', 'back()', 'grey') ?></td><td width="50%"><?php showSubmit('Dalej') ?></td></tr></table>
	</form>

<!-- 
				<div id="preview_column1" style="width:200px; height:10%; background: url('/uploads/column/<?php echo $columnId; ?>.jpg');"> -wybierz kolumne- </div>
				<div id="preview_crown1" style="width:200px; height:10%; background: url('/uploads/crown/<?php echo $crownId; ?>.jpg');"> -wybierz korone- </div>
				<div id="preview_fitting1" style="width:200px; height:10%; background: url('/uploads/fitting/<?php echo $fittingId; ?>.jpg');"> -wybierz oprawe- </div>
 -->
				
				

	<script type="text/javascript">

function setElement(type, imgFile) {
	$('#preview_'+type).attr('src', '/uploads/<?php echo $type; ?>/'+imgFile+'.jpg');
	$('#'+type).attr('value', imgFile);
}

function back() {
	document.form.step.value = parseInt(document.form.step.value - 2);
	if (document.form.step.value < 0) {
		document.form.step.value = 0;
	}
	document.form.submit(); 
}

</script>


	<script type="text/javascript">
        $(document).ready(function() {
            $(".draggable").draggable({ hoverClass: "product-active", revert: "invalid", cursor: 'move', opacity: 0.35, addClasses: false, helper: 'clone', containment: "document" });


            
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


            
           });//ready document

            

    </script>

</body>
</html>
