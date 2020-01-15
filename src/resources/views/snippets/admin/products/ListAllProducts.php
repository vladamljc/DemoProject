<div class="table-wrapper">
    <table id="idTableProducts" class="table-products" border="1px">
        <?php

        echo '<tr>';
        echo '<th>Select</th>';
        echo '<th>Title</th>';
        echo '<th>SKU</th>';
        echo '<th>Brand</th>';
        echo '<th>Category</th>';
        echo '<th>Short description</th>';
        echo '<th>Price</th>';
        echo '<th>Enable</th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '</tr>';

        foreach ($data['listOfProducts'] as $row) {
            echo '<tr>';

            echo '<td>';
            echo '<input type="checkbox" </input>';
            echo '</td>';

            echo '<td>';
            echo '<p>' . $row->getTitle() . '</p>';
            echo '</td>';

            echo '<td>';
            echo '<p>' . $row->getSKU() . '</p>';
            echo '</td>';

            echo '<td>';
            echo '<p>' . $row->getBrand() . '</p>';
            echo '</td>';

            echo '<td>';
            echo '<p>' . $row->getCategoryName() . '</p>';
            echo '</td>';

            echo '<td>';
            echo '<p>' . $row->getShortDescription() . '</p>';
            echo '</td>';

            echo '<td>';
            echo '<p>' . $row->getPrice() . '</p>';
            echo '</td>';

            echo '<td>';
            if ($row->getEnabled() === 1) {
                echo '<input type="checkbox" checked/>';
            } else {
                echo '<input type="checkbox"/>';
            }
            echo '</td>';

            echo '<td>';
            echo '<input type="button" value="update" />';
            echo '</td>';

            echo '<td>';
            echo '<input type="button" value="delete" />';
            echo '</td>';

            echo '</tr>';
        }
        ?>
    </table>
</div>

<?php
echo '<div class="pagination-wrapper">';
echo '<div class="pagination-content">';

echo '<input type="button" id="' . 0 . '" value="<<" class="button-pagination" onclick="Catalog.adminProduct.getPage(0)" />..';

$numOfPages = ceil($data['numOfProducts'] / 10);
for ($i = 0; $i < $numOfPages; $i++) {
    echo '<input type="button" id="' . $i . '" value="' . $i . '" class="button-pagination" onclick="Catalog.adminProduct.getPage(' . $i . ')" />';
}

echo '..<input type="button" id="' . ($numOfPages - 1) . '" value=">>" class="button-pagination" onclick="Catalog.adminProduct.getPage(' . ($numOfPages - 1) . ')" />';

echo '</div>';
echo '</div>';
?>



