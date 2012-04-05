




<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">

* {
	margin: 0;
	padding:0;
}

.draggable {
	z-index: 200;
}
.draggable img {
	border: 1px dotted #eee;
	z-index: 200;
}

.resizable {
}

.canvas-active {
	opacity: 0.8;
}

.draggable:hover {
	opacity: 0.8;
	//border: 1px dotted #ddd;
	cursor: move;
}
     .input_text {
    	height: 40px;
    	font-size:17px;
    	color: black;
    	padding: 0 0 0 0;
    	width: 100%;
    	font-family: arial;
    	margin: 3px 0 15px 0;
    }

</style>

</head>
<body onContextMenu="return false;">


<div style="width:100%; height: 120px; text-align:center; background: url('/img/bg.gif') top left; padding: 10px 0 0 0;">

	<div style="width: 809px; height: 111px; background: url('/img/toolbar.png') top left no-repeat; margin: 0 auto; text-align: left">

		<div onclick="window.open('/uploads/tmp/u<?php echo $userid ?>_saved.jpg', '_blank')" style="cursor:pointer; float:left; margin:38px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; ">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold; font-family:tahoma,sans-serif;font-size:11px">Podgląd</div>
		</div>
		<div onclick="clear_canvas()" style="cursor:pointer; float:left; margin:38px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; ">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Wyczyść</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/pdf', '_blank')" style="cursor:pointer;float:left; margin:38px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; ">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Wydrukuj</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/downloadjpg', '_blank')" style="cursor:pointer;float:left; margin:38px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; ">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Pobierz JPG</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/downloadpdf', '_blank')" style="cursor:pointer;float:left; margin:38px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; ">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Pobierz PDF</div>
		</div>
		<div onclick="window.open('/index.php/emailstemplate/send', '_blank')" style="cursor:pointer;float:left; margin:38px 0 0 38px; width: 94px; height: 34px; background: url('/img/btn.png') top left no-repeat; ">
			<div style="padding:8px 4px 0 0; text-align:center; color:#67806E;font-weight:bold;font-family:tahoma,sans-serif;font-size:11px">Wyślij email</div>
		</div>

		
		<div style="clear: both"></div>
	</div>
</div>
<div style="width: 100%; height: 4px; background: url('/img/break.png') repeat-x;"></div>


<div style="text-align: center;width:100%;margin-top:15px">
	<div style="width:1000px; height:600px; background: #fff; margin:0 auto;text-align: left">
		<div style="float:left;">
		
		<?php ob_start(); ?>

		<div style="width:688px; height: 488px; background: url('/uploads/tmp/u1bg.jpg') no-repeat;"></div>
		
		
			<?php 
				$content = ob_get_clean();
				echo divShadow(700, 500, $content,0) ?>
			
		</div>
		<div style="float:left;">
		
		<?php ob_start(); ?>


		
		
			<?php 
				$content = ob_get_clean();
				echo divShadow(300, 500, $content) ?>
		</div>
		<div style="clear:both"></div>
	</div>
</div>

<!-- FOOTER -->
<div style="background: #67806E; width:100%;height:150px;border-top:2px solid #674A3E">
<div style="padding:60px 40px 0 40px">
	<a href="#" title="" style="font-size:15px;font-family:tahoma,sans-serif; color:#fff;text-decoration: none; margin-right: 15px" onmouseover="this.style.borderBottom='1px dotted #fff'" onmouseout="this.style.borderBottom='none'">link1</a>
</div>
</div>


<!-- kuler base color #cdcdcd ! -->

