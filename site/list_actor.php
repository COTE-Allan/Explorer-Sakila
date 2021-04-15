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
include "header.php";
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>


<h1 class="text-center my-2 display-2"><?= $nav_element_title[2] ?></h1>


<div class="row d-flex  justify-content-center">
    <table class="table table-hover table-sm m-5 text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="display-5 add_the_special_font">
                    Acteur
                </th>
                <th scope="col" class="display-5 add_the_special_font">
                    Films
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupération des posts présent dans la DB
            $the_actors = get_the_actor($page_value_from, $page_value_to);
            foreach ($the_actors as $actor) {
                $the_name = $actor['first_name'] . ' ' . $actor['last_name'];
                $the_id = $actor['actor_id'];
            ?>
                <tr>
                    <td class="text-truncate align-middle"><?= $the_name ?></td>
                    <td style="max-width: 150px;" class="align-middle">
                        <a href="list_film_actor.php?actor=<?= $the_id ?>&previous_url=<?= $actual_link ?>" class="text-decoration-none ">
                            Voir ses films
                        </a>
                    </td>
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
                <a class="page-link" href="list_actor.php?from=<?= $page_value_from - 10 ?>&to=<?= $page_value_to - 10 ?>&page=<?= $page - 1 ?>">Page Précédente</a>
            </li>
            <?php if ($page + 1 > 20) { ?>
                <li class="page-item">
                    <a class="page-link" href="list_actor.php?from=<?= $page_value_from - 20 ?>&to=<?= $page_value_to - 20 ?>&page=<?= $page - 2 ?>"><?= $page - 2 ?></a>
                </li>
            <?php } ?>
            <?php if ($page - 1 >= 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="list_actor.php?from=<?= $page_value_from - 10 ?>&to=<?= $page_value_to - 10 ?>&page=<?= $page - 1 ?>"><?= $page - 1 ?></a>
                </li>
            <?php } ?>
            <li class="page-item active">
                <a class="page-link" href="#"><?= $page ?></a>
            </li>
            <?php if ($page + 1 <= 20) { ?>
                <li class="page-item">
                    <a class="page-link" href="list_actor.php?from=<?= $page_value_from + 10 ?>&to=<?= $page_value_to + 10 ?>&page=<?= $page + 1 ?>"><?= $page + 1 ?></a>
                </li>
            <?php } ?>
            <?php if ($page - 1 <= 0) { ?>
                <li class="page-item">
                    <a class="page-link" href="list_actor.php?from=<?= $page_value_from + 20 ?>&to=<?= $page_value_to + 20 ?>&page=<?= $page + 2 ?>"><?= $page + 2 ?></a>
                </li>
            <?php } ?>
            <li class="page-item <?php if ($page_value_to >= 200) {
                                        echo 'disabled';
                                    } ?>">
                <a class="page-link" href="list_actor.php?from=<?= $page_value_from + 10 ?>&to=<?= $page_value_to + 10 ?>&page=<?= $page + 1 ?>">Page Suivante</a>
            </li>
        </ul>
    </nav>


</div>

<?php
include 'footer.php';
?>