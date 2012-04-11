<style>
    input[type="button"] {
        border:2px solid;
        border-radius:5px;
        -moz-border-radius:5px;
    }
</style>


<?php panelshowTop('Defioniowanie dodatkowych parametrów łączenia koron z oprawami'); ?>
	



	<div style="width: 1000px; text-align: center;">
		<div id="canvas" style="width: <?php echo $X ?>px; height: <?php echo ($B+$Y) ?>px; margin: 0 auto; position: relative; text-align:center; background: grey">


		
			<div id="fitting_left" style="position:absolute; left:<?php echo $K ?>; top:<?php echo $LAMBDA_Y ?>; width:<?php echo $A ?>px; height:<?php echo $B ?>px; background:red"></div>
			<div id="fitting_right" style="position:absolute; left:<?php echo $N ?>; top:<?php echo $LAMBDA_Y ?>; width:<?php echo $A ?>px; height:<?php echo $B ?>px; background:red"></div>
			
			<div id="crown" style=" position:relative; margin:0 auto; left:0; top:<?php echo $B ?>; width: <?php echo $X ?>px; height: <?php echo $Y ?>px; background: green"></div>
		
		</div>
	</div>
<form name="form">
<?php echo form_input('lambda_x', $LAMBDA_X) ?>

<a href="javascript:void(0)" onclick="set_lambda()">ustaw</a>
</form>

<script>

var X = <?php echo $X?>;
var X1 = <?php echo $X?>;
var A = <?php echo $A?>;
var K = <?php echo $K?>;
var N = <?php echo $N?>;

function set_lambda() {

 	var lambda_x = form.lambda_x.value;
 	
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
 	document.getElementById('fitting_left').style.left = K+'px';
	/* prawa oprawa */
 	document.getElementById('fitting_right').style.left = N+'px';
}

</script>
		


<?php panelShowBottom(); ?>

