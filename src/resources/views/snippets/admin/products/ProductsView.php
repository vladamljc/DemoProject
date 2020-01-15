<div id="idProductPage">

    <div class="products-top">
        <h1>Products</h1>
        <div class="product-buttons">
            <button id="idButtonNewProduct" name="ButtonNewProduct" onclick="Catalog.adminProduct.getNewProductView()">
                Add new product
            </button>

            <button id="idButtonDeleteProducts" name="ButtonDeleteProducts"
                    onclick="Catalog.adminProduct.deleteSelectedProducts()">
                Delete products
            </button>

            <button id="idButtonEnableProducts" name="Enable selected" onclick="Catalog.adminProduct.enableProducts()">
                Enable selected
            </button>

            <button id="idButtonDisableProducts" name="Disable selected"
                    onclick="Catalog.adminProduct.disableProducts()">
                Disable selected
            </button>
        </div>
    </div>

    <div id="idContentProduct" class="product-middle">
    </div>

    <div class="product-bottom">
        <input type="hidden" id="idCurrentPage">
    </div>

</div>