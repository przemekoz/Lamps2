<html>
<head>
<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
    
    <style type="text/css">
         .caption {
            color: red; 
            border: 2px solid red;
            width: 70%;
        }    
        .caption:hover {
            color: black;
            border: 2px solid black;
        }
        
    </style>
    
</head>    
<body>
    

    
 <div id="overlay" style="display: none; z-index:1000; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; opacity: 0.7; filter: alpha(opacity=70); background: black;"></div>

<div id="window_all" style="z-index: 1300; position: absolute; top: 10%; width: 100%; text-align: center">

    <div style="margin: 0 auto; width: 704px; text-align: left">
        <div id="window_title" style="z-index: 1000; float:left; width: 600px; position: relative; top: 20px; color: black;"> title  title  title  title  title  title  title  title  title  title  title  title  title  title  title  title  title </div>
        <div id="window_close" style="z-index: 1000; float:left; width: 100px; position: relative; top: 20px; "><a href="javascript:hideWindow()">close</a></div>
        <div style="clear:both"></div>
        <div id="window" style="z-index: 1300; border: 1px solid red; padding: 2px; height: 10px; width: 10px; text-align: left">
            <div style="z-index: 1300; background: black; width: 100%; height: 100%; color: white"> - window - </div>
        </div>    
    </div>

</div>
    
<div style="position:relative">


    <!-- background -->
<!-- 
    <iframe width="730" height="500" style="z-index: 100; position: absolute; top: 40px; left: 10px; width:730px; height: 500px; border: 1px solid red" src="<?php echo '/views_emails/'.$tpl['id'].'/template.php' ?>"></iframe>
-->
    
    <div style="z-index: 100; position: absolute; top: 40px; left: 10px; width:730px; height: 500px; border: 1px solid red">
        <?php echo $emailTemplate ?>
    </div>
    
    
    <!-- nałożone na background -->
    <div style="z-index: 200; position: absolute; top: 40px; left: 10px; width:730px; height: 500px;">
        <a href="#s" <?php echo $header_action ?>>show</a>
        <div id="dheader" style="display:none; position: relative; top: <?php echo $header['top'] ?>px; left: <?php echo $header['left'] ?>px; ">
            <textarea id="dheader_value" name="header" style="width: 300px; height:50px"><?php echo $header_textarea ?></textarea>
            <a href="javascript:hideTextarea('dheader')">close</a>    
        </div>    
        <a href="#s" <?php echo $content_action ?>>show</a>
        <div id="dcontent" style="display:none; position: relative; top: <?php echo $content['top'] ?>px; left: <?php echo $content['left'] ?>px; ">
            <textarea id="dcontent_value" name="content" style="width: 300px; height:400px"><?php echo $content_textarea ?></textarea>
            <a href="javascript:hideTextarea('dcontent')">close</a>    
        </div>
        
        
    </div>
    
    
</div>
 

    
    <a href="javascript:showWindow('bla bla jakisik tytulik')">show window</a>    
    <a href="javascript:hideWindow()">hide window</a>    
   
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    
    
    <?php echo $select_font ?>
    <?php echo $select_size ?>
    <?php echo $select_color ?>
    
    <!--
    
    <input type="hidden" id="sel" value="">
    <div id="sel_menu" style="display:none; background: red; width: 300px; position: absolute; top:0; left:0; z-index: 900">
        <div style="padding: 2px;">
            <div onclick="selValue('1212')" style="height: 30px; background: white; margin-bottom: 1px; cursor: pointer">menu 1</div>
            <div onclick="selValue('2121')" style="height: 30px; background: white; margin-bottom: 1px; cursor: pointer">menu 2</div>
        </div>
    </div>
    
    <div id="sel_index" style="margin-left: 10px"> - wybierz menu - </div><a href="javascript:show_menu()">show menu</a>
    -->
    
    
    
    
    
    
<script type="text/javascript">
    
function selValue(value, id)
{
    var aExtraCss = value.split(':');
    $('#header').css(aExtraCss[0], aExtraCss[1]);
    
    document.getElementById('sel'+id).value = value;
    hide_menu(id);
}

function show_menu(id)
{
    var aPos = get_dom_position(document.getElementById('sel_index'+id));

    document.getElementById('sel_menu'+id).style.top = (aPos[1] + 10)+ 'px';
    document.getElementById('sel_menu'+id).style.left = (aPos[0] + 10)+ 'px';
    document.getElementById('sel_menu'+id).style.display = 'block';
}

function hide_menu(id)
{
    document.getElementById('sel_menu'+id).style.display = 'none';
}
    
function get_dom_position(obj)
{
    var curleft = curtop = 0;
    if (obj.offsetParent) {
        do {
            curleft += obj.offsetLeft;
            curtop += obj.offsetTop;
        } while (obj = obj.offsetParent);
    }

    return [curleft,curtop];
}
    
    
    
    
    
function showTextarea(id)
{
    document.getElementById(id).style.display = 'block';
}

function hideTextarea(id)
{
    document.getElementById(id).style.display = 'none';
   
   var val = document.getElementById(id+'_value').value;
   $.post("/index.php/emailstemplate/ajax_set_preview/"+id, { value: val },
   function(data) {
        if (data == 'ok') {
           location.reload(true); 
        }
   });
    
}


function hideWindow(title) 
{
    $('#window_title').css('top', '20px');
    $('#window_close').css('top', '20px');
    $('#window').hide();
    $('#window_all').hide();
    $('#overlay').hide();

}
function showWindow(title) 
{
    $('#overlay').show();
    $('#window_all').show();
    $('#window').css('width', '10px');
    $('#window').css('height', '10px');
    $('#window').show();
    
    $('#window').animate({
    width: '350',
    height: '250'
  }, 100, function() {
    // Animation complete.
    
        $('#window').animate({
        width: '700',
        height: '500'
      }, 190, function() {
        // Animation complete.
           
    
              $('#window_title').text(title);
              $('#window_title').animate({ top: '0' }, 320, function() {
                // Animation complete.

                  $('#window_close').animate({ top: '0' }, 320, function() {
                    // Animation complete.

                  }).delay(200);
              }).delay(200);
           
          });
      });
  
  
  

  
}



</script>
    
    
</body>
</html>