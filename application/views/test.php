<html>


<body>

<?php ob_start(); ?>


<div>asdflsjdflksjdfsdjfskdf<br>asdflsjdflksjdfsdjfskdf<br>asdflsjdflksjdfsdjfskdf<br>asdflsjdflksjdfsdjfskdf<br></div>
<table></table>
<?php  
$content = ob_get_clean();
echo divShadow(510, 310, $content) ?>

</body>
</html>