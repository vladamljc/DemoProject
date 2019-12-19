var Catalog = window.Catalog || {};


(function () {
    function AjaxService() {
        let me = this;

        me.post = function (uri, json) {
            call('POST', uri, json);
        };

        me.get = function (uri) {
            return call('GET', uri);
        };

        me.put = function (uri, json) {
            return call('PUT', uri, json);
        };

        me.delete = function (method, uri) {
            return call('DELETE', uri);
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
                    reject('greska!');
                };

                if (method === 'POST') {
                    req.setRequestHeader("Content-Type", "application/json");
                    req.send(JSON.stringify(json));
                }
            });
        }
    }

    Catalog.ajaxService = new AjaxService();
})();


// let promise = Catalog.ajaxService.post('catalog.test/admin/categories');
// promise.then(function (p) {
//         console.log(p);
//     },
//     function (p2) {
//         console.log(p2);
//     });