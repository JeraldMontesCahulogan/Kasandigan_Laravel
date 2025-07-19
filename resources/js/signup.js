function toggleVisibility(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId).querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash"); // Change to eye-slash
    } else {
        input.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye"); // Change to eye
    }
}

document
    .getElementById("togglePassword")
    .addEventListener("click", () =>
        toggleVisibility("password", "togglePassword")
    );
document
    .getElementById("toggleConfirmPassword")
    .addEventListener("click", () =>
        toggleVisibility("password_confirmation", "toggleConfirmPassword")
    );
document
    .getElementById("toggleBarangayID")
    .addEventListener("click", () =>
        toggleVisibility("barangayID", "toggleBarangayID")
    );
