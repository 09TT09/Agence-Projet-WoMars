<nav class="Navbar">
    <div class="Navbar-section">
        <img class="Navbar-logo" src="../../../images/womars.svg" alt="Womars" width="500" height="80"/>
    </div><!--
    --><div class="Navbar-section Navbar-menudesktop-responsive">
        <a class="Navbar-lien" href="back-office.php">Panel</a>
        <a class="Navbar-lien" href="../../../">Home</a>
        <a class="Navbar-lien" href="../traitement/logout.php">Logout</a>
    </div>
    <div class="Navbar-menumobile-responsive">
         <svg class="Navbar-icone" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
            <rect x="6.5" y="47.4" width="286.9" height="43.4"/>
            <rect x="6.5" y="128.3" width="286.9" height="43.4"/>
            <rect x="6.5" y="209.2" width="286.9" height="43.4"/>
        </svg>
    </div>
</nav>

<style>

/* STYLE - BARRE DE NAVIGATION */

.Navbar{
    position: fixed;
    background-color: white;
    width: 100%;
    height: 60px;
    font-size: 20px;
    border-bottom: solid #0A0623 1px;
    min-width: 260px;
    z-index: 5;
}

.Navbar-section{
    display: inline-block;
    width: 50%;
    height: 100%;
    line-height: 60px;
    vertical-align: top;
    text-align: right;
}

.Navbar-section:first-child{
    text-align: left;
    line-height: calc(60px + 20px);
}

.Navbar-logo{
    height: 34px;
    width: auto;
    margin: 0 6%;
}

.Navbar-lien{
    text-decoration: none;
    color: #0A0623;
    margin: 0 3%;
    transition: .25s;
}

.Navbar-lien:hover{
    color: #F37C26;
    transform: scale(1.1,1.1);
}

.Navbar-lien:last-child{
    margin-right: 12%;
}

.Navbar-menumobile-responsive{
    display: none;
    float: right;
    align-items: center;
    margin-right: 4%;
    height: 100%;
    width: auto;
}

.Navbar-icone{
    height: 38px;
    cursor: pointer;
}

@media screen and (max-width: 750px) {
    .Navbar-logo{
        height: 22px;
        width: auto;
        margin: 0 6%;
    }
    .Navbar-section:first-child{
        line-height: calc(60px + 11px);
    }
    .Navbar-menudesktop-responsive{
        display: none;
    }
    .Navbar-menumobile-responsive{
        display: inline-flex;
    }
}

</style>