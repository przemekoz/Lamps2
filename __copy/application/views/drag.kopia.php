<html>
<head>
<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="/javascript/ui.core.min.js" type="text/javascript"></script>
<script src="/javascript/ui.draggable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.droppable.min.js" type="text/javascript"></script>
<script src="/javascript/ui.resizable.min.js" type="text/javascript"></script>
<script src="/javascript/json.js" type="text/javascript"></script>
<link
	href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"
	rel="stylesheet" type="text/css" />

<style type="text/css">
.draggable {
	border: 1px solid #eee;
	z-index: 200;
}

.resizable {
	border: 2px solid red;
}

.canvas-active {
	opacity: 0.8;
	border: 2px solid red;
}

.draggable:hover {
	opacity: 0.8;
	border: 1px solid red;
	cursor: move;
}
</style>

</head>
<body onContextMenu="return false;">




	<div style="width: 100%; text-align: center">
		<div style="margin: 0 auto; width: 80%; text-align: left">




			<div style="float: left; width: 70%; text-align: center;">
				<div style="width: 90%; margin: 0 auto; text-align: center;">

					<div id="canvas"
						style="position: relative; margin: 0 auto; text-align: left; z-index: 100; width: 570px; background: url(/img/street.jpg); border: 1px solid red; height: 419px"></div>

				</div>
			</div>
			<div style="float: left; width: 28%; text-align: center;">
				<div style="width: 90%; margin: 0 auto; text-align: left;">


					<div id="list-items"
						style="position: relative; border: 1px solid blue; height: 590px; text-align: center">

						<div class="draggable" title="Przeciagnij obrazek na zdjecie obok"
							id="parent-prod1" style="width: 150px; height: 180px;">
							<img id="prod1" src="/img/tree1.png" width="150" height="180">
						</div>
						<div class="draggable" title="Przeciagnij obrazek na zdjecie obok"
							id="parent-prod2" style="width: 150px; height: 180px;">
							<img id="prod2" src="/img/tree1.png" width="150" height="180">
						</div>
						<div class="draggable" title="Przeciagnij obrazek na zdjecie obok"
							id="parent-prod3" style="width: 150px; height: 180px;">
							<img id="prod3" src="/img/tree1.png" width="150" height="180">
						</div>
					</div>


				</div>
			</div>
			<div style="clear: both"></div>


		</div>
	</div>






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
            /*
            */
            
            clone.draggable({
                hoverClass: "product-active", 
                cursor: 'move', 
                opacity: 0.35, 
                addClasses: false,
                containment: '#canvas', 
                drag: function (event, ui) {

                    
                    //zapisanie aktualnego id
                    currCanvasId = clone.attr('id');
                },
                stop: function (event, ui) {
                    var id = clone.attr('id');
                    
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
							onContextMenu(e)
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
         
         
function invert() {
	
	//dla kazdego objketu potomengo szukamy img
	$('#'+currCanvasId).children().each(function(){
		$(this).children().each(function(){
				if (typeof($(this).attr('id')) != 'undefined' && $(this).attr('id') != '') {
					if(products[currCanvasId][5] == 'norm')
					{
						//jest img normalne, zamien na inv
						products[currCanvasId][5] = 'inv';
						$(this).attr('src', '/img/tree1_inv.png');
					}
					else
					{
						//jest img inv, zamien na normalne
						products[currCanvasId][5] = 'norm';
						$(this).attr('src', '/img/tree1.png')
					}
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
	$('#contextMenu').fadeOut();
	globalWasRightClick = false;
}



    </script>

	<a href="javascript:show_prods()">zapisz obrazek</a> |
	<a href="/index.php/emailstemplate/pdf">pdf</a> |
	<a href="javascript:del_canvas_prod()">usun aktywny obiekt</a> |
	<a href="javascript:invert()">odwróæ</a> |
	<a href="javascript:clear_canvas()">wyczysc</a> |
	<a href="javascript:foreach()">tablica obiektow</a> |
	<a href="javascript:on_top()">na gore</a>



	<div id="message"></div>


	<div id="contextMenu" style="border: 1px solid red; width: 100px; height:200px; color: black; background: #ddd; display: none; position:absolute; top:0; left:0; z-index: 1000">
		<a href="javascript:del_canvas_prod();hideContextMenu()">usun obrazek</a><br>
		<a href="javascript:invert();hideContextMenu()">odwróæ</a><br> 
		<a href="javascript:on_top();hideContextMenu()">na gore</a><br>
	</div>

</body>


<script type="text/javascript">
function onContextMenu() {

	
    $('#contextMenu').fadeIn();
    globalWasRightClick = true;
    return false;
}


var globalWasRightClick = false;

$(document).bind('mousedown',function(e){ 
    $("#message").text("e.pageX: " + e.pageX + ", e.pageY: " + e.pageY);
    //$('#contextMenu').css('top', e.pageY);
    //$('#contextMenu').css('left', e.pageX);
    
    //jesli nie kliknieto prawym przyciskiem myszy - to ustawiaj pozycje menu 
    if (checkRightClick(e)) {
	    $('#contextMenu').css({'left':e.pageX,'top':e.pageY});
    }    
    
    //hideContextMenu();
});




    </script>
</html>