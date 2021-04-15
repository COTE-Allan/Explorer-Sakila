<?php
include 'launcher.php';
include "header.php";
$actor_name = get_the_actor_name($_GET['actor']);
?>

<!-- <h1 class="text-center my-4"><?= $nav_element_title[6] ?> :</h1> -->

<div class="row d-flex  justify-content-center">
    <table class="table table-hover table-sm m-5 text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="display-3 add_the_special_font">
                    Les films de <?= $actor_name[0]['first_name'] . " " . $actor_name[0]['last_name']  ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupération des posts présent dans la DB
            $films_from_actor = get_the_film_actor($_GET['actor']);
            foreach ($films_from_actor as $film) {
                $the_film = $film['title'];
            ?>
                <tr>
                    <td class="display-5"><?= $the_film ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<a href="<?php echo $_GET['previous_url'];
            if (isset($_GET['to'])) {
                echo "&to=" . $_GET['to'] . "&page=" . $_GET['page'];
            } ?>" id="return" class="float">
    <i class="las la-undo my-float"></i>
</a>


<?php
include 'footer.php';
?>