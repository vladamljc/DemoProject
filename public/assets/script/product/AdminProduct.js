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
                document.getElementById('idCurrentPage').value = pageId;
            }).catch(function (err) {

            });

        };

        me.enableProducts = function () {
            let uri = '/admin/products/enableProducts';

            let cboxes = document.getElementsByName('select');
            let len = cboxes.length;
            let listOfSKU = [];

            for (let i = 0; i < len; i++) {
                if (cboxes[i].checked)
                    listOfSKU.push(cboxes[i].value);
            }

            let products = {
                sku: listOfSKU
            };

            Catalog.productProxy.enableProducts(uri, JSON.stringify(products)).then(function (response) {
                me.getPage(document.getElementById('idCurrentPage').value);
            }).catch(function (err) {
                alert('error: not enabled.');
            });
        };

        me.disableProducts = function () {
            let uri = '/admin/products/disableProducts';

            let cboxes = document.getElementsByName('select');
            let len = cboxes.length;
            let listOfSKU = [];

            for (let i = 0; i < len; i++) {
                if (cboxes[i].checked)
                    listOfSKU.push(cboxes[i].value);
            }

            let products = {
                sku: listOfSKU
            };

            Catalog.productProxy.disableProducts(uri, JSON.stringify(products)).then(function (response) {
                me.getPage(document.getElementById('idCurrentPage').value);
            }).catch(function (err) {
                alert('error: not enabled.');
            });
        };

        me.deleteSelectedProducts = function () {
            let uri = '/admin/products/deleteSelectedProducts';

            let cboxes = document.getElementsByName('select');
            let len = cboxes.length;
            let listOfSKU = [];

            for (let i = 0; i < len; i++) {
                if (cboxes[i].checked)
                    listOfSKU.push(cboxes[i].value);
            }

            let products = {
                sku: listOfSKU
            };

            Catalog.productProxy.deleteSelectedProducts(uri, JSON.stringify(products)).then(function (response) {
                me.getPage(0);
                let messageJSON = JSON.parse(response);
                document.getElementById('idProductMessage').innerText = messageJSON.message;
            }).catch(function (err) {
                alert('error: not enabled.');
            });
        };

        me.deleteProduct = function (sku) {
            let uri = '/admin/products/deleteProduct';

            let product = {
                sku: sku
            };

            Catalog.productProxy.deleteProduct(uri, JSON.stringify(product)).then(function (response) {
                me.getPage(0);
                let messageJSON = JSON.parse(response);
                document.getElementById('idProductMessage').innerText = messageJSON.message;
            }).catch(function (err) {
                alert('error: not enabled.');
            });
        };

        me.getEditProductView = function (param) {
            let contentDiv = document.getElementById('idProductPage');
            let uri = '/admin/product/' + param;
            Catalog.productProxy.getEditProductView(uri).then(function (response) {
                contentDiv.innerHTML = response;
            }).catch(function (err) {
                alert(err);
                contentDiv.innerText = 'ERROR: PAGE NOT LOADED';
            });

        };

        me.editProduct = function () {
            let contentDiv = document.getElementById('idProductPage');

            let sku = document.getElementById('idSKU').value;
            let title = document.getElementById('idTitle').value;
            let brand = document.getElementById('idBrand').value;
            let category = document.getElementById('idCategory').value;
            let price = document.getElementById('idPrice').value;
            let shortDescription = document.getElementById('idShortDescription').value;
            let description = document.getElementById('idDescription').value;
            let enabled;
            if (document.getElementById('idEnabled').checked) enabled = 1; else enabled = 0;
            let featured;
            if (document.getElementById('idFeatured').checked) featured = 1; else featured = 0;
            let id = document.getElementById('idProductIdHidden').value;

            let uri = '/admin/products/editProduct?sku=' + sku + "&title=" + title + "&brand=" + brand + '&category=' + category + '&price=' + price + '&shortDescription=' + shortDescription + '&description=' + description + '&enabled=' + enabled + '&featured=' + featured + '&idProduct=' + id;

            Catalog.productProxy.editProduct(uri).then(function (response) {
                let feedBackMessage = JSON.parse(response);
                document.getElementById('idMessageEditCategory').innerText = (feedBackMessage.message);
            }).catch(function (err) {
                contentDiv.innerText = 'ERROR: PAGE NOT LOADED';
            });

            if (document.getElementById('idButtonUploadImage').files.length !== 0) {
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
            }
        }
    }

    Catalog.adminProduct = new AdminProduct();
})();