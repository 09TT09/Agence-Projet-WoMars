<?php require_once '../../database/mariadb.php'; ?>
<?php include("../sections/section-header-analyticsjs.php"); ?>

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
        let redirectPage = '<?php echo htmlspecialchars($getPage, ENT_QUOTES, 'UTF-8') ?>';

        function ChangePageContent(){
            document.getElementById('modulableContent').innerHTML = '';
            if (page === 'Statistics'){
                document.getElementById('modulableContent').innerHTML = `<?php include "../sections/panel-main-components/statistics.php";?>`;
            }
            else if (page === 'Articles'){
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
                tailleImages();
            }
            else if (page === 'Crew'){
                document.getElementById('modulableContent').innerHTML = `<?php include "../sections/panel-main-components/crew.php";?>`;
                tailleImages();
            }
            else if (page === 'Partners'){
                document.getElementById('modulableContent').innerHTML = `<?php include "../sections/panel-main-components/partners.php";?>`;
                tailleImages();
            }
        }
        </script>
        <script src="../script/script.js"></script>
    </body>
</html>