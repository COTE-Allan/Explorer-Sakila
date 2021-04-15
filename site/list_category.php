<?php
include 'launcher.php';
include "header.php"
?>

<h1 class="text-center my-4 display-2"><?= $nav_element_title[5] ?></h1>

<div class="row d-flex  justify-content-center">
    <table class="table table-hover table-sm m-5 text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="display-3 add_the_special_font">
                    Catégorie
                </th>
                <th scope="col" class="display-3 add_the_special_font">
                    Nombres de films
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupération des posts présent dans la DB
            $categorys = get_the_films_by_category();
            foreach ($categorys as $category) {
                $the_category = $category['category'];
                $the_count_of_film = $category['COUNT(*)'];
            ?>
                <tr>
                    <td class="display-5"><?= $the_category ?></td>
                    <td class="display-5"><?= $the_count_of_film ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>


<?php
include 'footer.php';
?>