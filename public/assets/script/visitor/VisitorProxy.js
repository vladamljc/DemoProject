var Catalog = window.Catalog || {};


(function () {
    function VisitorProxy() {
        let me = this;

        me.getProductDetails = function (uri) {
            return Catalog.ajaxService.get(uri);
        };

        me.getProducts = function (uri) {
            return Catalog.ajaxService.get(uri);
        };

        me.onPageChanged = function (uri) {
            return Catalog.ajaxService.get(uri);
        }

    }

    Catalog.visitorProxy = new VisitorProxy();
})();
