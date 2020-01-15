var Catalog = window.Catalog || {};

(function () {

    function ProductProxy() {
        let me = this;

        me.getNewProductView = function (uri) {
            return Catalog.ajaxService.get(uri);
        };

        me.addNewProduct = function (uri, json) {
            return Catalog.ajaxService.post(uri, json, 'jsonHeader');
        };

        me.uploadProductImage = function (uri, formData) {
            return Catalog.ajaxService.postUploadImage(uri, formData);
        };

        me.getPage = function (uri) {
            return Catalog.ajaxService.get(uri);
        };
    }

    Catalog.productProxy = new ProductProxy();
})();