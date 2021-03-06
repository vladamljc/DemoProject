var Catalog = window.Catalog || {};

(function () {

    function AdminCategory() {
        let me = this;

        me.addCategory = function () {
            let titleName = document.getElementById('title').value;
            let codeName = document.getElementById('code').value;
            let descriptionName = document.getElementById('description').value;
            let parentId = document.getElementById('parent').value;

            let categoryObj = {
                title: titleName,
                code: codeName,
                description: descriptionName,
                parentId: parentId
            };

            let categoryString = JSON.stringify(categoryObj);

            Catalog.categoryProxy.addCategory(categoryString).then(function (response) {
                let messageJSON = JSON.parse(response);
                document.getElementById('feedbackMessage').innerText = messageJSON.message;
            }).catch(function (err) {
                document.getElementById('feedbackMessage').innerText = err.message;
            });

            if (document.getElementById('treeContainer').classList.contains('disabled')) {
                document.getElementById('treeContainer').classList.remove('disabled');
            }

            document.getElementById('treeContainer').innerHTML = "";
            Catalog.adminCategory.getCategoryJSON();
        };

        me.resetFields = function () {
            if (document.getElementById('treeContainer').classList.contains('disabled')) {
                document.getElementById('treeContainer').classList.remove('disabled');
            }
            document.getElementById('title').value = "";
            document.getElementById('code').value = "";
            document.getElementById('description').value = "";
        };

        me.cancel = function () {
            if (document.getElementById('treeContainer').classList.contains('disabled')) {
                document.getElementById('treeContainer').classList.remove('disabled');
            }
            document.getElementById("idFormWindow").innerHTML = "";
        };


        me.showAddFormView = function () {
            let newCategoryWindow = document.getElementById("idFormWindow");
            Catalog.categoryProxy.showAddFormView().then(function (response) {
                newCategoryWindow.innerHTML = newCategoryWindow.innerHTML = response;
            }).catch(function (err) {
                return "error";
            });
        };


        me.showAddSubFormView = function () {

            document.getElementById('treeContainer').classList.add('disabled');

            let newSubCategoryWindow = document.getElementById("idFormWindow");
            let parentCode = document.getElementById('code').value;
            let targetPath = "/admin/categories/addSubFormView?parentCode=" + parentCode;

            Catalog.categoryProxy.showAddSubFormView(targetPath).then(function (response) {
                newSubCategoryWindow.innerHTML = response;
            }).catch(function (err) {
                newSubCategoryWindow.innerHTML = 'ERROR: PAGE LOADING FAILED';
            });

        };

        let idCategory;

        me.showEditCategoryForm = function () {
            document.getElementById('treeContainer').classList.add('disabled');
            let editCategoryWindow = document.getElementById("idFormWindow");
            let code = document.getElementById('code').value;

            let targetPath = "/admin/categories/getEditCategoryView?code=" + code;

            Catalog.categoryProxy.getEditCategoryView(targetPath).then(function (response) {
                editCategoryWindow.innerHTML = response;
                idCategory = document.getElementById('idCategory').value;
            }).catch(function (err) {
                editCategoryWindow.innerHTML = 'ERROR: PAGE LOADING FAILED';
            });
        };

        me.editCategory = function () {
            if (document.getElementById('treeContainer').classList.contains('disabled')) {
                document.getElementById('treeContainer').classList.remove('disabled');
            }

            let title = document.getElementById('title').value;
            let code = document.getElementById('code').value;
            let description = document.getElementById('description').value;
            let parent = document.getElementById('parent').value;

            let editCategoryObj = {
                "title": title,
                "code": code,
                "parentCode": parent,
                "description": description,
                "idCategory": idCategory
            };

            let editCategoryObjString = JSON.stringify(editCategoryObj);

            Catalog.categoryProxy.editCategory("/admin/categories/editCategory", editCategoryObjString).then(function (response) {
                let messageJSON = JSON.parse(response);
                document.getElementById('feedbackMessage').innerText = messageJSON.message;
            }).catch(function (err) {
                document.getElementById('feedbackMessage').innerText = "Editing category/subcategory failed...";
            });

            document.getElementById('treeContainer').innerHTML = "";
            Catalog.adminCategory.getCategoryJSON();
        };

        let categoriesJSON;
        let root;

        me.getCategoryJSON = function () {

            Catalog.categoryProxy.getAllCategories().then(function (response) {
                categoriesJSON = JSON.parse(response);
                root = Catalog.tree.createTreeView(categoriesJSON);
                for (let child of root) {
                    Catalog.tree.CreateUlTreeView(child, document.getElementById('treeContainer'));
                }
            }).catch(function (err) {
                return "error";
            });


        };

        me.getCategoriesHomePage = function (code = -1) {

            Catalog.categoryProxy.getAllCategories().then(function (response) {
                categoriesJSON = JSON.parse(response);
                root = Catalog.treeHomepage.createTreeView(categoriesJSON);
                for (let child of root) {
                    Catalog.treeHomepage.CreateUlTreeView(child, document.getElementById('treeContainer'));
                }
                if (code !== -1) Catalog.visitor.updateTree(code);
            }).catch(function (err) {
                return "error";
            });


        };

        me.deleteCategory = function () {

            let categoryCode = document.getElementById('code').value;
            let target = '/admin/categories/deleteCategory';

            let deleteObj = {
                "code": categoryCode
            };

            let deleteObjString = JSON.stringify(deleteObj);

            Catalog.categoryProxy.deleteCategory(target, deleteObjString).then(function (response) {
                let messageJSON = JSON.parse(response);
                document.getElementById('feedbackMessage').innerText = messageJSON.message;
            }).catch(function (err) {
                document.getElementById('feedbackMessage').innerText = "Error: Can not delete category";
            });

            document.getElementById('treeContainer').innerHTML = "";
            Catalog.adminCategory.getCategoryJSON();

        };

        me.confirmDelete = function () {
            let confirmAlert = confirm('Are you sure you want to delete this category?');
            if (confirmAlert === true) {
                this.deleteCategory();
            }
        }
    }

    Catalog.adminCategory = new AdminCategory();
})();