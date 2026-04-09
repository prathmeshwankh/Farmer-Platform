// Validate form
function validateForm() {
    let phone = document.querySelector("input[name='phone']").value;

    if (phone.length !== 10) {
        alert("Enter valid 10-digit mobile number");
        return false;
    }

    return true;
}

// Show message on load
window.onload = function () {
    console.log("Farmer Platform Loaded 🚜");
};