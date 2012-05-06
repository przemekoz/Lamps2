<html>
<head>
<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>

    <script type="text/javascript">


var cronTime = 30;

var isAjaxRequest = false;

function complete(request) {
    
    switch (request.responseText) {
        case 'pack-send':
            alert('complete');
            isAjaxRequest = false;
        break;
        case 'no-email-to-send':
            alert('Brak emaili do wysłania');
            clearInterval(t);
        break;
    }
    
   $.post("/index.php/sendemails/ajax_show_progress/", { value: 'empty' },
   function(data) {
       document.getElementById('progress').innerHTML = data;
   });
}


    function send_pack() {
        
        if (isAjaxRequest == true) {
            alert('return false');
            return false;
        }
        alert('ajax request');
        isAjaxRequest = true;
        
        $.post("/index.php/sendemails/ajax_send_pack/"+cronTime, { value: 'empty' },
        function(data) {
           complete(data)
        });
       
    }

    t = null;
    function ajax_send() {
        send_pack();
        t = setInterval("send_pack()", (cronTime * 1000));
    }

    </script>
    
    <style type="text/css">
        
        #header {
            position: absolute; 
            left: 10px; top: 10px; 
            color: red; 
            border: 1px solid red;
        }    
        #header:hover {
            color: black;
            border: 2px solid black;
        }
        
    </style>
    
</head>    
<body>
    

    <a href="#a" onclick="ajax_send()">rozpocznij wysyłanie newslettera</a>


    <?php echo $link ?> 

    
    
    Progres:
    <div style="width:200px; height:50px; border:1px solid red;"><div id="progress"></div></div>
    

    <p><br />Page rendered in {elapsed_time} seconds</p>
    <p><br />Memory usage {memory_usage} </p>
    
    
    
    
    
    <div id="dropbox" style="width:200px; height: 100px; border: 1px solid black">DROP HERE</div>
    
    <input type="file" id="fileElem" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)">
    <a href="#" id="fileSelect">Select some files</a> 
    <div id="fileList">
      <p>No files selected!</p>
    </div>
    
    
    Bag:
    <div id="bag"></div>

    
    
    <a href="javascript:upload()">Upload!</a>    
    
    
    
    <div style="position:relative; background: url(/img/email_bg.gif); width: 809px; height: 607px">
        <div id="theader" style="display: none; height: 90px; width: 150px; left: 200px; top: 30px; position: absolute;">
            <textarea name="header"  ></textarea><a href="javascript:hideTextarea('theader')">X</a>            
        </div>
        
        <div id="header" onclick="showTextarea('theader');">insert here header</div>
    </div>
        
    
    
    
    
    
<script type="text/javascript">
    
function showTextarea(id)
{
    document.getElementById(id).style.display = 'block';
}

function hideTextarea(id)
{
    document.getElementById(id).style.display = 'none';
}


var dropbox;
function init() {
    window.addEventListener("dragenter", dragenter, true);
    dropbox = document.getElementById("dropbox");
    window.addEventListener("dragleave", dragleave, true);
    dropbox.addEventListener("dragover", dragover, true);
    dropbox.addEventListener("drop", drop, true);
}

function dragenter(e) {
    dropbox.setAttribute("dragenter", true);
}

function dragleave(e) {
    dropbox.removeAttribute("dragenter");
}

function dragover(e) {
    e.preventDefault();
}

function drop(e) {
    var dt = e.dataTransfer;
    var files = dt.files;

    e.preventDefault();

    if (files.length == 0) {
        handleData(dt);
        return;
    }

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        handleFile(file);
    }
}

function handleData(dt) {
    var bag = document.getElementById("bag");

    var txt = "";
    for (var i = 0; i < dt.types.length; i++) {
        txt += i + " (" + dt.types[i] + ") : " + dt.getData(dt.types[i]);
        txt += "\n";
    }

    function newUrl(url) {
        var div = document.createElement("div");
        var iframe = document.createElement("iframe");
        iframe.src = url;
        div.appendChild(iframe);
        bag.insertBefore(div, bag.firstChild);
    }

    function newImage(url) {
        var img = document.createElement("img");
        img.src = url;
        bag.insertBefore(img, bag.firstChild);
    }

    function newText(txt) {
        var p = document.createElement("p");
        p.appendChild(document.createTextNode(txt));
        bag.insertBefore(p, bag.firstChild);
    }

    // browser tab
    var type0 = "application/x-moz-tabbrowser-tab";
    var type1 = "text/x-moz-text-internal";
    if (dt.types.contains(type0)) {
        newUrl(dt.getData(type1));
        return true;
    }
    // Remote image
    var type = "application/x-moz-file-promise-url";
    if (dt.types.contains(type)) {
        newImage(dt.getData(type));
        return true;
    }
    // link && bookmarks
    var type = "text/x-moz-url";
    if (dt.types.contains(type)) {
        var url = dt.getData("text/x-moz-url-data");
        if (!url) newUrl(dt.getData("text/plain"));
        if (url) {
            newUrl(url);
            return true;
        }
    }

    // Plain text
    var txt = dt.getData("text/plain");
    if (txt) {
        newText(txt);
        return true;
    }
    return false;
}

