    document.addEventListener("DOMContentLoaded", function () {
        // Handling View Category Modal
        var viewButtons = document.querySelectorAll(".view-category");
        viewButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                document.getElementById("modal-id").textContent = button.getAttribute("data-id");
                document.getElementById("modal-name").textContent = button.getAttribute("data-name");
                document.getElementById("modal-slug").textContent = button.getAttribute("data-slug");
                document.getElementById("modal-code").textContent = button.getAttribute("data-id");
                // document.getElementById("modal-code").textContent = button.getAttribute("data-code") || "N/A";
                document.getElementById("modal-note").textContent = button.getAttribute("data-note") || "N/A";
                document.getElementById("modal-status").textContent = button.getAttribute("data-status");
                document.getElementById("modal-category").textContent = button.getAttribute("data-category") || "N/A";
            });
        });

        // Handling Delete Category Modal
        var deleteButtons = document.querySelectorAll(".delete-category");
        var deleteForm = document.getElementById("deleteForm");
        deleteButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                var url = button.getAttribute("data-url");
                deleteForm.action = url; // Update form action dynamically
            });
        });
    });

    document.getElementById('perPageSelect').addEventListener('change', function() {
        let perPage = this.value;
        let url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    });
