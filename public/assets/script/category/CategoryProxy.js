var Catalog = window.Catalog || {};


(function () {
    function CategoryProxy() {
        let me = this;

        me.addCategory = function (data) {
            return Catalog.ajaxService.post('/admin/categories', data);
        };

        me.showAddFormView = function () {
            return Catalog.ajaxService.get('/admin/categories/addFormView');
        };

        me.showAddSubFormView = function (uri) {
            return Catalog.ajaxService.get(uri);
        };

        me.getAllCategories = function () {
            return Catalog.ajaxService.get('/admin/categories/getJSON');
        };

        me.getEditCategoryView = function (uri) {
            return Catalog.ajaxService.get(uri);
        };

        me.editCategory = function (uri, data) {
            return Catalog.ajaxService.put(uri, data);
        };

        me.deleteCategory = function (uri, data) {
            return Catalog.ajaxService.delete(uri, data);
        };

    }

    Catalog.categoryProxy = new CategoryProxy();
})();



