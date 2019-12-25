<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <script type="text/javascript" src="/AjaxService.js"></script>
    <script type="text/javascript" src="/TreeView.js"></script>
    <script type="text/javascript" src="/AdminCategories.js"></script>
</head>

<body onload="getCategoryJSON()">


<h1>Admin categories page</h1>

<div class="navigation-bar">
    <?php include __DIR__ . '/../snippets/admin/navigation/AdminNavigationBar.php'; ?>
</div>

<div class="admin-content">
    <div class="category-tree-view">
        <?php include __DIR__ . '/../snippets/admin/categories/TreeView.php'; ?>
    </div>

    <div class="category-form-view" id="idFormWindow">

    </div>
</div>

</body>
</html>