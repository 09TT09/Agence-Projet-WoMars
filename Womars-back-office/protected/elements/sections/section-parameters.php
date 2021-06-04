<div class="parameters-galerieFlexbox" id="paramsImage">
    <div class="parameters-divParams">
    <button class="parameters-exit" id="exit">X</button><!--
    --><span id="getXHR"></span>
    </div>
</div>

<script>
document.getElementById('exit').addEventListener('click', event => {
  document.getElementById('paramsImage').style.display = 'none';
});
</script>

<style>

.parameters-galerieFlexbox{
    position: fixed; 
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
}

.parameters-divParams{
    width: 80%;
    height: 90vh;
    background-color: white;
    color: black;
}

.parameters-exit{
    display: block;
    width: 45px;
    height: 45px;
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

.parameters-contentLeft{
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 70%;
    height: 80%;
    margin: 10px 10px 0 10px;
    border: solid black 1px;
    background-color: #d4d4d4;
    vertical-align: top;
}

.parameters-contentRight{
    display: inline-block;
    width: calc(30% - 35px);
    height: 80%;
    margin: 10px 10px 0 0;
    border: solid black 1px;
    background-color: #d4d4d4;
    vertical-align: top;
    text-align: center;
    overflow: auto;
}

.parameters-actions{
    height: calc(20% - 55px - 2px);
    margin: 0 10px;
}

.parameters-actions-left{
    display: flex;
    align-items: center;
    height: 100%;
    width: 50%;
}

.parameters-button-delete{
    width: 150px;
    height: 35px;
    font-size: 16px;
    background-color: crimson;
    border: 0;
    border-radius: 4px;
    color: white;
    cursor: pointer;
    transition: .25s;
}

.parameters-button-update{
    width: 150px;
    height: 35px;
    font-size: 16px;
    background-color: #5e4cff;
    border: 0;
    border-radius: 4px;
    color: white;
    cursor: pointer;
    transition: .25s;
    margin-left: 10px;
}

.parameters-button-update:hover{
    background-color: #493bc5;
}

.parameters-button-delete:hover{
    background-color: #ae0021;
}

.media-inputtext{
    width: 85%;
    padding: 7px;
}

.media-inputtextarea{
    width: 85%;
    height: 300px;
    padding: 7px;
}

.media-label{
    text-align: left;
}

</style>