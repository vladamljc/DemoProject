<div class="wrapper-display-categories">

    <div class="wrapper-criteria">

        <label>sort by</label>

        <select id="idSelectCriteria" class="wrapper-criteria-element" onchange="Catalog.visitor.onFilterChanged()">
            <option value="pa">Price ascending</option>
            <option value="pd">Price descending</option>
            <option value="ta">Title ascending</option>
            <option value="td">Title descending</option>
            <option value="ba">Brand ascending</option>
            <option value="bd">Brand descending</option>
        </select>


        <div class="wrapper-criteria-element-buttons">
            <button id="idButtonFullBack" onclick="Catalog.visitor.onFilterChanged('idButtonFullBack')"> <<</button>
            <button id="idButtonOneBack" onclick="Catalog.visitor.onFilterChanged('idButtonOneBack')"> <</button>
            <button id="idButtonPagination"
                    value="<?php echo 1 . '/' . $data['numPages'] ?> "> <?php echo 1 . '/' . $data['numPages'] ?>  </button>
            <button id="idButtonOneForward" onclick="Catalog.visitor.onFilterChanged('idButtonOneForward')"> ></button>
            <button id="idButtonFullForward" onclick="Catalog.visitor.onFilterChanged('idButtonFullForward')"> >>
            </button>
        </div>

        <label>products per page</label>

        <select id="idSelectPagePerPage" class="wrapper-criteria-element" onchange="Catalog.visitor.onFilterChanged()">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

    </div>

    <div class="display-products-wrapper" id="idDisplayCategoryProducts">

        <?php

        $numProducts = $data['numProducts'];
        $cntProducts = 0;

        for ($i = 0; $i < $data['numRows']; $i++) {
            echo '<div class="' . 'display-products-row' . '">';

            if ($i < $data['numRows'] - 1) {

                for ($j = 0; $j < 5; $j++) {

                    echo '<div class="' . 'product-display-box' . '" id="' . $data['products'][$cntProducts]->getSku() . '"onclick="Catalog.visitor.getProductDetails(\'' . $data['products'][$cntProducts]->getSku() . '\')">';

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

                    echo '</div>';

                    $cntProducts++;
                }
            } else {
                for ($j = $cntProducts; $j < $numProducts; $j++) {
                    echo '<div class="' . 'product-display-box' . '" id="' . $data['products'][$cntProducts]->getSku() . '"onclick="Catalog.visitor.getProductDetails(\'' . $data['products'][$cntProducts]->getSku() . '\')">';

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

                    echo '</div>';

                    $cntProducts++;
                }
            }

            echo '</div>';
        }
        ?>

    </div>
    <input type="hidden" id="idCategoryCodeDisplay" value="<?php echo $data['categoryCode'] ?>"/>

    <input type="hidden" id="idTotalPageNumber" value="<?php echo $data['numPages'] ?>"/>

</div>
