document.addEventListener("DOMContentLoaded", function () {
    var deleteButtons = document.querySelectorAll(".delete-category");
    var deleteForm = document.getElementById("deleteForm");

    deleteButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var deleteUrl = button.getAttribute("data-url"); // Fetch URL from button
            deleteForm.action = deleteUrl; // Set the form action dynamically
        });
    });
});


document.addEventListener("DOMContentLoaded", function() {
    // Get the modal
    var viewModal = document.getElementById("viewModal");

    // When the modal is about to be shown
    viewModal.addEventListener("show.bs.modal", function(event) {
        var button = event.relatedTarget; // Button that triggered the modal

        // Get data attributes from the clicked button
        var id = button.getAttribute("data-id");
        var name = button.getAttribute("data-name");
        var slug = button.getAttribute("data-slug");
        var code = button.getAttribute("data-code") || "N/A";
        var note = button.getAttribute("data-note") || "N/A";
        var status = button.getAttribute("data-status");

        // Set modal values
        document.getElementById("modal-id").textContent = id;
        document.getElementById("modal-name").textContent = name;
        document.getElementById("modal-slug").textContent = slug;
        // document.getElementById("modal-code").textContent = code;
        document.getElementById("modal-code").textContent = id;
        document.getElementById("modal-note").textContent = note;
        document.getElementById("modal-status").textContent = status;
    });
});


//for changing per_page
document.getElementById('perPageSelect').addEventListener('change', function() {
    let perPage = this.value;
    let url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    url.searchParams.set('page', 1);
    window.location.href = url.toString();
});
