<?php
    $countAllArticles = (int)$db->query('SELECT COUNT(id) FROM articles')->fetch(PDO::FETCH_NUM)[0];
    $countPostedArticles = (int)$db->query('SELECT COUNT(id) FROM articles WHERE state = 1')->fetch(PDO::FETCH_NUM)[0];
    $countPartners = (int)$db->query('SELECT COUNT(id) FROM partners')->fetch(PDO::FETCH_NUM)[0];
    $countCrewMembers = (int)$db->query('SELECT COUNT(id) FROM crew')->fetch(PDO::FETCH_NUM)[0];
    $countImages = (int)$db->query('SELECT COUNT(id) FROM images')->fetch(PDO::FETCH_NUM)[0];
    $sizeImages = 0;
?>

<?php
    $req = $db->query('SELECT size FROM images');
    $images = $req->fetchAll();
    foreach ($images as $image):
        $getSize = intval($image['size']);
        $sizeToKo = substr(number_format($getSize), 0, -1);
        $sizeImages = $sizeImages + intval($sizeToKo);
    endforeach;
?>


<div class="statistics-maindiv">
    <div>
        <p>Number of articles : <?php echo $countAllArticles ?></p>
        <p>Number of articles online : <span style="color:#41d541"><?php echo $countPostedArticles . "</span> / <span style='color:crimson'>" . $countAllArticles ?></span></p>
        <p>Number of partners : <?php echo $countPartners ?></p>
        <p>Number of the crew : <?php echo $countCrewMembers ?></p>
        <p>Number of images : <?php echo $countImages ?></p>
        <p>Size of images in media : <?php echo $sizeImages . " Ko"?></p>
    </div>
<div>

<style>

.statistics-maindiv{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: auto;
    font-size: 16px;
}

</style>