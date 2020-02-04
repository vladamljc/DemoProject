<html>
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

<body onload="Catalog.adminCategory.getCategoriesHomePage()">

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

        <?php

        $numProducts = $data['numProducts'];
        $cntProducts = 0;

        for ($i = 0; $i < $data['numRows']; $i++) {
            echo '<div class="' . 'featured-products-row' . '">';

            if ($i < $data['numRows'] - 1) {

                for ($j = 0; $j < 3; $j++) {

                    echo '<div class="' . 'card-holder' . '" id="' . $data['featuredProducts'][$cntProducts]->getSku() . '"onclick="Catalog.visitor.getProductDetails(\'' . $data['featuredProducts'][$cntProducts]->getSku() . '\')">';

                    echo '<a href="/product/' . $data['featuredProducts'][$cntProducts]->getSku() . '">';

                    echo '<div class="' . 'card-price' . '">';
                    echo $data['featuredProducts'][$cntProducts]->getPrice() . ' rsd';
                    echo '</div>';

                    echo '<div class="' . 'card-image' . '">';
                    $fullPath = $data['featuredProducts'][$cntProducts]->getImage();
                    $pathPieces = explode('/', $fullPath);
                    $numParts = count($pathPieces);
                    $imageName = $pathPieces[$numParts - 1];
                    $imageSrc = '/assets/Images/' . $imageName;
                    echo '<img width="60%" height="100%" src="' . $imageSrc . '" />';
                    echo '</div>';

                    echo '<div class="' . 'card-featured' . '">';
                    echo 'featured<br>';
                    echo $data['featuredProducts'][$cntProducts]->getTitle();
                    echo '</div>';

                    echo '</a>';

                    echo '</div>';

                    $cntProducts++;
                }
            } else {
                for ($j = $cntProducts; $j < $numProducts; $j++) {
                    echo '<div class="' . 'card-holder' . '" id="' . $data['featuredProducts'][$cntProducts]->getSku() . '" onclick="Catalog.visitor.getProductDetails(\'' . $data['featuredProducts'][$cntProducts]->getSku() . '\')">';

                    echo '<a href="/product/' . $data['featuredProducts'][$cntProducts]->getSku() . '">';

                    echo '<div class="' . 'card-price' . '">';
                    echo $data['featuredProducts'][$cntProducts]->getPrice() . ' rsd';
                    echo '</div>';

                    echo '<div class="' . 'card-image' . '">';
                    $fullPath = $data['featuredProducts'][$cntProducts]->getImage();
                    $pathPieces = explode('/', $fullPath);
                    $numParts = count($pathPieces);
                    $imageName = $pathPieces[$numParts - 1];
                    $imageSrc = '/assets/Images/' . $imageName;
                    echo '<img width="60%" height="100%" src="' . $imageSrc . '" />';
                    echo '</div>';

                    echo '<div class="' . 'card-featured' . '">';
                    echo 'featured<br>';
                    echo $data['featuredProducts'][$cntProducts]->getTitle();
                    echo '</div>';

                    echo '</a>';

                    echo '</div>';

                    $cntProducts++;
                }
            }

            echo '</div>';
        }

        ?>

    </div>

</div>

</body>

</html>

