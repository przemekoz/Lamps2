<style>
    .ms {
        border: 1px solid green;
        visibility: visible !important;
    }
    .mf {
        border: 1px solid red;
        visibility: visible !important;
    }
    .mn {
        visibility: hidden;
        margin: 10px 0;
    }
    input[type="button"] {
        border:2px solid;
        border-radius:5px;
        -moz-border-radius:5px;
    }
</style>


<div class="mn <?php echo $msg_css ?>"><?php echo $msg ?></div>

<?php panelshowTop('Łączenie'); ?>
	
		
	
		<?php 
		
			//dla kazdej kategorii
			foreach($list as $row) {
				
				//dla każdego elementu
				foreach ($row as $elem) {
					echo $elem.'<br>';	
				}
			} 
		
		?>
		
		


<?php panelShowBottom(); ?>

