let menuButtonsArray = ['Statistics', 'Articles', 'Pages', 'Media', 'Comments'];
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
    case 'Comments':
      document.getElementsByClassName('Menu-button')[4].classList.add('Menu-button-selected');
      document.getElementsByClassName('Menu-button')[4].querySelector('svg').classList.add('color-orange');
      page = 'Comments';
      break;
    default:
      console.log(`Menu color error`);
  }
  ChangePageContent();
}

window.onscroll = function (event) {
  document.getElementById('menuDiv').style.height = `calc(66vh + ${parseInt(window.scrollY)}px)`;
};