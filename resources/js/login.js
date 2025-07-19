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
    .getElementById("toggleBarangayID")
    .addEventListener("click", () =>
        toggleVisibility("barangayID", "toggleBarangayID")
    );

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".containers");

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
});
