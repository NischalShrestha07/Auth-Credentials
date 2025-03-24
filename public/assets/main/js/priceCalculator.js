document.addEventListener("DOMContentLoaded", function () {
    function calculateSellingPrice() {
        let regularPrice =
            parseFloat(document.getElementById("regularPrice").value) || 0;
        let discount =
            parseFloat(document.getElementById("discount").value) || 0;
        let tax = parseFloat(document.getElementById("tax").value) || 0;
        let taxType = document.getElementById("taxType").value;
        let sellingPriceField = document.getElementById("sellingPrice");

        let priceWithVAT = regularPrice;

        if (taxType === "exclusive") {
            priceWithVAT = regularPrice + regularPrice * (tax / 100); // Add VAT to Regular Price
        }

        let discountedPrice = priceWithVAT - priceWithVAT * (discount / 100); // Apply Discount

        sellingPriceField.value = discountedPrice.toFixed(2);
    }

    // Attach event listeners to fields
    document
        .getElementById("regularPrice")
        .addEventListener("input", calculateSellingPrice);
    document
        .getElementById("discount")
        .addEventListener("input", calculateSellingPrice);
    document
        .getElementById("tax")
        .addEventListener("change", calculateSellingPrice);
    document
        .getElementById("taxType")
        .addEventListener("change", calculateSellingPrice);
});
