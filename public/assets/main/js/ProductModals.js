// JavaScript for handling dynamic URL for delete
document.querySelectorAll(".delete-category").forEach(function (button) {
    button.addEventListener("click", function () {
        // Get the URL from the data-url attribute of the clicked button
        const url = this.getAttribute("data-url");

        // Set the action of the delete form to the dynamic URL
        document.getElementById("delete-form").action = url;
    });
});

// JavaScript for handling dynamic population of modal data
document.querySelectorAll(".view-details").forEach(function (button) {
    button.addEventListener("click", function () {
        // Get data from the data-* attributes of the clicked button
        var imageUrl = this.getAttribute("data-image");
        const id = this.getAttribute("data-id");
        const itemName = this.getAttribute("data-item-name");
        const itemCode = this.getAttribute("data-item-code");
        const itemModel = this.getAttribute("data-item-model");
        const brand = this.getAttribute("data-brand");
        const slug = this.getAttribute("data-slug");
        const unit = this.getAttribute("data-unit");
        const tax = this.getAttribute("data-tax");
        const taxType = this.getAttribute("data-tax-type");
        const status = this.getAttribute("data-status");
        const regularPrice = this.getAttribute("data-regular-price");
        const discount = this.getAttribute("data-discount");
        const sellingPrice = this.getAttribute("data-selling-price");
        const note = this.getAttribute("data-note");
        const subCat = this.getAttribute("data-sub-cat");

        // Set the values in the modal fields
        document.getElementById("modal-image").src = imageUrl;
        document.getElementById("modal-id").textContent = id;
        document.getElementById("modal-item-name").textContent = itemName;
        document.getElementById("modal-item-code").textContent = itemCode;
        // document.getElementById("modal-item-code").textContent = itemCode;
        document.getElementById("modal-item-model").textContent = itemModel;
        document.getElementById("modal-brand").textContent = brand;
        document.getElementById("modal-slug").textContent = slug;
        document.getElementById("modal-unit").textContent = unit;
        document.getElementById("modal-tax").textContent = tax;
        document.getElementById("modal-tax-type").textContent = taxType;
        document.getElementById("modal-status").textContent = status;
        document.getElementById("modal-regular-price").textContent =
            regularPrice;
        document.getElementById("modal-discount").textContent = discount;
        document.getElementById("modal-selling-price").textContent =
            sellingPrice;
        document.getElementById("modal-note").textContent = note;
        document.getElementById("modal-sub-category").textContent = subCat;
    });
});

document.getElementById('perPageSelect').addEventListener('change', function() {
    let perPage = this.value;
    let url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    url.searchParams.set('page', 1);
    window.location.href = url.toString();
});
