<?php
include 'launcher.php';
include "header.php"
?>

<h1 class="text-center my-4 display-2"><?= $nav_element_title[3] ?> :</h1>
<div class="row d-flex  justify-content-center">
    <?php
    // Récupération des posts présent dans la DB
    $the_shops = get_the_shops();
    foreach ($the_shops as $shop) {
        $the_address = $shop['address'];
        $the_owner = $shop['name'];
        $the_city = $shop['city'];
    ?>
        <div class="card mx-4" style="width: 18rem;">
            <img class="card-img-top" src="img\shop1.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title add_the_special_font"><?= $the_city ?></h5>
                <p class="card-text">Dirigé par <?= $the_owner ?> cette boutique se trouve au <?= $the_address ?>.</p>
                <a href="https://www.google.fr/maps/place/<?= $the_city ?>" class="btn btn-primary add_the_special_font">Voir sur la carte</a>
            </div>
        </div>
    <?php
    }
    ?>
</div>



<?php
include 'footer.php';
?>