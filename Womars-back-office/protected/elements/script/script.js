// MAIN SCRIPT

let menuButtonsArray = ['Statistics', 'Articles', 'Pages', 'Media', 'Crew', 'Partners'];
let page;

if (redirectPage === 'vide'){ page = 'Statistics'; }
else { page = redirectPage }
document.getElementById('pageTitle').innerHTML = page;

for (let menuRedirect = 0; menuRedirect < document.getElementsByClassName('Menu-button').length; menuRedirect++){
  document.getElementsByClassName('Menu-button')[menuRedirect].addEventListener('click', event => {
    document.getElementById('pageTitle').innerHTML = menuButtonsArray[menuRedirect];
    SwitchContent();
  });
}

SwitchContent();

function SwitchContent(){

  for (let menuButtonNumber = 0; menuButtonNumber < document.getElementsByClassName('Menu-button').length; menuButtonNumber++){
    document.getElementsByClassName('Menu-button')[menuButtonNumber].classList.remove('Menu-button-selected');
    document.getElementsByClassName('Menu-button')[menuButtonNumber].querySelector('svg').classList.remove('color-orange');
  }

  switch (document.getElementById('pageTitle').innerHTML) {
    case 'Statistics':
      document.getElementsByClassName('Menu-button')[0].classList.add('Menu-button-selected');
      document.getElementsByClassName('Menu-button')[0].querySelector('svg').classList.add('color-orange');
      page = 'Statistics';
      break;
    case 'Articles':
      document.getElementsByClassName('Menu-button')[1].classList.add('Menu-button-selected');
      document.getElementsByClassName('Menu-button')[1].querySelector('svg').classList.add('color-orange');
      page = 'Articles';
      break;
    case 'Pages':
      document.getElementsByClassName('Menu-button')[2].classList.add('Menu-button-selected');
      document.getElementsByClassName('Menu-button')[2].querySelector('svg').classList.add('color-orange');
      page = 'Pages';
      break;
    case 'Media':
      document.getElementsByClassName('Menu-button')[3].classList.add('Menu-button-selected');
      document.getElementsByClassName('Menu-button')[3].querySelector('svg').classList.add('color-orange');
      page = 'Media';
      break;
    case 'Crew':
      document.getElementsByClassName('Menu-button')[4].classList.add('Menu-button-selected');
      document.getElementsByClassName('Menu-button')[4].querySelector('svg').classList.add('color-orange');
      page = 'Crew';
      break;
    case 'Partners':
      document.getElementsByClassName('Menu-button')[5].classList.add('Menu-button-selected');
      document.getElementsByClassName('Menu-button')[5].querySelector('svg').classList.add('color-orange');
      page = 'Partners';
      break;
    default:
      console.log('Menu color error');
  }
  ChangePageContent();
}

window.onload = function (event) {
  if (window.innerWidth >= 750){
    if (window.scrollY < 200){document.getElementById('menuDiv').style.top = 'calc(260px - '+parseInt(window.scrollY)+'px)';}
    if (window.scrollY >= 200){document.getElementById('menuDiv').style.top = '61px';}
  }
  else if (window.innerWidth < 750){
    if (window.scrollY < 100){document.getElementById('menuDiv').style.top = 'calc(160px - '+parseInt(window.scrollY)+'px)';}
    if (window.scrollY >= 100){document.getElementById('menuDiv').style.top = '61px';}
  }
};

window.onscroll = function (event) {
  if (window.innerWidth >= 750){
    if (window.scrollY < 200){document.getElementById('menuDiv').style.top = 'calc(260px - '+parseInt(window.scrollY)+'px)';}
    if (window.scrollY >= 200){document.getElementById('menuDiv').style.top = '61px';}
  }
  else if (window.innerWidth < 750){
    if (window.scrollY < 100){document.getElementById('menuDiv').style.top = 'calc(160px - '+parseInt(window.scrollY)+'px)';}
    if (window.scrollY >= 100){document.getElementById('menuDiv').style.top = '61px';}
  }
};

