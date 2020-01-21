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