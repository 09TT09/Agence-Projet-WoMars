<?php require_once '../../database/mariadb.php'?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>WoMars Agence</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <meta name="description" content="Site WoMars" />
        <meta name="robots" content="noindex" />
        <link rel="stylesheet" type="text/css" href="../style/backoffice-style.css" />
    </head>

    <body>
        <?php include("../sections/section-parameters.php"); ?>
        <?php include("../sections/section-navbar.php"); ?>
        <div class="Page-view">
            <p class="Page-view-title" id="pageTitle">Statistics</p>
            <span id="modulableContent"></span>
        </div>
        <?php include("../sections/section-menu.php"); ?>

        <?php
            if (isset($_GET['page'])){ $getPage = $_GET['page']; }
            else { $getPage = 'vide'; }
        ?>

        <script>
        let redirectPage = '<?php echo $getPage; ?>';

        function ChangePageContent(){
            document.getElementById('modulableContent').innerHTML = '';
            if (page === 'Articles'){
                document.getElementById('modulableContent').innerHTML = `<?php include "../sections/panel-main-components/articles.php";?>`;

                document.getElementById('researchBar').addEventListener('keyup', event => {
                    let text = (document.getElementById('researchBar').value).toLowerCase();
                    for (let searchInArticles = 0; searchInArticles < document.getElementsByClassName('title-search').length; searchInArticles++){
                        document.getElementsByClassName('line')[searchInArticles].style.display = "table-row";
                        if ((document.getElementsByClassName('title-search')[searchInArticles].innerHTML).toLowerCase().includes(text) != true){
                            document.getElementsByClassName('line')[searchInArticles].style.display = "none";
                        }   
                    }
                });
            }
            else if (page === 'Media'){
                document.getElementById('modulableContent').innerHTML = `<?php include "../sections/panel-main-components/media.php";?>`;
            }
        }
        </script>
        <script src="../script/script.js"></script>
    </body>
</html>