<div style="width:100%; text-align:center;">
<div style="margin:0 auto; width:1000px; height:600px; background: #674A3E; border-right:1px solid #67806e;  border-left:1px solid #67806e;  border-bottom:1px solid #67806e; ">

	<div style="float: left; width: 700px;text-align: left;">
		
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="658" valign="top">
					
					<div style="margin: 25px 0 0 25px; width: 658px; height: 548px; background: white;border:1px solid #67806e">
						<div style="padding:10px">
								<!-- LEFT CONTENT -->
								dsfksldfsldf			
						</div>		
					</div>
					
					<div style="margin: 0 0 0 25px;background: url('/img/shadow_down650.png') left top no-repeat; width:650px; height: 7px;" ></div>		
				</td>
					<td width="7" valign="top">
						<div style="margin: 25px 0 0 0;background: url('/img/shadow_right557.png') left top no-repeat; width:7px; height: 557px;"></div>
				</td>
			</tr>
		</table>		
		
		
	</div>
	
	
	<div style="float: left; width: 300px;text-align: left; ">
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="263" valign="top">
					<div style="margin: 25px 0 0 10px; width: 263px; height: 548px; background: white;;border:1px solid #67806e">
						<div style="padding:10px">
							<!-- RIGHT CONTENT -->
							
									Blah, blah ...
						</div>
					</div>
					<div style="margin: 0 0 0 10px;background: url('/img/shadow_down250.png') left top no-repeat; width:250px; height: 7px;" ></div>		
				</td>
					<td width="7" valign="top">
						<div style="margin: 25px 0 0 0;background: url('/img/shadow_right557.png') left top no-repeat; width:7px; height: 557px;"></div>
				</td>
			</tr>
		</table>
	</div>
	
			
	<div style="clear:both"></div>
</div>
</div>



<!-- 
<div style="width: 100%; text-align: center">
	<div style="margin:0 auto; width: 736px; height: 76px; background: url('/img/menu_bg.png') left top no-repeat;">
		<div style="height: 76px; width:10px;float:left"></div>

		
		<div title="Menu1" onclick="alert('menu1')"  onmouseover="this.style.color='#6e6e6e'" onmouseout="this.style.color='#726767'"  style="float: left; margin-top:6px; height: 53px; color: #726767; font-size: 18px; font-family: verdana,tahoma,sans-serif; cursor: pointer;">
			<div style="padding: 24px 10px 0 10px;">Menu1</div>
		</div>
		
		<div title="Menu2" onclick="alert('menu2')" onmouseover="this.style.color='#6e6e6e'" onmouseout="this.style.color='#929292'"  style="float: left; height: 76px; color: #929292; font-size: 18px; font-family: verdana,tahoma,sans-serif; cursor: pointer;">
			<div style="padding: 30px 10px 0 10px;">Menu2</div>
		</div>

		
		<div style="height: 76px; width:10px;float:left"></div>
		<div style="clear: both;"></div>
	</div>
