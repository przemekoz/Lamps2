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

<?php panelshowTop('Łączenie : '.$text); ?>
	
	
<?php echo $text_src.':<br><b>'.$main->title. '&nbsp;&nbsp;|&nbsp;&nbsp;'.$main->width.'x'.$main->height ?> </b>	
	
<br><br>
Wiązanie z <?php echo $text_dst?>:	

<form name="form" action="/index.php/<?php echo $url?>/save" method="post">
<?php echo form_hidden('id', $id)?>	
<?php echo form_hidden('src', $src)?>	
<?php echo form_hidden('dst', $dst)?>	
		


<table cellpadding="2" cellspacing="2" border="0" style="font-size:13px; margin-top:5px">
<!-- 
<tr>
	<th>&nbsp;</th>
	<th>nazwa</th>
	<th>wymiary</th>
</tr>
 -->


	<?php 
		
			//dla kazdej kategorii
			foreach($list as $row) {
				
				//dla każdego elementu
				foreach ($row as $elem) {
					echo '<tr>';	
					echo $elem;	
					echo '</tr>';	
				}
			} 
		
		?>

</table>

<?php panelShowSubmitCancel($url); ?>
</form>		
		


<?php panelShowBottom(); ?>

