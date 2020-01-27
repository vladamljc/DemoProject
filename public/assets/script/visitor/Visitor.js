var Catalog = window.Catalog || {};

(function () {

    function Visitor() {
        let me = this;

        me.getProducts = function (uri) {
            Catalog.visitorProxy.getProducts(uri).then(function (response) {
                document.getElementById('idProducts').innerHTML = response;
            }).catch(function (err) {
                alert(err);
            });
        };

        me.onFilterChanged = function (idPageButtonClicked) {

            idPageButtonClicked = typeof idPageButtonClicked !== 'undefined' ? idPageButtonClicked : 'idButtonFullBack';

            let buttonPaginationText = document.getElementById('idButtonPagination').innerText;
            let pieces = buttonPaginationText.split("/");
            let currentPageNumber = Number(pieces[0]);
            let lastPageNumber = Number(pieces[1]);

            let page;
            switch (idPageButtonClicked) {
                case 'idButtonFullBack':
                    page = 1;
                    break;
                case 'idButtonOneBack':
                    page = currentPageNumber === 1 ? 1 : currentPageNumber - 1;
                    break;
                case 'idButtonOneForward':
                    page = currentPageNumber === lastPageNumber ? lastPageNumber : currentPageNumber + 1;
                    break;
                case 'idButtonFullForward':
                    page = lastPageNumber;
                    break;
            }

            let sortBy = document.getElementById('idSelectCriteria').value;
            let pageOffset = document.getElementById('idSelectPagePerPage').value;
            let categoryCode = document.getElementById('idCategoryCodeDisplay').value;

            let target = '/products/param/' + categoryCode + '?sortBy=' + sortBy + '&pageOffset=' + pageOffset + '&caller=1&page=' + page;
            Catalog.visitorProxy.getProducts(target).then(function (response) {
                document.getElementById('idDisplayCategoryProducts').innerHTML = response;
                let currentPage = Number(document.getElementById('idCurrentPageNumber').value);
                let totalPage = Number(document.getElementById('idTotalPageNumber').value);
                document.getElementById('idButtonPagination').innerText = currentPage + '/' + totalPage;
            }).catch(function (err) {
                alert(err);
            });
        };

        me.updateTree = function (code) {
            let parent = document.getElementById(code).parentElement;
            while (parent.nodeName === 'LI') {
                if (parent.classList.contains('hideChildren'))
                    parent.classList.remove('hideChildren');
                parent = parent.parentElement;
            }
        }

    }

    Catalog.visitor = new Visitor();
})();