<style>
    input[type="button"] {
        border:2px solid;
        border-radius:5px;
        -moz-border-radius:5px;
    }
</style>


<?php panelshowTop('Definiowanie dodatkowych parametrów łączenia kolumn z koronami'); ?>



	<div style="width: 1000px;">
	
		<div style="width: 150px; float:left">
<form name="form" method="post" action="/konfigurator.php/<?php echo $url?>/save_params">
<?php echo form_hidden('id_crown', $cid) ?>
<?php echo form_hidden('id_column', $fid) ?>
Przesunięcie X: <?php echo form_input('lambda_x', $LAMBDA_X) ?><br><br>
Przesunięcie Y: <?php echo form_input('lambda_y', $LAMBDA_Y) ?><br><br>

<a href="javascript:void(0)" onclick="set_lambda()">ustaw</a>
<!-- 
<br>
<a href="javascript:void(0)" onclick="set_default()">przywróć domyślne</a>
 -->
<?php panelShowSubmitCancel(); ?>
</form>
		
		</div>		
		
		<div style="width: 850px; float:left; text-align: center;">
		
		<b><?php echo $crown_title ?></b>, <b><?php echo $column_title ?></b>
		
			<div id="canvas" style="width: <?php echo $X ?>px; height: <?php echo ($B+$Y) ?>px; margin: 0 auto; position: relative; text-align:center; background: #f8f8f8; border: 1px dashed #ddd">
			
				<div id="column_left" style="z-index:10; position:absolute; left:<?php echo $K ?>px; top:<?php echo $top_column?>px; width:<?php echo $A ?>px; height:<?php echo $B ?>px;">
					<img src="<?php echo $dir_relative?>/column_<?php echo $fid ?>.png" width="<?php echo $A ?>" height="<?php echo $B ?>">
				</div>
				<div id="column_right" style="<?php echo $show_right_column ?>; z-index:10; position:absolute; left:<?php echo $N ?>px; top:<?php echo $top_column?>px; width:<?php echo $A ?>px; height:<?php echo $B ?>px;">
					<img src="<?php echo $dir_relative?>/column_<?php echo $fid ?>.png" width="<?php echo $A ?>" height="<?php echo $B ?>">
				</div>
				
				<div id="crown" style="z-index:9; position:relative; margin:0 auto; left:0; top:<?php echo $top_crown?>px; width: <?php echo $X ?>px; height: <?php echo $Y ?>px;">
					<img src="<?php echo $dir_relative?>/crown_<?php echo $cid ?>.png" width="<?php echo $X ?>" height="<?php echo $Y ?>">
				</div>
			
			</div>
	</div>
		</div>		
		<div style="clear:both"></div>
		

<script>

var X = <?php echo $X?>;
var X1 = <?php echo $X?>;
var A = <?php echo $A?>;
var K = <?php echo $K?>;
var N = <?php echo $N?>;
var B = <?php echo $B?>;
var Y = <?php echo $Y?>;
var TOP_CROWN = <?php echo $top_crown?>;

function set_default() {
	form.lambda_x.value = 0;
 	form.lambda_y.value = 0;
 	set_lambda();
}

function set_lambda() {

 	var lambda_x = form.lambda_x.value;
 	var lambda_y = form.lambda_y.value;
 	
 	/* lambda Y nie może być ujemna oraz nie moze byc mniejsza niz wysokosc korony - wysokosc oprawy */
 	
 	if (lambda_y < 0) {
 		alert("Wartość przesunięcia Y nie może być ujemna.\n");
 		return false;
 	}
 	
	// -------------- //
	// przesuniecie X //
	// -------------- //
 	if (lambda_x >= 0) {
 		X1 = X; 
 		K = lambda_x;
 		N = X - A - lambda_x;
 	}
 	else if (lambda_x < 0) {
 		X1 = X - (2 * lambda_x);
 		K = 0;
 		N = X1 - A; 
 	}
	
	/* canvas */
 	document.getElementById('canvas').style.width = X1+'px';
	/* lewa oprawa */
 	document.getElementById('column_left').style.left = K+'px';
	/* prawa oprawa */
 	document.getElementById('column_right').style.left = N+'px';

	// -------------- //
	// przesuniecie Y //
	// -------------- //
	var Y1 = B + Y;
	if (lambda_y > 0) {
		Y1 = B + Y - lambda_y;
	}
	

	/* canvas */
 	document.getElementById('canvas').style.height = Y1+'px';
	/* korona */
	if (TOP_CROWN > 0) {
	 	//oprawy stojace
	 	document.getElementById('crown').style.top = (B - lambda_y)+'px';
	}
	else if (TOP_CROWN == 0) {
		//oprawy wiszace
		var top = Y - lambda_y;
		/* lewa oprawa */
	 	document.getElementById('column_left').style.top = top+'px';
		/* prawa oprawa */
	 	document.getElementById('column_right').style.top = top+'px';
	}
	
}

set_lambda();
</script>
		


<?php panelShowBottom(); ?>

