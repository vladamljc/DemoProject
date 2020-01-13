var Catalog = window.Catalog || {};


(function () {
    function TreeViewProxy() {
        let me = this;

        me.showSelectedCategory = function (targetPath) {
            return Catalog.ajaxService.get(targetPath);
        };

    }

    Catalog.treeProxy = new TreeViewProxy();
})();
