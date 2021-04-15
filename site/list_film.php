<?php
include "launcher.php";

// Définition des variables de pages sur quel page est l'utilisateur ?
if ($_GET) {
    $page_value_from = $_GET['from'];
    $page_value_to = $_GET['to'];
    $page = $_GET['page'];
} else {
    $page_value_from = 1;
    $page_value_to = 10;
    $page = 1;
}

include "header.php"

?>
<h1 class="text-center my-2 display-2">
    <?= $nav_element_title[1] ?>
</h1>


<div class="row d-flex  justify-content-center">
    <table class="table table-hover table-sm m-5 text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="display-5 add_the_special_font">
                    Titre
                </th>
                <th scope="col" class="display-5 add_the_special_font">
                    Description
                </th>
                <th scope="col" class="display-5 add_the_special_font">
                    Catégorie
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupération des posts présent dans la DB
            $the_films = get_the_films($page_value_from, $page_value_to);
            foreach ($the_films as $film) {
                $the_title = $film['title'];
                $the_desc = $film['description'];
                $the_category = $film['category'];
            ?>
                <tr>
                    <td class="text-truncate"><?= $the_title ?></td>
                    <td class="text-truncate" style="max-width: 350px;"><?= $the_desc ?></td>
                    <td class="text-truncate"><?= $the_category ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="row mt-2">
    <nav aria-label="..." class="d-flex justify-content-center align-item-center">
        <ul class="pagination">
            <li class="page-item 
                <?php if ($page_value_from <= 10) {
                    echo 'disabled';
                } ?>">
                <a class="page-link" href="list_film.php?from=<?= $page_value_from - 10 ?>&to=<?= $page_value_to - 10 ?>&page=<?= $page - 1 ?>">Page Précedente</a>
            </li>
            <?php if ($page + 1 > 100) { ?>
                <li class="page-item">
                    <a class="page-link" href="list_film.php?from=<?= $page_value_from - 20 ?>&to=<?= $page_value_to - 20 ?>&page=<?= $page - 2 ?>"><?= $page - 2 ?></a>
                </li>
            <?php } ?>
            <?php if ($page - 1 >= 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="list_film.php?from=<?= $page_value_from - 10 ?>&to=<?= $page_value_to - 10 ?>&page=<?= $page - 1 ?>"><?= $page - 1 ?></a>
                </li>
            <?php } ?>
            <li class="page-item active">
                <a class="page-link" href="#"><?= $page ?></a>
            </li>
            <?php if ($page + 1 <= 100) { ?>
                <li class="page-item">
                    <a class="page-link" href="list_film.php?from=<?= $page_value_from + 10 ?>&to=<?= $page_value_to + 10 ?>&page=<?= $page + 1 ?>"><?= $page + 1 ?></a>
                </li>
            <?php } ?>
            <?php if ($page - 1 <= 0) { ?>
                <li class="page-item">
                    <a class="page-link" href="list_film.php?from=<?= $page_value_from + 20 ?>&to=<?= $page_value_to + 20 ?>&page=<?= $page + 2 ?>"><?= $page + 2 ?></a>
                </li>
            <?php } ?>
            <li class="page-item <?php if ($page_value_to >= 1000) {
                                        echo 'disabled';
                                    } ?>">
                <a class="page-link" href="list_film.php?from=<?= $page_value_from + 10 ?>&to=<?= $page_value_to + 10 ?>&page=<?= $page + 1 ?>">Page Suivante</a>
            </li>
        </ul>
    </nav>


</div>
<?php
include 'footer.php';
?>