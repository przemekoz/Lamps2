<html> <head> <script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script> <script src="/javascript/ui.core.min.js" type="text/javascript"></script> <script src="/javascript/ui.draggable.min.js" type="text/javascript"></script> <script src="/javascript/ui.droppable.min.js" type="text/javascript"></script> <script src="/javascript/ui.resizable.min.js" type="text/javascript"></script> <script src="/javascript/json.js" type="text/javascript"></script> <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>      <style type="text/css">      .draggable {         border: 1px solid #eee;         z-index: 200;     }     .resizable {         border: 2px solid red;     }     .canvas-active {         opacity: 0.8;         border: 2px solid red;     }     .draggable:hover {         opacity: 0.8;         border: 1px solid red;         cursor: move;     } </style>  </head>     <body>                 <div style="width:100%; text-align: center">         <div style="margin: 0 auto; width: 80%; text-align: left">                                                                 <div style="float: left; width: 70%; text-align: center;">                 <div style="width: 90%; margin: 0 auto; text-align: center;">                                          <div id="canvas" style="position: relative; margin: 0 auto; text-align: left; z-index: 100; width: 570px; background:  url(/img/street.jpg); border: 1px solid red; height: 419px"></div>                                      </div>             </div>             <div style="float: left; width: 28%; text-align: center;">                 <div style="width: 90%; margin: 0 auto; text-align: left;">                                                               <div id="list-items" style="position: relative; border: 1px solid blue; height: 590px; text-align: center">                                                  <div class="draggable" title="Przeciagnij obrazek na zdjecie obok" id="parent-prod1" style="width: 150px; height: 180px;"><img id="prod1" src="/img/tree1.png" width="150" height="180"></div>                         <div class="draggable" title="Przeciagnij obrazek na zdjecie obok" id="parent-prod2" style="width: 150px; height: 180px;"><img id="prod2" src="/img/tree1.png" width="150" height="180"></div>                         <div class="draggable" title="Przeciagnij obrazek na zdjecie obok" id="parent-prod3" style="width: 150px; height: 180px;"><img id="prod3" src="/img/tree1.png" width="150" height="180"></div>                     </div>                                                           </div>             </div>             <div style="clear:both"></div>                                   </div>     </div>                                   <script type="text/javascript">         $(document).ready(function() {                          $(".draggable").draggable({ hoverClass: "product-active", revert: "invalid", cursor: 'move', opacity: 0.35, addClasses: false, helper: 'clone', containment: "document" });                                       $("#parent_prod6").draggable({hoverClass: "product-active", cursor: 'move', opacity: 0.35, addClasses: false,containment: '#canvas'});                                       $(".resizable").resizable({ aspectRatio: true, autoHide: true, ghost: true });             $("div#canvas > div > img").resizable({ aspectRatio: true, autoHide: true, ghost: true });                          $("#canvas").droppable({               accept: "#list-items div",               hoverClass: "canvas-active",               drop: function(event, ui) {                   var dragObject = ui.draggable;                  addItem( dragObject );                                                      var id = prodId+'canvas-'+dragObject.attr('id');                  products[id] = new Array();                  products[id][0] = dragObject.children().attr('src');                   products[id][1] = lastXY;                   products[id][2] = lastXY;                                     lastXY += 20;                  prodId ++;               }             });                       });                    var products = new Array();          var currCanvasId = null;          var currZIndex = 200;          var lastXY = 0;          var prodId = 1;                    function addItem( $item ) {                          var clone = $item.clone();             clone.css('position', 'absolute');             clone.css('top', lastXY+'px');             clone.css('left', lastXY+'px');             clone.appendTo($("#canvas"));                          clone.attr('title', 'mozesz przesuwac obiekt, oraz zmieniac rozmiar lapiac za prawy dolny rog');                                       clone.attr('id', prodId+'canvas-'+clone.attr('id'));             clone.children().attr('id', 'canvas-'+clone.children().attr('id'));                                                    clone.draggable({                 hoverClass: "product-active",                  cursor: 'move',                  opacity: 0.35,                  addClasses: false,                 containment: '#canvas',                  drag: function (event, ui) {                                                               currCanvasId = clone.attr('id');                 },                 stop: function (event, ui) {                     var id = clone.attr('id');                                          products[id][1] = parseInt(ui.position.left);                      products[id][2] = parseInt(ui.position.top);                   }                    });             clone.children().resizable({containment: '#canvas'});             clone.children().resizable({containment: '#canvas'});                          clone.click(function (event, ui) {             });                       }                                                        </script>      </body> </html>