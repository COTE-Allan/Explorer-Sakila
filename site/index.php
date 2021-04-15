<?php
include 'launcher.php';
include "header.php"
?>

<h1 class="text-center my-4 display-2">Explorer la base de donnée Sakila</h1>
<div class="row">
    <nav class="row d-flex justify-content-center align-items-center">
        <?php
        $i = 1;
        while ($i <= 5) {
            $the_title = $nav_element_title[$i];
            $the_desc = $nav_element_desc[$i];
            $the_url = $nav_element_url[$i];
            $the_picture = $nav_element_img[$i];
        ?>
            <div class="card m-3" style="width: 30%; height: 250px;">
                <div class="card-body d-flex justify-content-around flex-column" style="position: relative;">
                    <h5 class="card-title add_the_special_font"><?= $the_title ?> </h5>
                    <img src="<?= $the_picture ?>" alt="logo_films">
                    <p class="card-text"><?= $the_desc ?></p>
                    <a href="<?= $the_url ?>" class=" add_the_special_font btn btn-primary">GO !</a>
                </div>
            </div>
        <?php
            $i++;
        } ?>
    </nav>
</div>
<?php
include 'footer.php';
?>