</div>
 -->


	<div style="width: 100%; text-align: center">
		<div style="margin: 0 auto; width: 1000px; text-align: left">




			<div style="float: left; width: 200px; text-align: left;">
				<div style="padding: 0 10px">
	
				Element
				<ol>
					<li><a href="javascript:invert()">odwróć</a></li>
					<li><a href="javascript:del_canvas_prod()">usun aktywny obiekt</a></li>
					<!-- 
					<li><a href="javascript:on_top()">na gore</a></li>
					 -->
				</ol>
	<!-- 
				Tlo				
				<ol>
					<li><a href="javascript:show_prods()">zapisz JPG</a></li>
					<li><a href="/index.php/emailstemplate/pdf" target="_blank">zapisz PDF</a></li>
					<li><a href="javascript:clear_canvas()">wyczysc</a></li>
					<li><a href="/index.php/emailstemplate/pdf" target="_blank">wydrukuj</a></li>
				</ol>	
				
				Pobierz				
				<ol>
					<li><a href="/index.php/emailstemplate/downloadjpg" target="_blank">JPG</a></li>
					<li><a href="/index.php/emailstemplate/downloadpdf" target="_blank">PDF</a></li>
				</ol>	
				
				<a href="/index.php/emailstemplate/send" target="_blank">wyslij email</a><br>
				<a href="/uploads/tmp/u<?php echo $userid ?>_saved.jpg" target="_blank">podglad</a>
	 -->

				</div>
			</div>
			<div style="float: left; width: 600px; text-align: left;">
				<div style="padding: 0 10px">
					
					Obszar roboczy
					<div id="canvas" oncontextmenu="return onContextMenu('main')"
						style="position: relative; text-align: left; z-index: 100; width: 570px; background: url('/uploads/tmp/<?php echo $bg ?>') top left no-repeat; border: 1px solid red; height: 419px;margin-bottom: 20px"></div>
						
						
					<form enctype="multipart/form-data" name="form" method="post" action="/index.php/emailstemplate/uploadBg">
					<table width="100%"><tr><td width="50%"><input class="input_text" style="width:20%" type="file" name="file"></td><td width="50%"><?php showSubmit('Dodaj t�o', 'grey'); ?></td></tr></table>
					</form>
	

				</div>
			</div>
			<div style="float: left; width: 200px; text-align: left;">
				<div style="padding:0 10px">

					Lista elementów
					<div id="list-items"
						style="position: relative; border: 1px solid blue; height: 419px; text-align: center; overflow: auto;margin-bottom: 20px">
						
						<?php 
						
						foreach ($items as $filename) {
							
							echo '
							<div class="draggable" title="Przeciagnij obrazek na zdjecie obok"
								id="parent-prod3" style="margin-bottom: 10px">
								<img id="prod3" src="/uploads/tmp/'.$filename.'">
							</div>
							';
						}//foreach
						
						
						?>
						
					</div>
					<?php showButton('Nowy element', "location.href='/index.php/emailstemplate/choose_item'", 'grey') ?>


				</div>
			</div>
			<div style="clear: both"></div>


		</div>
	</div>
	
 
 	<?php 
 		$aLinks = array();
 		$aLinks[] = contextMenuLink('Usuń obrazek','del_canvas_prod();hideContextMenu()');
 		$aLinks[] = contextMenuLink('Odwróć', "invert();hideContextMenu()");
 		$aLinks[] = contextMenuLink('Przesuń na górę', 'on_top();hideContextMenu()');
 		
		showContextMenu($aLinks, 'contextMenu');
		 	
 		$aLinks = array();
 		$aLinks[] = contextMenuLink('Zapisz obrazek','show_prods();hideContextMenu()');
 		$aLinks[] = contextMenuLink('Zapisz jako pdf', "window.open('/index.php/emailstemplate/pdf');hideContextMenu()");
 		$aLinks[] = contextMenuLink('Wyczyść', 'clear_canvas();hideContextMenu()');
 		
		showContextMenu($aLinks, 'contextMenuMain'); 	
 	?>

				









