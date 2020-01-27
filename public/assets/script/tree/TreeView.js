var Catalog = window.Catalog || {};

(function () {

    function TreeService() {
        let me = this;

        me.createTreeView = function (location) {
            let tree = [],
                object = {},
                parent,
                child;

            for (let i = 0; i < location.length; i++) {
                parent = location[i];

                object[parent.id] = parent;
                object[parent.id]["children"] = [];
            }

            for (let Id in object) {
                if (object.hasOwnProperty(Id)) {
                    child = object[Id];
                    if (child.parentId && object[child["parentId"]]) {
                        object[child["parentId"]]["children"].push(child);
                    } else {
                        tree.push(child);
                    }
                }
            }
            return tree;
        };

        me.CreateUlTreeView = function (items, parent) {
            let treeNode = document.createElement("li");


            treeNode.classList.add('hideChildren');
            treeNode.addEventListener('click', function (event) {

                if (!(document.getElementById('treeContainer').classList.contains('disabled'))) {
                    if (treeNode.classList.contains('hideChildren')) {
                        treeNode.classList.remove('hideChildren');
                    } else {
                        treeNode.classList.add('hideChildren');
                    }

                    let selectedCategoryWindow = document.getElementById("idFormWindow");
                    let code = items.code;

                    let target = "/admin/categories/showSelectedCategory" + "?code=" + code;

                    Catalog.treeProxy.showSelectedCategory(target).then(function (response) {
                        selectedCategoryWindow.innerHTML = response;
                    }).catch(function (err) {
                        selectedCategoryWindow.innerHTML = 'ERROR - CAN NOT LOAD PAGE';
                    });

                    event.stopPropagation();
                }


            });


            treeNode.innerText = items.title;


            if (items.children && items.children.length) {
                for (let child of items.children) {
                    this.CreateUlTreeView(child, treeNode);
                }
            }

            parent.appendChild(treeNode);


        }

    }

    Catalog.tree = new TreeService();
})();