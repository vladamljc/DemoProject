<?php

$numProducts = $data['numProducts'];
$cntProducts = 0;

for ($i = 0; $i < $data['numRows']; $i++) {
    echo '<div class="' . 'display-products-row' . '">';

    if ($i < $data['numRows'] - 1) {

        for ($j = 0; $j < 5; $j++) {

            echo '<div class="' . 'product-display-box' . '" id="' . $data['products'][$cntProducts]->getSku() . '"onclick="Catalog.visitor.getProductDetails(\'' . $data['products'][$cntProducts]->getSku() . '\')">';

            echo '<a href="/product/' . $data['products'][$cntProducts]->getSku() . '">';
            echo '<div class="' . 'product-display-box-title' . '">';
            echo $data['products'][$cntProducts]->getTitle();
            echo '</div>';

            echo '<div class="' . 'product-display-box-image' . '">';
            $fullPath = $data['products'][$cntProducts]->getImage();
            $pathPieces = explode('/', $fullPath);
            $numParts = count($pathPieces);
            $imageName = $pathPieces[$numParts - 1];
            $imageSrc = '/assets/Images/' . $imageName;
            echo '<img width="60%" height="100%" src="' . $imageSrc . '" />';
            echo '</div>';

            echo '<div class="' . 'product-display-box-price' . '">';
            echo 'featured<br>';
            echo $data['products'][$cntProducts]->getPrice() . ' rsd';
            echo '</div>';

            echo '<div class="' . 'product-display-box-short-description' . '">';
            echo $data['products'][$cntProducts]->getShortDescription();
            echo '</div>';

            echo '</a>';

            echo '</div>';

            $cntProducts++;
        }
    } else {
        for ($j = $cntProducts; $j < $numProducts; $j++) {
            echo '<div class="' . 'product-display-box' . '" id="' . $data['products'][$cntProducts]->getSku() . '"onclick="Catalog.visitor.getProductDetails(\'' . $data['products'][$cntProducts]->getSku() . '\')">';

            echo '<a href="/product/' . $data['products'][$cntProducts]->getSku() . '">';
            echo '<div class="' . 'product-display-box-title' . '">';
            echo $data['products'][$cntProducts]->getTitle();
            echo '</div>';

            echo '<div class="' . 'product-display-box-image' . '">';
            $fullPath = $data['products'][$cntProducts]->getImage();
            $pathPieces = explode('/', $fullPath);
            $numParts = count($pathPieces);
            $imageName = $pathPieces[$numParts - 1];
            $imageSrc = '/assets/Images/' . $imageName;
            echo '<img width="60%" height="100%" src="' . $imageSrc . '" />';
            echo '</div>';

            echo '<div class="' . 'product-display-box-price' . '">';
            echo 'featured<br>';
            echo $data['products'][$cntProducts]->getPrice() . 'rsd';
            echo '</div>';

            echo '<div class="' . 'product-display-box-short-description' . '">';
            echo 'featured<br>';
            echo $data['products'][$cntProducts]->getShortDescription();
            echo '</div>';

            echo '</a>';

            echo '</div>';

            $cntProducts++;
        }
    }

    echo '</div>';
}

echo '<input type="hidden" id="idTotalPageNumber" value="' . $data['numPages'] . '"/>';
echo '<input type="hidden" id="idCurrentPageNumber" value="' . $data['currentPageNumber'] . '"/>';
?>