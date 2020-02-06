<div class="add-new-product">

        <div class="product-form-data">

            <div class="product-info">
                <div class="block-left">
                    <label for="idSKU">SKU:</label>
                </div>
                <div class="block-right">
                    <input type="text" id="idSKU" name="SKU" required/>
                </div>
            </div>

            <div class="product-info">
                <div class="block-left">
                    <label for="idTitle">Title:</label>
                </div>

                <div class="block-right">
                    <input type="text" id="idTitle" name="Title" required/>
                </div>
            </div>

            <div class="product-info">
                <div class="block-left">
                    <label for="idBrand">Brand:</label>
                </div>
                <div class="block-right">
                    <input type="text" id="idBrand" name="Brand" required/>
                </div>
            </div>

            <div class="product-info">
                <div class="block-left">
                    <label for="idCategory">Category:</label>
                </div>

                <div class="block-right">
                    <select id="idCategory" name="CategoryCode">
                        <?php
                        foreach ($data as $categoryBean) {
                            echo "<option value='$categoryBean->code' >  $categoryBean->parentTitle -> $categoryBean->title</option>";
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
                    <input type="number" id="idPrice" name="Price" required/>
                </div>
            </div>

            <div class="product-info-area">
                <div class="block-left">
                    <label for="idShortDescription">Short description:</label>
                </div>
                <div class="block-right">
                    <textarea id="idShortDescription" name="ShortDescription"></textarea>
                </div>

            </div>

            <div class="product-info-area">
                <div class="block-left">
                    <label for="idDescription">Description:</label>
                </div>
                <div class="block-right">
                    <textarea id="idDescription" name="Description"></textarea>
                </div>

            </div>

            <div class="product-info">
                <div class="block-left">
                    <input type="checkbox" id="idEnabled" name="Enabled"/>
                </div>
                <div class="block-right">
                    <label for="idEnabled">Enabled in shop</label>
                </div>
            </div>

            <div class="product-info">
                <div class="block-left">
                    <input type="checkbox" id="idFeatured" name="Featured"/>
                </div>
                <div class="block-right">
                    <label for="idFeatured">Featured</label>
                </div>
            </div>

            <div class="product-info">
                <input type="button" id="idButtonSave" value="Save" class="save-button-style"
                       onclick="Catalog.adminProduct.addNewProduct()"/>
            </div>


        </div>

        <div class="product-upload-image">

            <div class="image-text">
                Image:
            </div>

            <div class="image-area">
                <img id="idProductImagePreview" height="100%" width="100%" alt="Product image preview">
            </div>

            <div class="upload-button">
                <input class="upload-button-style" type="file" name="fileToUpload" id="idButtonUploadImage"
                       accept="image/*" onchange="loadFile(event)" value="Upload"/>
            </div>

            <div class="upload-button">
                <p id="idUploadImageMessage"></p>
            </div>

        </div>

</div>