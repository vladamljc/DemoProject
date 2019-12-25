function createTreeView(location) {
    let tree = [],
        object = {},
        parent,
        child;

    for (let i = 0; i < location.length; i++) {
        parent = location[i];

        object[parent.Id] = parent;
        object[parent.Id]["children"] = [];
    }

    for (let Id in object) {
        if (object.hasOwnProperty(Id)) {
            child = object[Id];
            if (child.ParentId && object[child["ParentId"]]) {
                object[child["ParentId"]]["children"].push(child);
            } else {
                tree.push(child);
            }
        }
    }
    return tree;
}

function CreateUlTreeView(items, parent) {
    let treeNode = document.createElement("ul");


    treeNode.classList.add('hideChildren');
    treeNode.addEventListener('click', function (event) {
        if (treeNode.classList.contains('hideChildren')) {
            treeNode.classList.remove('hideChildren');
        } else {
            treeNode.classList.add('hideChildren');
        }

        let selectedCategoryWindow = document.getElementById("idFormWindow");
        let request = new XMLHttpRequest();
        let titleName = items.Title;
        request.open("GET", "/admin/categories/showSelectedCategory" + "?paramTitle=" + titleName, true);

        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4) {
                if (request.status == 200) selectedCategoryWindow.innerHTML = request.responseText;
                else if (request.status == 404) selectedCategoryWindow.innerHTML = "404:FILE NOT FOUND"; else
                    selectedCategoryWindow.innerHTML = "Error loading document";
            }
        };

        event.stopPropagation();
    });


    treeNode.innerText = items.Title;


    if (items.children && items.children.length) {
        for (let child of items.children) {
            CreateUlTreeView(child, treeNode);
        }
    }

    parent.appendChild(treeNode);

}