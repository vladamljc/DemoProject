var Catalog = window.Catalog || {};


(function () {
    function AjaxService() {
        let me = this;

        me.post = function (uri, json, headerType = '', formData = null) {
            return call('POST', uri, json, headerType, formData);
        };

        me.get = function (uri) {
            return call('GET', uri, '');
        };

        me.put = function (uri, json) {
            return call('PUT', uri, json);
        };

        me.delete = function (uri, json) {
            return call('DELETE', uri, json);
        };

        me.postUploadImage = function (uri, data) {
            return call('POST_UPLOAD_IMAGE', uri, null, '', data);
        };

        let call = function (method, uri, json, headerType, formData) {
            return new Promise(function (resolve, reject) {

                let req = new XMLHttpRequest();

                if (method === 'POST_UPLOAD_IMAGE') {
                    req.open('POST', uri);
                } else {
                    req.open(method, uri);
                }

                if (headerType === 'jsonHeader') req.setRequestHeader("Content-Type", "application/json");

                req.onload = function () {

                    if (req.status === 200) {
                        resolve(req.response);
                    } else {
                        reject(req.statusText);
                    }
                };

                req.onerror = function () {
                    reject('ERROR HAPPENED!');
                };

                if (method === 'POST') {
                    req.send(json);
                }

                if (method === 'GET') {
                    req.send();
                }

                if (method === 'PUT') {
                    req.send(json);
                }

                if (method === 'DELETE') {
                    req.send(json);
                }

                if (method === 'POST_UPLOAD_IMAGE') {
                    req.send(formData);
                }

            });
        }
    }

    Catalog.ajaxService = new AjaxService();
})();