var uploadFile = null;

function handleFile(file) {
    var imageType = /image.*/;
    var videoType = /video.*/;
    var audioType = /audio/;
    var textType = /text.*/;

    var bag = document.getElementById("bag");

    if (!file.type.match(imageType) &&
        !file.type.match(videoType) &&
        !file.type.match(audioType) &&
        !file.type.match(textType)) {
        return false;
    }

    if(file.type.match(imageType)) {
        
        //test
        uploadFile = file;
        
        var img = document.createElement("img");
        var reader = new FileReader();
        reader.onloadend = function() {
            img.src = reader.result;
        }
        reader.readAsDataURL(file);
        img.classList.add("obj");
        bag.insertBefore(img, bag.firstChild);
    }

    if(file.type.match(videoType)) {
        var video = document.createElement("video");
        video.setAttribute("autoplay", true);
        video.setAttribute("controls", true);
        var reader = new FileReader();
        reader.onloadend = function() {
            video.src = reader.result;
        }
        reader.readAsDataURL(file);
        video.classList.add("obj");
        bag.insertBefore(video, bag.firstChild);
    }

    if(file.type.match(audioType)) {
        var audio = document.createElement("audio");
        audio.setAttribute("autoplay", true);
        audio.setAttribute("controls", true);
        var reader = new FileReader();
        reader.onloadend = function() {
            audio.src = reader.result;
        }
        reader.readAsDataURL(file);
        audio.classList.add("obj");
        bag.insertBefore(audio, bag.firstChild);
    }

    if(file.type.match(textType)) {
        var txt = document.createElement("textarea");
        txt.cols = 35;
        txt.rows = 15;
        var reader = new FileReader();
        reader.onloadend = function() {
            txt.value = reader.result;
        }
        reader.readAsText(file);
        txt.classList.add("obj");
        bag.insertBefore(txt, bag.firstChild);
    }

    return true;
}

window.addEventListener("load", init, true);

function upload()
{
//  var imgs = document.querySelectorAll(".obj");
//  
//  for (var i = 0; i < imgs.length; i++) {
//    new FileUpload(imgs[i], imgs[i].file);
//  }
  textFileUpload(uploadFile);
  
    //imgFileUpload(img, uploadFile);
}


function FileUpload(img, file) {
  var reader = new FileReader();  
  this.ctrl = createThrobber(img);
  var xhr = new XMLHttpRequest();
  this.xhr = xhr;
  
  var self = this;
  this.xhr.upload.addEventListener("progress", function(e) {
        if (e.lengthComputable) {
          var percentage = Math.round((e.loaded * 100) / e.total);
          self.ctrl.update(percentage);
        }
      }, false);
  
  xhr.upload.addEventListener("load", function(e){
          self.ctrl.update(100);
          var canvas = self.ctrl.ctx.canvas;
          canvas.parentNode.removeChild(canvas);
      }, false);
  xhr.open("POST", "http://mss/index.php/sendemails/upload/");
  xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
  reader.onload = function(evt) {
    xhr.sendAsBinary(evt.target.result);
  };
  reader.readAsBinaryString(file);
}


function textFileUpload(file) {
  // Please report improvements to: marco.buratto at tiscali.it
  
  var fileName = file.name,
    fileSize = file.size,
    fileData = file.getAsBinary(), // works on TEXT data ONLY.
    boundary = "xxxxxxxxx",
    uri = "http://mss/index.php/sendemails/upload/",
    xhr = new XMLHttpRequest();
  
  xhr.open("POST", uri, true);
  xhr.setRequestHeader("Content-Type", "multipart/form-data, boundary="+boundary); // simulate a file MIME POST request.
  xhr.setRequestHeader("Content-Length", fileSize);
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      if ((xhr.status >= 200 && xhr.status <= 200) || xhr.status == 304) {
        
        if (xhr.responseText != "") {
          alert(xhr.responseText); // display response.
        }
      }
    }
  }
  
  var body = "--" + boundary + "\r\n";
  body += "Content-Disposition: form-data; name='fileId'; filename='" + fileName + "'\r\n";
  //body += "Content-Type: application/octet-stream\r\n\r\n";
  body += "Content-Type: image/gif\r\n\r\n";
  body += fileData + "\r\n";
  body += "--" + boundary + "--";
  
  xhr.send(body);
  return true;
}



function upload2()
{
    var boundary = 'xxxxxxxxxx';
    var xhr = new XMLHttpRequest;

    xhr.open("POST", "http://mss/index.php/sendemails/upload/", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            alert(xhr.responseText);
        }
    };
    var contentType = "multipart/form-data; boundary=" + boundary;
    xhr.setRequestHeader("Content-Type", contentType);

    for (var header in this.headers) {
        xhr.setRequestHeader(header, headers[header]);
    }

    // here's our data variable that we talked about earlier
    var data = this.buildMessage(this.elements, boundary);

    // finally send the request as binary data
    xhr.sendAsBinary(data);
}

    
</script>
    
    
</body>
</html>