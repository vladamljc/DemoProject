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
            search bar
        </div>

        <div class="list-categories">
            <div class="tree-container" id="tree-div">
                <ul id="treeContainer" class="tree-border">

                </ul>
            </div>
        </div>

    </div>


    <div class="homepage-featured" id="idProducts">


        <div class="product-display-wrapper">


            <div class="product-display-image">
                <?php
                $fullPath = $data[0]->getImage();
                $pathPieces = explode('/', $fullPath);
                $numParts = count($pathPieces);
                $imageName = $pathPieces[$numParts - 1];
                $imageSrc = '/assets/Images/' . $imageName;
                echo '<img src="' . $imageSrc . '" />';
                ?>
            </div>

            <div class="product-display-info">

                <div class="product-info-block">
                    <?php echo $data[0]->getSku(); ?>
                </div>

                <div class="product-info-block">
                    <?php echo $data[0]->getTitle(); ?>
                </div>

                <div class="product-info-block">
                    <?php echo $data[0]->getShortDescription(); ?>
                </div>

                <div class="product-info-block">
                    <?php echo $data[0]->getDescription(); ?>
                </div>

                <div class="product-info-block">
                    <?php echo $data[0]->getBrand(); ?>
                </div>

                <div class="product-info-block">
                    <?php echo $data[0]->getPrice() . ' rsd'; ?>
                </div>

            </div>


        </div>

    </div>

</div>

</body>

</html>

