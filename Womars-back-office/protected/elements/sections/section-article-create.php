<form action="../traitement/insert/createArticle.php" method="POST" class="createarticle-form">

    <div class="createarticle-formstate">
        <label for="state">When created, publish the article : </label>
        <input type="checkbox" name="state" id="publishState" class="createarticle-formcheckbox" value="setonline">
        <span id="publishStateInfo" class="createarticle-publishstateinfo">No</span>
    </div>

    <div class="createarticle-formimage">
        <div class="createarticle-formimagecontainer" id="formimagecontainer">
            <p>Choose an image</p>
        </div>
    </div>

    <div class="createarticle-infoform">
        <label for="title" class="formlabel">Title</label>
        <input type="text" name="title" class="forminput" placeholder="Title"/>

        <label for="author" class="formlabel">Author</label>
        <input type="text" name="author" class="forminput" placeholder="Author" />
    </div>
    <div class="createarticle-infoform">
        <label for="description" class="formlabel">Description</label>
        <textarea name="description" class="formtextarea" placeholder="Description"></textarea>
    </div>

    <div>
        <label for="article-textarea" class="formlabel">Text</label>
        <textarea name="text" class="formtextarea-text" id="article-textarea"></textarea>
    </div><br><br>

    <input type="hidden" id="hiddenImageId" name="imageid" value="empty" />
    <div id="getXHR" style="display:none;"></div>

    <input type="submit" value="Validate" name="send" id="article-send-form" class="article-button article-button-params">


    <!--<div class="test">
        <div class="wysiwyg-tools" id="wysiwyg-tools"><input type="button" value="Image" id="searchAllImages"></div>
        <input type="text" name="title" class="article-input" placeholder="Title">
        <textarea name="description" class="article-textarea" placeholder="Description"></textarea>
        <div class="article-wysiwyg"></div>
            <div class="article-wysiwyg-toolsbar">
              <input type="button" value="Image" id="button---">
            </div>
        <div class="article-wysiwyg" id="article-wysiwyg" Contenteditable="true"><div><br></div></div>
        <input type="text" name="author" class="article-input" placeholder="Author">



        <p><textarea name="text" class="article-textarea" style="display:none;" id="article-textarea"></textarea></p>
        <input type="submit" value="Validate" name="send" id="article-send-form" class="article-button">
    </div>-->

</form>

<script>

document.getElementById('formimagecontainer').addEventListener('click', function (event) {
  document.getElementById('wysiwyg-getImage').style.display = 'flex';
});

document.getElementById('exit').addEventListener('click', function (event) {
  document.getElementById('wysiwyg-getImage').style.display = "none";
});

document.getElementById('publishState').addEventListener('click', function (event) {
  if (document.getElementById('publishState').checked === false){
    document.getElementById('publishStateInfo').innerHTML = "No";
    document.getElementById('publishStateInfo').style.color = "crimson";
  } else {
    document.getElementById('publishStateInfo').innerHTML = "Yes";
    document.getElementById('publishStateInfo').style.color = "lime";
  }
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
      let getImageId = document.getElementById('xhr-imageid').innerHTML;
      let getImageName = document.getElementById('xhr-imagename').innerHTML;
      let getImageCaption = document.getElementById('xhr-imagecaption').innerHTML;
      let getImageAlt = document.getElementById('xhr-imagealt').innerHTML;
      const imageEnd = '<img class="createarticle-Image" src="../media/media/' + getImageName + '"  alt="' + getImageAlt + '" id="image-' + getImageId + '" />'
      document.getElementById('formimagecontainer').innerHTML = imageEnd;
      document.getElementById('hiddenImageId').value = getImageId;
    }
  }
  xhttp.send('id='+idSplit[1]);
}

/*
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
}*/

/*
document.getElementById('searchAllImages').addEventListener('click', function (event) {
  pasteHtmlAtCaret('<img src="../media/capture2.PNG" height="100" width="100"/>');
});*/

/*
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
}*/

</script>

<style>

.button-paging{
    width: 160px;
    height: 35px;
    background-color: #F37C26;
    color: white;
    border: 0;
    cursor: pointer;
    font-size: 16px;
    border-radius: 2px;
    transition: .25s;
}

.button-paging:hover{
    background-color: #d37029;
}









.createarticle-formimage{
    width: 100%;
    margin-bottom: 40px;
    font-size: 20px;
    color: black;
}

.createarticle-formimagecontainer{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 200px;
    height: 200px;
    background-color: #d4d4d4;
    cursor: pointer;
    margin: auto;
}







.createarticle-formstate{
    width: 100%;
    margin-bottom: 40px;
    font-size: 20px;
}

.createarticle-formcheckbox{
    width: 18px;
    height: 18px;
    cursor: pointer;
    vertical-align: middle;
}

.createarticle-publishstateinfo{
  color: crimson;
}

.createarticle-form{
    text-align: center;
}

.createarticle-infoform{
    display: inline-flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 40%;
    padding: 0 10px;
}

.formlabel{
    display: block;
    margin-bottom: 5px;
    font-size: 20px;
}

.forminput{
    margin-bottom: 30px;
    width: 100%;
    height: 35px;
    font-size: 20px;
}

.formtextarea{
    display: block;
    margin: auto;
    margin-bottom: 30px;
    width: 100%;
    height: 135px;
    font-size: 16px;
}

.formtextarea-text{
    width: 60%;
    height: 200px;
    font-size: 16px;
}

.article-button{
    width: 150px;
    height: 32px;
    font-size: 16px;
    vertical-align: middle;
    background-color: #F37C26;
    border: 0;
    border-radius: 50px;
    color: white;
    cursor: pointer;
    transition: .25s;
    margin-bottom: 50px;
}

.article-button-params{
    margin-bottom: 20px;
}

.article-button:hover{
    transform: scale(1.1,1.1);
}













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