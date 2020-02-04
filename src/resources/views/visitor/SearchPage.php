<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <script type="text/javascript" src="/assets/script/AjaxService.js"></script>
    <script type="text/javascript" src="/assets/script/visitor/TreeView.js"></script>
    <script type="text/javascript" src="/assets/script/category/CategoryProxy.js"></script>
    <script type="text/javascript" src="/assets/script/category/AdminCategory.js"></script>
    <script type="text/javascript" src="/assets/script/visitor/TreeViewProxy.js"></script>
    <script type="text/javascript" src="/assets/script/visitor/Visitor.js"></script>
    <script type="text/javascript" src="/assets/script/visitor/VisitorProxy.js"></script>
</head>

<body onload="Catalog.adminCategory.getCategoriesHomePage(); Catalog.visitor.onSearchPageChanged();">

<div class="homepage-wrapper">

    <div class="homepage-header">
        <h1>Demo shop</h1>
    </div>


    <div class="homepage-categories">

        <div class="search-bar">
            <div class="search-bar-wrapper">
                <form action="/search" method="get">
                    <input type="text" id="idSearch" name="keyword"/>
                    <input type="submit" id="idButtonSearch" value="search"/>
                </form>
            </div>
        </div>

        <div class="list-categories">
            <div class="tree-container" id="tree-div">
                <ul id="treeContainer" class="tree-border">

                </ul>
            </div>
        </div>

    </div>


    <div class="homepage-featured" id="idProducts">

        <div class="wrapper-display-categories">
            <form method="get" action="/search">
                <div class="wrapper-search-criteria">
                    <div class="wrapper-search-criteria-top">
                        <label>Keyword:</label>
                        <label>Category:</label>
                        <label>Max price:</label>
                        <label>Min price:</label>
                        <label></label>
                    </div>
                    <div class="wrapper-search-criteria-bottom">

                        <input type="text" id="idKeyWord" name="keyword" value="<?php echo $data['keyword']; ?>"/>

                        <select id="idCategorySelect" name="selectCategory">

                            <?php
                            if ($data['selectCategory'] === 'any') {
                                echo '<option value="any" selected>' . 'any' . '</option>';
                            } else {
                                echo '<option value="any">' . 'any' . '</option>';
                            }

                            for ($i = 0; $i < $data['numCategoriesBean']; $i++) {
                                if ($data['selectCategory'] === $data['categories'][$i]->code) {
                                    echo '<option value="' . $data['categories'][$i]->code . '" selected>' . $data['categories'][$i]->parentTitle . ' => ' . $data['categories'][$i]->title . '</option>';
                                } else {
                                    echo '<option value="' . $data['categories'][$i]->code . '">' . $data['categories'][$i]->parentTitle . ' => ' . $data['categories'][$i]->title . '</option>';
                                }
                            }
                            ?>
                        </select>

                        <input type="number" id="idMaxPrice" name="maxPrice" value="<?php echo $data['max']; ?>"/>

                        <input type="number" id="idMinPrice" name="minPrice" value="<?php echo $data['min']; ?>"/>

                        <input type="submit" value="Filter"/>

                    </div>
                </div>
            </form>
            <div class="wrapper-criteria">

                <label>sort by</label>

                <select id="idSelectCriteria" name="searchType" class="wrapper-criteria-element"
                        onchange="Catalog.visitor.onFilterChanged()">
                    <option value="relevance">Relevance</option>
                </select>


                <div class="wrapper-criteria-element-buttons">
                    <button id="idButtonFullBack" onclick="Catalog.visitor.onSearchPageChanged('idButtonFullBack')"> <<
                    </button>
                    <button id="idButtonOneBack" onclick="Catalog.visitor.onSearchPageChanged('idButtonOneBack')"> <
                    </button>
                    <button id="idButtonPagination"
                            value="<?php echo 1 . '/' . $data['numPages'] ?> "> <?php echo 1 . '/' . $data['numPages'] ?>  </button>
                    <button id="idButtonOneForward" onclick="Catalog.visitor.onSearchPageChanged('idButtonOneForward')">
                        >
                    </button>
                    <button id="idButtonFullForward"
                            onclick="Catalog.visitor.onSearchPageChanged('idButtonFullForward')">
                        >>
                    </button>
                </div>

                <label>products per page</label>

                <select id="idSelectProductsPerPage" class="wrapper-criteria-element"
                        onchange="Catalog.visitor.onSearchPageChanged()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

            </div>

            <div class="display-products-wrapper" id="idDisplayCategoryProducts">

                <!--                --><?php
                //
                //                $numProducts = $data['numProducts'];
                //                $cntProducts = 0;
                //
                //                for ($i = 0; $i < $data['numRows']; $i++) {
                //                    echo '<div class="' . 'display-products-row' . '">';
                //
                //                    if ($i < $data['numRows'] - 1) {
                //
                //                        for ($j = 0; $j < 5; $j++) {
                //
                //                            echo '<div class="' . 'product-display-box' . '" id="' . $data['products'][$cntProducts]->getSku() . '"onclick="Catalog.visitor.getProductDetails(\'' . $data['products'][$cntProducts]->getSku() . '\')">';
                //
                //                            echo '<div class="' . 'product-display-box-title' . '">';
                //                            echo $data['products'][$cntProducts]->getTitle();
                //                            echo '</div>';
                //
                //                            echo '<div class="' . 'product-display-box-image' . '">';
                //                            $fullPath = $data['products'][$cntProducts]->getImage();
                //                            $pathPieces = explode('/', $fullPath);
                //                            $numParts = count($pathPieces);
                //                            $imageName = $pathPieces[$numParts - 1];
                //                            $imageSrc = '/assets/Images/' . $imageName;
                //                            echo '<img width="60%" height="100%" src="' . $imageSrc . '" />';
                //                            echo '</div>';
                //
                //                            echo '<div class="' . 'product-display-box-price' . '">';
                //                            echo 'featured<br>';
                //                            echo $data['products'][$cntProducts]->getPrice() . ' rsd';
                //                            echo '</div>';
                //
                //                            echo '<div class="' . 'product-display-box-short-description' . '">';
                //                            echo $data['products'][$cntProducts]->getShortDescription();
                //                            echo '</div>';
                //
                //                            echo '</div>';
                //
                //                            $cntProducts++;
                //                        }
                //                    } else {
                //                        for ($j = $cntProducts; $j < $numProducts; $j++) {
                //                            echo '<div class="' . 'product-display-box' . '" id="' . $data['products'][$cntProducts]->getSku() . '"onclick="Catalog.visitor.getProductDetails(\'' . $data['products'][$cntProducts]->getSku() . '\')">';
                //
                //                            echo '<div class="' . 'product-display-box-title' . '">';
                //                            echo $data['products'][$cntProducts]->getTitle();
                //                            echo '</div>';
                //
                //                            echo '<div class="' . 'product-display-box-image' . '">';
                //                            $fullPath = $data['products'][$cntProducts]->getImage();
                //                            $pathPieces = explode('/', $fullPath);
                //                            $numParts = count($pathPieces);
                //                            $imageName = $pathPieces[$numParts - 1];
                //                            $imageSrc = '/assets/Images/' . $imageName;
                //                            echo '<img width="60%" height="100%" src="' . $imageSrc . '" />';
                //                            echo '</div>';
                //
                //                            echo '<div class="' . 'product-display-box-price' . '">';
                //                            echo 'featured<br>';
                //                            echo $data['products'][$cntProducts]->getPrice() . 'rsd';
                //                            echo '</div>';
                //
                //                            echo '<div class="' . 'product-display-box-short-description' . '">';
                //                            echo 'featured<br>';
                //                            echo $data['products'][$cntProducts]->getShortDescription();
                //                            echo '</div>';
                //
                //                            echo '</div>';
                //
                //                            $cntProducts++;
                //                        }
                //                    }
                //
                //                    echo '</div>';
                //                }
                ?>

            </div>

            <input type="hidden" id="idTotalPageNumber" value="<?php echo $data['numPages'] ?>"/>
            <input type="hidden" id="idCurrentPageNumber" value="<?php echo $data['currentPageNumber'] ?>"/>

        </div>


    </div>

</div>

</body>

</html>

