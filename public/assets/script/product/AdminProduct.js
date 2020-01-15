var Catalog = window.Catalog || {};

(function () {

    function AdminProduct() {
        let me = this;

        me.getNewProductView = function () {

            let contentDiv = document.getElementById('idProductPage');
            let target = '/admin/product/create';

            Catalog.productProxy.getNewProductView(target).then(function (response) {
                contentDiv.innerHTML = response;
            }).catch(function (err) {
                contentDiv.innerText = 'ERROR: PAGE NOT LOADED';
            });
        };

        me.addNewProduct = function () {
            let uri = '/admin/product/create';

            let enabledFlag;
            let featuredFlag;

            if (document.getElementById('idEnabled').checked) enabledFlag = 1; else enabledFlag = 0;
            if (document.getElementById('idFeatured').checked) featuredFlag = 1; else featuredFlag = 0;

            let productObj = {
                SKU: document.getElementById('idSKU').value,
                Title: document.getElementById('idTitle').value,
                Brand: document.getElementById('idBrand').value,
                CategoryCode: document.getElementById('idCategory').value,
                Price: document.getElementById('idPrice').value,
                ShortDescription: document.getElementById('idShortDescription').value,
                Description: document.getElementById('idDescription').value,
                Enabled: enabledFlag,
                Featured: featuredFlag
            };

            Catalog.productProxy.addNewProduct(uri, JSON.stringify(productObj)).then(function (response) {
                let message = JSON.parse(response);
                document.getElementById('idUploadImageMessage').innerText = message.message;
            }).catch(function (err) {
                document.getElementById('idUploadImageMessage').innerText = "Adding product failed.";
            });

            let formData = new FormData();
            formData.append("fileToUpload", document.getElementById('idButtonUploadImage').files[0]);
            formData.append("SKU", document.getElementById('idSKU').value);

            let uriUpload = '/admin/product/uploadImage';
            Catalog.productProxy.uploadProductImage(uriUpload, formData).then(function (response) {
                let message = JSON.parse(response);
                document.getElementById('idUploadImageMessage').innerText += ' ' + message.message;
            }).catch(function (err) {
                let message = JSON.parse(err);
                document.getElementById('idUploadImageMessage').innerText += ' ' + message.message;
            });


        };

        me.getPage = function (pageId) {

            let table = document.getElementById('idTableProducts');

            let uri = '/admin/products/getPage?pageId=' + pageId;

            Catalog.productProxy.getPage(uri).then(function (response) {
                document.getElementById('idContentProduct').innerHTML = response;
            }).catch(function (err) {

            });

        }
    }

    Catalog.adminProduct = new AdminProduct();
})();