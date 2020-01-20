<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <script type="text/javascript" src="/assets/script/product/AdminProduct.js"></script>
    <script type="text/javascript" src="/assets/script/product/ProductProxy.js"></script>
    <script type="text/javascript" src="/assets/script/AjaxService.js"></script>
    <script type="text/javascript" src="/assets/script/product/ProductImagePreview.js"></script>
    <script type="text/javascript" src="/assets/script/AjaxService.js"></script>
    <script type="text/javascript" src="/assets/script/tree/TreeView.js"></script>
    <script type="text/javascript" src="/assets/script/category/CategoryProxy.js"></script>
    <script type="text/javascript" src="/assets/script/category/AdminCategory.js"></script>
    <script type="text/javascript" src="/assets/script/tree/TreeViewProxy.js"></script>
</head>

<body>


<h1>Admin dashboard page</h1>

<div class="navigation-bar">
    <?php include __DIR__ . '/../snippets/admin/navigation/AdminNavigationBar.php'; ?>
</div>

<div class="admin-content">
    <?php include __DIR__ . '/../snippets/admin/dashboard/dashboard.php'; ?>
</div>

</body>
</html>
