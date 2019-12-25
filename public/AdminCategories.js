function addCategory() {
    let title = document.getElementById('title').value;
    let code = document.getElementById('code').value;
    let description = document.getElementById('description').value;

    let categoryString = '{'
        + '"title" : ' + '"' + title + '",'
        + '"code" : ' + '"' + code + '",'
        + '"description" : ' + '"' + description + '"'
        + '}';

    let categoryJSON = JSON.parse(categoryString);

    let request = new XMLHttpRequest();
    request.open("POST", "/admin/categories", true);
    request.send(JSON.stringify(categoryJSON));
    request.onreadystatechange = function () {
        let feedMessage = document.getElementById('feedbackMessage');
        if (request.status == 200) {
            let message = JSON.parse(this.responseText);
            feedMessage.innerHTML = message.message;
        } else if (request.status == 404) feedMessage.innerHTML = "Adding category failed";
    };

    document.getElementById('treeContainer').innerHTML = "";
    getCategoryJSON();
}

function addSubCategory() {
    document.getElementById('overlay').style.display = "none";
    let title = document.getElementById('title').value;
    let code = document.getElementById('code').value;
    let description = document.getElementById('description').value;
    let parent = document.getElementById('parent').value;

    let subCategoryString = '{'
        + '"title" : ' + '"' + title + '",'
        + '"code" : ' + '"' + code + '",'
        + '"parent" : ' + '"' + parent + '",'
        + '"description" : ' + '"' + description + '"'
        + '}';

    let subCategoryJSON = JSON.parse(subCategoryString);
    let request = new XMLHttpRequest();
    request.open("POST", "/admin/categories/addSubCategory", true);
    request.send(JSON.stringify(subCategoryJSON));
    request.onreadystatechange = function () {
        let feedMessage = document.getElementById('feedbackMessage');
        if (request.status == 200) {
            let message = JSON.parse(this.responseText);
            feedMessage.innerHTML = message.message;
        } else if (request.status == 404) feedMessage.innerHTML = "Adding sub-category failed";
    };

    document.getElementById('treeContainer').innerHTML = "";
    getCategoryJSON();
}


function resetFields() {
    document.getElementById('overlay').style.display = "none";
    let title = document.getElementById('title').value = "";
    let code = document.getElementById('code').value = "";
    let description = document.getElementById('description').value = "";
}

function showAddFormView() {
    let newCategoryWindow = document.getElementById("idFormWindow");
    let request = new XMLHttpRequest();
    request.open("GET", "/admin/categories/addFormView", true);

    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            if (request.status == 200) newCategoryWindow.innerHTML = request.responseText;
            else if (request.status == 404) newCategoryWindow.innerHTML = "404:FILE NOT FOUND"; else
                newCategoryWindow.innerHTML = "Error loading document";
        }
    }
}

function showAddSubFormView() {

    document.getElementById('overlay').style.display = "block";

    let newSubCategoryWindow = document.getElementById("idFormWindow");
    let request = new XMLHttpRequest();

    let parentTitle = document.getElementById('title').value;

    request.open("GET", "/admin/categories/addSubFormView?parentTitle=" + parentTitle, true);

    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            if (request.status == 200) {
                newSubCategoryWindow.innerHTML = request.responseText;
            } else if (request.status == 404) newSubCategoryWindow.innerHTML = "404:FILE NOT FOUND"; else
                newSubCategoryWindow.innerHTML = "Error loading document";
        }
    }
}

let categoriesJSON;
let root;

function getCategoryJSON() {
    let request = new XMLHttpRequest();
    request.open("GET", "/admin/categories/getJSON", true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            categoriesJSON = JSON.parse(this.responseText);
            root = createTreeView(categoriesJSON);

            for (let child of root) {
                CreateUlTreeView(child, document.getElementById('treeContainer'));
            }
        }
    }
}