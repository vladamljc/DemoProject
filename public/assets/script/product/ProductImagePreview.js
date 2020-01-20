let loadFile = function (event) {
    let output = document.getElementById('idProductImagePreview');
    output.src = URL.createObjectURL(event.target.files[0]);
};