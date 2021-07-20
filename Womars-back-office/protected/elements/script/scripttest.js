function editImage(imageId){
  const getPageName = document.getElementById('pageTitle').innerHTML.toLowerCase();
  const idSplit = imageId.id.split('-');
  
  let headers = new Headers({'Content-Type': 'application/x-www-form-urlencoded'});
  
  fetch('xhr/post-id-'+getPageName+'.php?id=' + idSplit[1], { method: 'POST', headers: headers})
  .then(response => {
    response.text().then(text => {
      document.getElementById('getXHR').innerHTML = text;
      document.getElementById('paramsImage').style.display = 'flex'
    });
  })
  .then(json => console.log('ok'))
  .catch(error => console.error('error: ', error));
}