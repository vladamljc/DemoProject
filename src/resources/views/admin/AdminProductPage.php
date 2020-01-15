<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <script type="text/javascript" src="/assets/script/product/AdminProduct.js"></script>
    <script type="text/javascript" src="/assets/script/product/ProductProxy.js"></script>
    <script type="text/javascript" src="/assets/script/AjaxService.js"></script>
    <script type="text/javascript" src="/assets/script/product/ProductImagePreview.js"></script>
</head>

<body onload="Catalog.adminProduct.getPage(0)">


<h1>Admin product page</h1>

<div class="navigation-bar">
    <?php include __DIR__ . '/../snippets/admin/navigation/AdminNavigationBar.php'; ?>
</div>

<div class="admin-content">
    <?php include __DIR__ . '/../snippets/admin/products/ProductsView.php'; ?>
</div>

</body>
</html>