<?php require_once '../../database/mariadb.php'; ?>
<?php include("../sections/section-header.php"); ?>

    <body>

        <div class="wysiwyg-getImage" id="wysiwyg-getImage">
            <div class="wysiwyg-getImageDiv">  
                <button class="parameters-exit" id="exit">X</button><span>Select an image</span>
                <div class="createarticle-allImageContainer" id="XHRPageChange">
                    <?php
                        $currentPage = 1;
                        $counter = (int)$db->query('SELECT COUNT(id) FROM images')->fetch(PDO::FETCH_NUM)[0];
                        $imagePerPage = 30;
                        $pages = ceil($counter / $imagePerPage);
                        $offset = $imagePerPage * ($currentPage - 1);

                        $req = $db->query("SELECT * FROM images ORDER BY id DESC LIMIT $imagePerPage OFFSET $offset"); 
                        $allimages = $req->fetchAll();
                        foreach ($allimages as $image):
                    ?>

                        <?php if (file_exists('../media/media/'.$image['name'])): ?>
                            <div class="createarticle-containerImage" onclick="selectedImage(this)" id="containerImage-<?php echo htmlspecialchars($image['id'], ENT_QUOTES, 'UTF-8') ?>">
                                <img class="createarticle-Image" src="../media/media/<?php echo htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8') ?>"  alt="<?php echo htmlspecialchars($image['alt'], ENT_QUOTES, 'UTF-8') ?>" id="image-<?php echo htmlspecialchars($image['id'], ENT_QUOTES, 'UTF-8') ?>"/>
                            </div>
                        <?php endif; ?>
                        
                    <?php endforeach ?>

                    <div style="width: 100%; text-align: center; margin: 20px 0;">
                        <?php if($currentPage > 1): ?>
                            <button class="button-paging" id="previous" onclick="getPage(this)">Page précédente</button>
                        <?php endif ?>
                        <?php if($currentPage < $pages): ?>
                            <button class="button-paging" id="next" onclick="getPage(this)">Page suivante</button>
                        <?php endif ?>
                    </div>

                    <div id="getCurrentPage" style="display: none;"><?php echo $currentPage ?></div>
                    
                </div>
            </div>
        </div>

        <?php include("../sections/section-navbar-without-banner.php"); ?>
        <div class="Page-div-title">
            <p id="Page-div-title-panel">Create article</p>
        </div>
        <?php include("../sections/section-article-create.php"); ?>
 
        <script>
            function getPage(nextOrPrevious){
              const WherePage = nextOrPrevious.id;
              let currentPage = document.getElementById('getCurrentPage').innerHTML;
              let xhttp = new XMLHttpRequest();
              xhttp.open('POST', 'xhr/post-id-articlepage.php', true);
              xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
              xhttp.onreadystatechange = function() {
                if(xhttp.readyState == 4 && xhttp.status == 200) {
                  document.getElementById('XHRPageChange').innerHTML = xhttp.responseText;
                  currentPage = document.getElementById('getCurrentPage').innerHTML;
                }
              }
              xhttp.send('imagepage='+currentPage+'&wherepage='+WherePage);
            }
        </script>

    </body>
</html>