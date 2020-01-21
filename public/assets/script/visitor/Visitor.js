var Catalog = window.Catalog || {};

(function () {

    function Visitor() {
        let me = this;

        me.getProductDetails = function (sku) {

            let uri = '/product/' + sku;

            Catalog.visitorProxy.getProductDetails(uri).then(function (response) {
                document.getElementById('idProducts').innerHTML = response;
            }).catch(function (err) {
                alert(err);
            });

        }

    }

    Catalog.visitor = new Visitor();
})();