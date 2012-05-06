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
<form name="form" method="post" action="/konfigurator.php/<?php echo $url?>/save_params2">
<?php echo form_hidden('id_crown', $crid) ?>
<?php echo form_hidden('id_column', $cid) ?>
Przesunięcie X: <?php echo form_input('lambda_x', $LAMBDA_X) ?><br><br>

<a href="javascript:void(0)" onclick="set_lambda()">ustaw</a>

<?php panelShowSubmitCancel(); ?>
</form>
		
		</div>		
		
		<div style="width: 850px; float:left; text-align: center;">
		
		<b><?php echo $column_title ?></b>, <b><?php echo $crown_title ?></b>
		
			<div id="canvas" style="width: <?php echo $A ?>px; height: <?php echo ($B+$Y) ?>px; margin: 0 auto; position: relative; text-align:center; background: #f8f8f8; border: 1px dashed #ddd">
			
				<div id="crown" style="z-index:10; position:absolute; left:<?php echo $K ?>px; top:0px; width:<?php echo $A ?>px; height:<?php echo $B ?>px;">
					<img src="<?php echo $dir_relative?>/crown_<?php echo $crid ?>.png" width="<?php echo $A ?>" height="<?php echo $B ?>">
				</div>
				
				<div id="column" style="z-index:9; position:relative; margin:0 auto; left:0; top:<?php echo $B?>px; width: <?php echo $X ?>px; height: <?php echo $Y ?>px;">
					<img src="<?php echo $dir_relative?>/column_<?php echo $cid ?>.png" width="<?php echo $X ?>" height="<?php echo $Y ?>">
				</div>
			
			</div>
	</div>
		</div>		
		<div style="clear:both"></div>
		

<script>

var X = <?php echo $X?>;
var X1 = <?php echo $A?>;
var A = <?php echo $A?>;
var K = <?php echo $K?>;
var B = <?php echo $B?>;
var Y = <?php echo $Y?>;

function set_default() {
	form.lambda_x.value = 0;
 	set_lambda();
}

function set_lambda() {

 	var lambda_x = form.lambda_x.value;
 	
	// -------------- //
	// przesuniecie X //
	// -------------- //
	K = 0;
	X1 = A;
	
 	if (lambda_x > 0) {
 		X1 = parseInt(A) + parseInt(lambda_x); 
 		K = lambda_x;
 	}
 	else if (lambda_x < 0) {
 		X1 = parseInt(A) - parseInt(lambda_x);
 	}
	
	/* canvas */
 	document.getElementById('canvas').style.width = X1+'px';
	/* korona */
 	document.getElementById('crown').style.left = K+'px';
	
}

set_lambda();
</script>
		


<?php panelShowBottom(); ?>

