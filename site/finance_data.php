<?php
include 'launcher.php';
include "header.php";
?>

<h1 class="text-center my-4 display-2"><?= $nav_element_title[4] ?></h1>

<div class="row d-flex  justify-content-center">
    <table class="table table-hover table-sm m-5 text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="display-4 add_the_special_font">
                    Adresse du magasin
                </th>
                <th scope="col" class="display-4 add_the_special_font">
                    Ventes
                </th>
                <th scope="col" class="display-4 add_the_special_font">
                    Nb films en stocks
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupération des posts présent dans la DB
            $shop_details = get_the_shop_details();
            $inventory = get_the_inventory();
            array_push($shop_details[0], $inventory[0]['store1']);
            array_push($shop_details[1], $inventory[0]['store2']);
            foreach ($shop_details as $the_shop) {
                $the_location = $the_shop['store'];
                $the_sales = $the_shop['total_sales'];
                $the_inventory = $the_shop[2];
            ?>
                <tr>
                    <td class="display-5">
                        <?= $the_location ?>
                    </td>
                    <td class="display-5">
                        <?= $the_sales ?>$
                    </td>
                    <td class="display-5">
                        <?= $the_inventory ?>
                    </td>
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