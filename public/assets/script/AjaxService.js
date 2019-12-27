var Catalog = window.Catalog || {};


(function () {
    function AjaxService() {
        let me = this;

        me.post = function (uri, json) {
            return call('POST', uri, json);
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

        let call = function (method, uri, json) {
            return new Promise(function (resolve, reject) {

                let req = new XMLHttpRequest();
                req.open(method, uri);

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
                    req.setRequestHeader("Content-Type", "application/json");
                    req.send(json);
                }

                if (method === 'GET') {
                    req.send();
                }

                if (method === 'PUT') {
                    req.setRequestHeader("Content-Type", "application/json");
                    req.send(json);
                }

                if (method === 'DELETE') {
                    req.setRequestHeader("Content-Type", "application/json");
                    req.send(json);
                }
            });
        }
    }

    Catalog.ajaxService = new AjaxService();
})();



