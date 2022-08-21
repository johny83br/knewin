var newsModal = document.getElementById("news");
newsModal.addEventListener("show.bs.modal", function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    var id = button.getAttribute("data-id");
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = newsModal.querySelector(".modal-title");
    var modalBody = newsModal.querySelector(".modal-body");

    loadNews(id, modalTitle, modalBody);

    // modalTitle.textContent = "New message to " + recipient;
    // modalBodyInput.value = recipient;
});

function loadNews(id, modalTitle, modalBody) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const parse = JSON.parse(this.responseText);
        const body = `<b>Date:</b> ${
            parse._source.created_at
        }<br/><b>URL:</b> <a href="${parse._source.url}" target="_blank">${
            parse._source.url
        }</a><br/><b>Source:</b> ${
            parse._source.source
        }<br/><br/> ${parse._source.content.replace(
            /(?:\r\n|\r|\n)/g,
            "<br>"
        )}`;
        modalTitle.textContent = parse._source.title;
        modalBody.innerHTML = body;
    };
    xhttp.open("GET", "/api/news/" + id, true);
    xhttp.send();
}
