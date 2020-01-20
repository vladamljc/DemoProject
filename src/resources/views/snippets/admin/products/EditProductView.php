<div class="add-new-product">
    <form method="post">
        <div class="product-form-data">

            <div class="product-info">
                <div class="block-left">
                    <label for="idSKU">SKU:</label>
                </div>
                <div class="block-right">
                    <input type="text" id="idSKU" name="SKU" value="<?php echo $data['productInfo']->getSKU(); ?>"
                           required/>
                </div>
            </div>

            <div class="product-info">
                <div class="block-left">
                    <label for="idTitle">Title:</label>
                </div>

                <div class="block-right">
                    <input type="text" id="idTitle" value="<?php echo $data['productInfo']->getTitle(); ?>" required/>
                </div>
            </div>

            <div class="product-info">
                <div class="block-left">
                    <label for="idBrand">Brand:</label>
                </div>
                <div class="block-right">
                    <input type="text" id="idBrand" value="<?php echo $data['productInfo']->getBrand(); ?>" required/>
                </div>
            </div>

            <div class="product-info">
                <div class="block-left">
                    <label for="idCategory">Category:</label>
                </div>

                <div class="block-right">
                    <select id="idCategory">
                        <?php
                        foreach ($data['category'] as $categoryBean) {
                            if ($categoryBean->code === $data['myCategoryCode']) {
                                echo "<option value='$categoryBean->code' selected >  $categoryBean->parentTitle -> $categoryBean->title</option>";
                            } else {
                                echo "<option value='$categoryBean->code' >  $categoryBean->parentTitle -> $categoryBean->title</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="product-info">
                <div class="block-left">
                    <label for="idPrice">Price:</label>
                </div>
                <div class="block-right">
                    <input type="text" id="idPrice" value="<?php echo $data['productInfo']->getPrice(); ?>" required/>
                </div>
            </div>

            <div class="product-info-area">
                <div class="block-left">
                    <label for="idShortDescription">Short description:</label>
                </div>
                <div class="block-right">
                    <textarea
                            id="idShortDescription"><?php echo $data['productInfo']->getShortDescription(); ?></textarea>
                </div>

            </div>

            <div class="product-info-area">
                <div class="block-left">
                    <label for="idDescription">Description:</label>
                </div>
                <div class="block-right">
                    <textarea
                            id="idDescription"><?php echo $data['productInfo']->getDescription(); ?></textarea>
                </div>

            </div>

            <div class="product-info">
                <div class="block-left">
                    <?php
                    if ($data['productInfo']->getEnabled() === 1) {
                        echo '<input type="checkbox" id="idEnabled" checked/>';
                    } else {
                        echo '<input type="checkbox" id="idEnabled"/>';
                    }
                    ?>
                </div>
                <div class="block-right">
                    <label for="idEnabled">Enabled in shop</label>
                </div>
            </div>

            <div class="product-info">
                <div class="block-left">

                    <?php
                    if ($data['productInfo']->getFeatured() === 1) {
                        echo '<input type="checkbox" id="idFeatured" checked/>';
                    } else {
                        echo '<input type="checkbox" id="idFeatured"/>';
                    }
                    ?>

                </div>
                <div class="block-right">
                    <label for="idFeatured">Featured</label>
                </div>
            </div>

            <div class="product-info">
                <input type="button" id="idButtonSave" value="Save" class="save-button-style"
                       onclick="Catalog.adminProduct.editProduct()"/>
                <p id='idMessageEditCategory'></p>
            </div>


        </div>

        <div class="product-upload-image">

            <div class="image-text">
                Image:
            </div>

            <div class="image-area">
                <img id="idProductImagePreview" height="100%" width="100%" alt="Product image preview"
                     src="<?php echo $data['imagePath']; ?>"/>
            </div>

            <div class="upload-button">
                <input class="upload-button-style" type="file" name="fileToUpload" id="idButtonUploadImage"
                       accept="image/*" onchange="loadFile(event)" value="Upload"/>
            </div>

            <div class="upload-button">
                <p id="idUploadImageMessage"></p>
            </div>

            <input type="hidden" id="idProductIdHidden" value="<?php echo $data['idProductIdHidden'] ?>"/>

        </div>
    </form>
</div>