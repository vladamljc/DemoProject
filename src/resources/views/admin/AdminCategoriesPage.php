<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    <script type="text/javascript" src="/AjaxService.js"></script>
    <script>
        function addCategory() {
            let title = document.getElementById('title').value;
            let code = document.getElementById('code').value;
            let description = document.getElementById('description').value;

            let categoryString = '{'
                + '"title" : ' + '"' + title + '",'
                + '"code" : ' + '"' + code + '",'
                + '"description" : ' + '"' + description + '"'
                + '}';


            let categoryJSON = JSON.parse(categoryString);

            let promise = Catalog.ajaxService.post('/admin/categories', categoryJSON);
        }

        function resetFields() {
            let title = document.getElementById('title').value = "";
            let code = document.getElementById('code').value = "";
            let description = document.getElementById('description').value = "";
        }

        function showAddFormView() {
            let newCategoryWindow = document.getElementById("idFormWindow");
            let request = new XMLHttpRequest();
            request.open("GET", "/admin/categories/addFormView", true);

            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    if (request.status == 200) newCategoryWindow.innerHTML = request.responseText;
                    else if (request.status == 404) newCategoryWindow.innerHTML = "404:FILE NOT FOUND"; else
                        newCategoryWindow.innerHTML = "Error loading document";
                }
            }
        }


    </script>
</head>

<body>


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