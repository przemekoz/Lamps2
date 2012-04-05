<style type="text/css">
    #password {
        display: none;
    }
   * {
   	margin: 0;
   	padding:0;
   }
    
</style>


<?php panelshowTop('Klienci - dodaj/edytuj'); ?>

<form name="form" method="post" action="/index.php/<?php echo $url ?>/save">

<input type="hidden" name="id" value="<?php echo $id; ?>">


<?php echo inputText('Nazwa uzytkownika:', 'username', $username); ?>


<div id="password">
    <br>
    Nowe haslo (aktualne: <?php if(strlen($old_password)) echo $old_password; ?>):
		<?php echo inputPassword('', 'password', ''); ?>
</div>
<?php showLink('Zmien haslo', "#zh", 'show_pass()') ?>



<?php panelShowSubmitCancel($url); ?>


</form>



<?php panelShowBottom(); ?>

<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/main.js" type="text/javascript"></script>
<script type="text/javascript">



function show_pass()
{
    document.getElementById('password').style.display = 'block';
}

function init()
{
    if (document.form.id.value == 0) {
        show_pass();
        document.form.change_pass.style.display = 'none';
    } else {
        document.form.change_pass.style.display = 'block';
    }
}
init();
</script>