<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/ui.draggable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.droppable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.resizable.min.js" type="text/javascript"></script>
<script src="/javascript/json.js" type="text/javascript"></script>

	<script type="text/javascript">
        $(document).ready(function() {
            
            $(".draggable").draggable({ hoverClass: "product-active", revert: "invalid", cursor: 'move', opacity: 0.35, addClasses: false, helper: 'clone', containment: "document" /*, containment: 'window', helper: 'clone',  stack: "#canvas" */ });
            
            
            $("#parent_prod6").draggable({hoverClass: "product-active", cursor: 'move', opacity: 0.35, addClasses: false,containment: '#canvas'});
            
            
            //$(".resizable").resizable({ aspectRatio: true, autoHide: true, ghost: true });
            //$("div#canvas > div > img").resizable({ aspectRatio: true, autoHide: true, ghost: true });
            
            $("#canvas").droppable({
              accept: "#list-items div",
              hoverClass: "canvas-active",
              drop: function(event, ui) { 
                 var dragObject = ui.draggable;
                 addItem( dragObject );
                 
//                 alert(dragObject.attr('id').children().attr('id'))
                 
                 //zalozenie rekordu
                 var id = prodId+'canvas-'+dragObject.attr('id');
                 products[id] = new Array();
                 products[id][0] = dragObject.children().attr('src'); //src
                 products[id][1] = lastXY; //x
                 products[id][2] = lastXY; //y
                 products[id][3] = 0; //image width - 0 = oryginal
                 products[id][4] = 0; //image height - 0 = oryginal
                 products[id][5] = 'norm'; //czy obrazek jest normalny czy odbicie lustrzane 
                 
                 lastXY += 20;
                 prodId ++;
              }
            });
            
            
            
         });
         
         var products = new Array();
         var currCanvasId = null;
         var currZIndex = 200;
         var lastXY = 0;
         var prodId = 1;
         
         function addItem( item ) {


            //item.addClass('resizable');    
            var clone = item.clone();
            //clone.addClass('resizable');    
        	  //alert(clone);
        	  
        	  
        	  
            clone.css('position', 'absolute');
            clone.css('top', lastXY+'px');
            clone.css('left', lastXY+'px');
            clone.appendTo($("#canvas"));
            
            clone.attr('title', 'mozesz przesuwac obiekt, oraz zmieniac rozmiar lapiac za prawy dolny rog');
                
            //zmiana id clonowanego obiektu
            clone.attr('id', prodId+'canvas-'+clone.attr('id'));
            clone.children().attr('id', 'canvas-'+clone.children().attr('id'));


            //dziala w FF - rightclick
            clone.attr('oncontextmenu', 'return onContextMenu()');
            
            //document.getElementById(clone.attr('id')).onMouseDown = function(){return false}
            
            //dziala w IE - rightclick
						clone.mousedown(function(event, ui){
							checkRightClickIE(event);
						});	
            
            clone.draggable({
                hoverClass: "product-active", 
                cursor: 'move', 
                opacity: 0.35, 
                addClasses: false,
                containment: '#canvas', 
                drag: function (event, ui) {
                    //zapisanie aktualnego id
                    utilSetCurrentItem(clone.attr('id'));
                },
                stop: function (event, ui) {
                    var id = clone.attr('id');
                    //zapisanie aktualnego id
                    utilSetCurrentItem(id);
                    
                    products[id][1] = parseInt(ui.position.left); //x
                    products[id][2] = parseInt(ui.position.top); //y;
                }       
            });

            //clone.children().resizable({containment: '#canvas'});

            //clone.resizable({: false,containment: '#canvas'});
           clone.children().resizable({containment: '#canvas', aspectRatio: true, 
               stop: function(event, ui){ 

            	   	 var id = clone.attr('id');
                   
                   products[id][3] = parseInt(ui.size.width); //current width
                   products[id][4] = parseInt(ui.size.height); //current height;
           }});
            
            clone.click(function (event, ui) {
              //alert('kliknieto w obiekt...')  
            	 //zapisanie aktualnego id
                utilSetCurrentItem(clone.attr('id'));
            });
            
         }//addItem
  
  
         function show_prods() {
              $.post("/index.php/emailstemplate/ajax_save_image/", { products: array2json(products) },
               function(data) {
                    if (data == 'ok') {
                       //ok 
                    }
               });
         }
         
         function del_canvas_prod() {
              $('#'+currCanvasId).remove();
              //usuniecie z tablicy obiektu
              //products[currCanvasId][0] = '';

              products = unset(products, currCanvasId);
         }


         /**
          * usuwa z w tablicy element o podanym id
          * @return array
          */
         function unset(arr, key) {
					 tmp = new Array();

		       for(var i in arr) {
           		if(i == key) {
               		continue;
           		} 		 	 
              tmp[i] = arr[i];   
           }

						return tmp;	         
         }

         
         
         function on_top() {
              currZIndex += 100;
              $('#'+currCanvasId).css('z-index', currZIndex);
         }
         
         function clear_canvas() {
              $('#canvas > .draggable').remove();
              products = new Array();
         }
         
         
         
         function foreach() {
            var names = ["Chris", "Kate", "Steve"];
            //var names = {'a':"Chris", 'b':"Kate", 'c':"Steve"};
            var names = products;
            
            for(var i in names) {
                alert(i+'->'+names[i]);
            }
         }



         function checkRightClickIE(e) {
        		if (checkRightClick(e)) {
							//document.getElementById('message').innerHTML += ' +rightclick';
							onContextMenu()
        		}		
        	}    

         function checkRightClick(e) {
        		var rightclick;
        		if (!e) var e = window.event;
        		if (e.which) rightclick = (e.which == 3);
        		else if (e.button) rightclick = (e.button == 2);

        		if (rightclick) {
							//document.getElementById('message').innerHTML += ' +rightclick';
							//onContextMenu(e)
        		}		
        		return rightclick;

        		//alert('Rightclick: ' + rightclick); // true or false
        	}    




         /*
          * Funkcja pomocnicza - ustawienie aktualnego obiektu w canvas-ie
          * 
          */
         function utilSetCurrentItem(id) {
        	 currCanvasId = id;
         }

         
         /*
          * Funkcja pomocnicza
          * 
          */
         function utilSetProductsImg(currCanvasId, obj) {
           var i = currCanvasId;
             
					 //jest img normalne, zamien na inv -> po zmianie wylot
        	 if(products[i][5] == 'norm') {
							products[i][5] = 'inv';
							products[i][0] = '/img/tree1_inv.png'; 
							obj.attr('src', '/img/tree1_inv.png');
							return true;
					 }
			 
					 //jest img inv, zamien na normalne
					 products[i][5] = 'norm';
					 products[i][0] = '/img/tree1.png'; 
					 obj.attr('src', '/img/tree1.png')
					 return true;
         }
         
         
