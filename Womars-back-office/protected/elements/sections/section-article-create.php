<form action="../traitement/insert/createArticle.php" method="POST">
    <div class="test">
        <div class="wysiwyg-tools" id="wysiwyg-tools"><input type="button" value="Image" id="searchAllImages"></div>
        <input type="text" name="title" class="article-input" placeholder="Title">
        <textarea name="description" class="article-textarea" placeholder="Description"></textarea>
        <!--<div class="article-wysiwyg"></div>
            <div class="article-wysiwyg-toolsbar">
              <input type="button" value="Image" id="button---">
            </div>-->
        <div class="article-wysiwyg" id="article-wysiwyg" Contenteditable="true"><div><br></div></div>
        <input type="text" name="author" class="article-input" placeholder="Author">



        <p><textarea name="text" class="article-textarea" style="display:none;" id="article-textarea"></textarea></p>
        <input type="submit" value="Validate" name="send" id="article-send-form" class="article-button">
        <div id="getXHR" style="display:none;"></div>
    </div>
</form>

<script>

document.getElementById('Page-div-title-panel').innerHTML = "Create article";

document.getElementById('article-wysiwyg').addEventListener('keyup', function (event) {
  getCaretCoordinates()
});

document.getElementById('article-wysiwyg').addEventListener('click', function (event) {
  getCaretCoordinates()
});

function getCaretCoordinates() {
  let x = 0;
  let y = 0;
  if (typeof window.getSelection !== "undefined") {
    if (window.getSelection().rangeCount !== 0) {
      window.getSelection().getRangeAt(0).cloneRange().collapse(true);
      if (window.getSelection().getRangeAt(0).cloneRange().getClientRects()[0]) {
        x = window.getSelection().getRangeAt(0).cloneRange().getClientRects()[0].left;
        y = window.getSelection().getRangeAt(0).cloneRange().getClientRects()[0].top;
        divappear(x, y);
      } else {
        document.getElementById('wysiwyg-tools').setAttribute("style", "display: none;");
      }
    }
  }
}

function divappear(x, y){
  let windowScroll = window.pageYOffset;
  console.log(windowScroll);
  document.getElementById('wysiwyg-tools').setAttribute("style", "display:flex;left: " + (x - 45) + "px;top:" + (y - 34 + windowScroll) + "px;");
}

/*
document.getElementById('searchAllImages').addEventListener('click', function (event) {
  pasteHtmlAtCaret('<img src="../media/capture2.PNG" height="100" width="100"/>');
});
*/

function pasteHtmlAtCaret(image) {
    var sel, range;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();

            var el = document.createElement("div");
            el.innerHTML = image;
            var frag = document.createDocumentFragment(), node, lastNode;
            while ( (node = el.firstChild) ) {
                lastNode = frag.appendChild(node);
            }
            range.insertNode(frag);
            
            if (lastNode) {
                range = range.cloneRange();
                range.setStartAfter(lastNode);
                range.collapse(true);
                sel.removeAllRanges();
                sel.addRange(range);
            }
        }
    } else if (document.selection && document.selection.type != "Control") {
        document.selection.createRange().pasteHTML(image);
    }
}

document.getElementById('searchAllImages').addEventListener('click', function (event) {
  document.getElementById('wysiwyg-getImage').style.display = "flex";
});

document.getElementById('exit').addEventListener('click', function (event) {
  document.getElementById('wysiwyg-getImage').style.display = "none";
});

function selectedImage(imageId){
  const idSplit = imageId.id.split('-');
  document.getElementById('wysiwyg-getImage').style.display = "none";

  let xhttp = new XMLHttpRequest();
  xhttp.open('POST', 'xhr/post-id-articlecreate.php', true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById('getXHR').innerHTML = xhttp.responseText;
      getImageId = document.getElementById('xhr-imageid').innerHTML;
      getImageName = document.getElementById('xhr-imagename').innerHTML;
      getImageCaption = document.getElementById('xhr-imagecaption').innerHTML;
      getImageAlt = document.getElementById('xhr-imagealt').innerHTML;
      let image = '<img src="../media/' + getImageName + '"  alt="' + getImageAlt + '" height="100" width="100"/>'
      pasteHtmlAtCaret(image);
    }
  }

  xhttp.send('id='+idSplit[1]);
}

