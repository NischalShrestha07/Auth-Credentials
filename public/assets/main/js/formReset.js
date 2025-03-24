document.getElementById("resetButton").addEventListener("click", function () {
    let form = document.getElementById("form");

    // Reset original form elements
    form.reset();

    // Clear dynamically added fields (text inputs, dropdowns, file inputs) dynamic-field
    document.querySelectorAll(".dynamic-field").forEach((field) => {
        if (field.tagName === "SELECT") {
            field.selectedIndex = 0; // Reset dropdown to first option
        } else {
            field.value = ""; // Clear other inputs
        }
    });
});
