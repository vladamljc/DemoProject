<html>
<head>
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <script type="text/javascript" src="/assets/script/AjaxService.js"></script>
    <script type="text/javascript" src="/assets/script/visitor/TreeView.js"></script>
    <script type="text/javascript" src="/assets/script/category/CategoryProxy.js"></script>
    <script type="text/javascript" src="/assets/script/category/AdminCategory.js"></script>
    <script type="text/javascript" src="/assets/script/visitor/TreeViewProxy.js"></script>
</head>

<body onload="Catalog.adminCategory.getCategoriesHomePage()">

<div class="homepage-wrapper">

    <div class="homepage-header">
        <h1>Demo shop</h1>
    </div>


    <div class="homepage-categories">

        <div class="search-bar">
            search bar
        </div>

        <div class="list-categories">
            <div class="tree-container" id="tree-div">
                <ul id="treeContainer" class="tree-border">

                </ul>
            </div>
        </div>

    </div>


    <div class="homepage-featured">

        <?php

        $numProducts = $data['numProducts'];
        $cntProducts = 0;

        for ($i = 0; $i < $data['numRows']; $i++) {
            echo '<div class="' . 'featured-products-row' . '">';

            if ($i < $data['numRows'] - 1) {

                for ($j = 0; $j < 3; $j++) {

                    echo '<div class="' . 'card-holder' . '">';

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

                    echo '</div>';

                    $cntProducts++;
                }
            } else {
                for ($j = $cntProducts; $j < $numProducts; $j++) {
                    echo '<div class="' . 'card-holder' . '">';

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

