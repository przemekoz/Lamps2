    Wybrana opcja kolumna <?php echo $id_column ?>
    Wybrana opcja korona <?php echo $id_crown ?>
    Wybrana opcja oprawa <?php echo $id_fitting ?>
<form name="form" method="post" action="/index.php/<?php echo $url ?>/save/">
    
    id kolumny: <input type="text" name="id_column" value="<?php echo $id_column ?>">
    id korony: <input type="text" name="id_crown" value="<?php echo $id_crown ?>">
    id oprawy: <input type="text" name="id_fitting" value="0">

    <input type="submit" value="zapisz">
</form>
    
    
  <ol>
<?php foreach($list->result() as $row): ?>
    <li><?php echo $row->title ?> <?php if(is_file($dir.'fitting_'.$row->id.'.png')) echo '<img src="'.$dir_relative.'/fitting_'.$row->id.'.png'.'" style="max-width: 100px; max-height: 150px">'; ?> <a href="javascript:chooseFitting('<?php echo $row->id ?>')" >wybierz</a></li>
<?php endforeach; ?>
</ol>  
    
    
    
        <script type="text/javascript">
    
    
    
    
    function chooseFitting(id)
    {
        document.form.id_fitting.value = id;
    }
    
    </script>    