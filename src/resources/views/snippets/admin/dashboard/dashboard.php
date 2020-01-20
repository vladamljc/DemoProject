<div class="dashboard-wrapper">

    <div class="dashboard-left">

        <div class="dashboard-left-data">
            <label>Product count:</label>
            <p id="idProductCount"><?php echo $data['numProducts']; ?></p>
        </div>

        <div class="dashboard-left-data">
            <label>Categories count::</label>
            <p id="idProductCount"><?php echo $data['numCategories']; ?></p>
        </div>

    </div>

    <div class="dashboard-right">

        <div class="dashboard-right-data">
            <label>Home page opening count:</label>
            <p id="idProductCount"><?php echo $data['openingCount']; ?></p>
        </div>

        <div class="dashboard-right-data">
            <label>Most often viewed product:</label>
            <p id="idProductCount" class="p-product-name"><?php echo $data['mostViewedProductName']; ?></p>
        </div>

        <div class="dashboard-right-data">
            <label>Number of views:</label>
            <p id="idProductCount"><?php echo $data['mostViewedProductViewCount']; ?></p>
        </div>

    </div>

</div>