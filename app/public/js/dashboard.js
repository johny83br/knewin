/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/dashboard.js ***!
  \***********************************/
var newsModal = document.getElementById("news");
newsModal.addEventListener("show.bs.modal", function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget; // Extract info from data-bs-* attributes

  var id = button.getAttribute("data-id"); // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.

  var modalTitle = newsModal.querySelector(".modal-title");
  var modalBody = newsModal.querySelector(".modal-body");
  loadNews(id, modalTitle, modalBody); // modalTitle.textContent = "New message to " + recipient;
  // modalBodyInput.value = recipient;
});

function loadNews(id, modalTitle, modalBody) {
  var xhttp = new XMLHttpRequest();

  xhttp.onload = function () {
    var parse = JSON.parse(this.responseText);
    var body = "<b>Date:</b> ".concat(parse._source.created_at, "<br/><b>URL:</b> <a href=\"").concat(parse._source.url, "\" target=\"_blank\">").concat(parse._source.url, "</a><br/><b>Source:</b> ").concat(parse._source.source, "<br/><br/> ").concat(parse._source.content.replace(/(?:\r\n|\r|\n)/g, "<br>"));
    modalTitle.textContent = parse._source.title;
    modalBody.innerHTML = body;
  };

  xhttp.open("GET", "/api/news/" + id, true);
  xhttp.send();
}
/******/ })()
;