/*
let a;
let imageNumber = 0;

document.getElementById('article-wysiwyg').addEventListener('keyup', function (event) {
  a = window.getSelection().focusOffset;
  console.log(a);
});

document.getElementById('article-wysiwyg').addEventListener('keydown', function (event) {
  if(event.which === 8 || event.keyCode === 8) {
    if (window.getSelection().anchorNode.parentNode.id === "wysiwyg-subdiv_0" && a === 0){
      alert();
    }
  }
});

document.getElementById('article-wysiwyg').addEventListener('click', function (event) {
  if (window.getSelection().anchorNode.parentNode.id === "article-wysiwyg" && a === 0){
    document.getElementById('wysiwyg-subdiv_0').focus();
    console.log(document.activeElement);
  }
});

document.getElementById('article-wysiwyg').addEventListener('click', function (event) {
  console.log(window.getSelection().anchorNode.parentNode.id);
  a = window.getSelection().focusOffset;
});

document.getElementById('button---').addEventListener('click', function (event) {
  if (window.getSelection().anchorNode != undefined){
    let b = document.getElementById('article-wysiwyg').innerHTML;
    document.getElementById('article-wysiwyg').innerHTML = '<div id="wysiwyg-image_' + imageNumber + '">' + b.substring(0, a) + 'hey' + b.substring(a, b.length) + '</div>';
    imageNumber++;
  }
});

document.getElementById('article-wysiwyg').addEventListener('keyup', function (event) {
  if (event.key === 'Enter' || event.which === 13 || event.keyCode === 13) {
    for (let i = 0; i < document.getElementById('article-wysiwyg').childNodes.length; i++){
      if (document.getElementById('article-wysiwyg').getElementsByTagName('div')[i]){
        document.getElementById('article-wysiwyg').getElementsByTagName('div')[i].id = '';
        if (document.getElementById('article-wysiwyg').getElementsByTagName('div')[i].id === ''){
          document.getElementById('article-wysiwyg').getElementsByTagName('div')[i].id = 'wysiwyg-subdiv_' + i;
        }
      }
    }
  }
});
*/

/*
  let a;
  let c;

  document.getElementById('button---').addEventListener('click', function (event) {
    let b = document.getElementById('article-wysiwyg').innerHTML;
    //console.log(b.substring(0, a));
    document.getElementById('article-wysiwyg').innerHTML = b.substring(0, a) + 'hey' + b.substring(a, b.length);
  });

  document.getElementById('article-wysiwyg').addEventListener('keyup', function (event) {
    //console.log(window.getSelection().focusOffset);
    a = window.getSelection().focusOffset;
  });

  document.getElementById('article-wysiwyg').addEventListener('click', function (event) {
    //console.log(window.getSelection());
    //console.log(window.getSelection().focusOffset);
    a = window.getSelection().focusOffset;
    c = document.activeElement;
    console.log(c.className);
  });

  document.getElementById('article-wysiwyg').addEventListener('keyup', function (event) {
    if (event.key === 'Enter' || event.keyCode === 13) {
      for (let i = 0; i < document.getElementById('article-wysiwyg').childNodes.length; i++){
        if (document.getElementById('article-wysiwyg').getElementsByTagName('div')[i]){
          document.getElementById('article-wysiwyg').getElementsByTagName('div')[i].className = '';
          if (document.getElementById('article-wysiwyg').getElementsByTagName('div')[i].className === ''){
            document.getElementById('article-wysiwyg').getElementsByTagName('div')[i].classList.add('article-wysiwyg-content-sub-div_' + i);
            document.getElementById('article-wysiwyg').getElementsByTagName('div')[i].tabIndex = i;
          }
        }
      }
    }
  });

*/

</script>

<style>

.article-wysiwyg{
    width: 70%;
    height: 600px;
    padding: 0 5px;
    background-color: white;
    text-align: left;
    margin: auto;
    font-size: 20px;
    font-family: Montserrat-Regular, Arial, sans-serif;
    border-bottom: solid black 2px;
    color: black;
    overflow: auto;
}

.article-wysiwyg-toolsbar{
    width: 100%;
    height: 98px;
    border-bottom: 2px solid black;
}

.article-wysiwyg-content{
    /*display: inline-block;*/
    width: calc(100% - 10px);
    height: 300px;
    border: 0 5px;
    color: black;
    text-align: left;
    margin: auto;
}

.wysiwyg-tools{
  display: none;
  justify-content: center;
  align-items: center;
  position: absolute;
  height: 34px;
  width: 90px;
  background-color: #0A0623;
}

.wysiwyg-getImage{
    position: fixed; 
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
}

.wysiwyg-getImageDiv{
    width: 80%;
    height: 90vh;
    background-color: white;
    color: black;
    overflow: auto;
}
    
.parameters-exit{
    display: inline-block;
    width: 45px;
    height: 45px;
    margin-right: 30px;
    color: white;
    background-color: crimson;
    border: 0;
    cursor: pointer;
    font-size: 18px;
    transition: 0.25s;
}

.parameters-exit:hover{
    background-color: #ae0021;
}

/*///////////////////////////////*/

.createarticle-allImageContainer{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    width: 100%;
    height: auto;
}

.createarticle-containerImage{
    display: inline-block;
    width: 200px;
    height: 200px;
    border: solid black 1px;
    margin: 5px;
    background-color: #d4d4d4;
    cursor: pointer;
}

.createarticle-Image{
    height: 100%;
    width: 100%;
    object-fit: contain;
    font-size: 16px;
}

</style>