window.onresize = function (event) {
  if (window.innerWidth >= 750){
    if (window.scrollY < 200){document.getElementById('menuDiv').style.top = 'calc(260px - '+parseInt(window.scrollY)+'px)';}
    if (window.scrollY >= 200){document.getElementById('menuDiv').style.top = '61px';}
  }
  else if (window.innerWidth < 750){
    if (window.scrollY < 100){document.getElementById('menuDiv').style.top = 'calc(160px - '+parseInt(window.scrollY)+'px)';}
    if (window.scrollY >= 100){document.getElementById('menuDiv').style.top = '61px';}
  }
};

// MEDIA, CREW AND PARTNERS SCRIPT

function editImage(imageId){
  const getPageName = document.getElementById('pageTitle').innerHTML.toLowerCase();
  const idSplit = imageId.id.split('-');

  let xhttp = new XMLHttpRequest();
  xhttp.open('POST', 'xhr/post-id-'+getPageName+'.php', true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById('getXHR').innerHTML = xhttp.responseText;
      document.getElementById('paramsImage').style.display = 'flex';

      document.getElementById('parameters-buttonform-page').addEventListener('click', event => {
        document.getElementById('parameters-contentLeft').style.display = 'none';
        document.getElementById('imagePageChange').style.display = 'none';
        document.getElementById('imagePageChangeData').style.display = 'none';
        document.getElementById('imagePageChangePerson').style.display = 'block';
        document.getElementById('parameters-contentRight').classList.remove("parameters-contentRight");
        document.getElementById('parameters-contentRight').classList.add("parameters-contentRight-page");
        document.getElementById('parameters-buttonform-image').classList.remove("parameters-buttonform-onit");
        document.getElementById('parameters-buttonform-page').classList.add("parameters-buttonform-onit");
      });

      document.getElementById('parameters-buttonform-image').addEventListener('click', event => {
        document.getElementById('parameters-contentLeft').style.display = 'inline-flex';
        document.getElementById('imagePageChange').style.display = 'initial';
        document.getElementById('imagePageChangeData').style.display = 'initial';
        document.getElementById('imagePageChangePerson').style.display = 'none';
        document.getElementById('parameters-contentRight').classList.remove("parameters-contentRight-page");
        document.getElementById('parameters-contentRight').classList.add("parameters-contentRight");
        document.getElementById('parameters-buttonform-image').classList.add("parameters-buttonform-onit");
        document.getElementById('parameters-buttonform-page').classList.remove("parameters-buttonform-onit");
      });

    }
  }

  xhttp.send('id='+idSplit[1]);
}

function tailleImages(){
  if (document.getElementById('taillePlus')){
    let pageTitle = document.getElementById('pageTitle').innerHTML.toLowerCase();
    document.getElementById('taillePlus').addEventListener('click', event => {
      let imageWidthAndHeight;
      if (document.getElementsByClassName(pageTitle + '-containerImage')[0]){
        imageWidthAndHeight = document.getElementsByClassName(pageTitle + '-containerImage')[0].offsetWidth + 20;
      }
      if (imageWidthAndHeight < 300){
        for (var nbImages = 0; nbImages < document.getElementsByClassName(pageTitle + '-containerImage').length; nbImages++) {
          document.getElementsByClassName(pageTitle + '-containerImage')[nbImages].style.width = imageWidthAndHeight + 'px';
          document.getElementsByClassName(pageTitle + '-containerImage')[nbImages].style.height = imageWidthAndHeight + 'px';
        }
      }
    });
  }

  if (document.getElementById('tailleMoins')){
    let pageTitle = document.getElementById('pageTitle').innerHTML.toLowerCase();
    document.getElementById('tailleMoins').addEventListener('click', event => {
      let imageWidthAndHeight;
      if (document.getElementsByClassName(pageTitle + '-containerImage')[0]){
        imageWidthAndHeight = document.getElementsByClassName(pageTitle + '-containerImage')[0].offsetWidth - 20;
      }
      if (imageWidthAndHeight > 100){
        for (var nbImages = 0; nbImages < document.getElementsByClassName(pageTitle + '-containerImage').length; nbImages++) {
          document.getElementsByClassName(pageTitle + '-containerImage')[nbImages].style.width = imageWidthAndHeight + 'px';
          document.getElementsByClassName(pageTitle + '-containerImage')[nbImages].style.height = imageWidthAndHeight + 'px';
        }
      }
    });
  }
}