function invert() {
	
	//dla kazdego objketu potomengo szukamy img
	$('#'+currCanvasId).children().each(function(){
		$(this).children().each(function(){
				if (typeof($(this).attr('id')) != 'undefined' && $(this).attr('id') != '') {

					//ustawienie odpowiednich danych dla obrazka
					utilSetProductsImg(currCanvasId, $(this));
				}
		})
	})
	
}

         

function array2json(arr) {
    var parts = [];
    var is_list = (Object.prototype.toString.apply(arr) === '[object Array]');

    for(var key in arr) {
    	var value = arr[key];
        if(typeof value == "object") { //Custom handling for arrays
            if(is_list) parts.push(array2json(value)); /* :RECURSION: */
            else parts[key] = array2json(value); /* :RECURSION: */
        } else {
            var str = "";
            if(!is_list) str = '"' + key + '":';

            //Custom handling for multiple data types
            if(typeof value == "number") str += value; //Numbers
            else if(value === false) str += 'false'; //The booleans
            else if(value === true) str += 'true';
            else str += '"' + value + '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Functions?)

            parts.push(str);
        }
    }
    var json = parts.join(",");
    
    if(is_list) return '[' + json + ']';//Return numerical JSON
    return '{' + json + '}';//Return associative JSON
}

function hideContextMenu() {
	$('#contextMenu').hide();
	$('#contextMenuMain').hide();
	globalWasRightClick = false;
}

function onContextMenu( mode ) {

		if (mode == 'main') {
	    $('#contextMenuMain').fadeIn(50);
			return false;
		}
	
    $('#contextMenu').fadeIn(50);
    globalWasRightClick = true;
    return false;
}


var globalWasRightClick = false;

$(document).bind('mousedown',function(e){ 
    //$("#message").text("e.pageX: " + e.pageX + ", e.pageY: " + e.pageY);
    //$('#contextMenu').css('top', e.pageY);
    //$('#contextMenu').css('left', e.pageX);
    
    //jesli nie kliknieto prawym przyciskiem myszy - to ustawiaj pozycje menu 
    if (checkRightClick(e)) {
	    $('#contextMenu, #contextMenuMain').css({'left':e.pageX,'top':e.pageY});
    }    
    
    //hideContextMenu();
});




    </script>
</body>
</html>