function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const toggle = document.getElementById("menu-toggle");
    const toggleReverse = document.getElementById("menu-toggle-reverse");

    sidebar.classList.toggle("shrink");
    toggle.classList.toggle("hidden");
    toggleReverse.classList.toggle("hidden");

    const links = document.querySelectorAll(".navLink");
    links.forEach((link) => {
        if (sidebar.classList.contains("shrink")) {
            link.setAttribute(
                "title",
                link.querySelector(".sidebar-content").textContent
            );
        } else {
            link.removeAttribute("title");
        }
    });

    const link = document.querySelectorAll(".navLinks");
    link.forEach((links) => {
        if (sidebar.classList.contains("shrink")) {
            links.setAttribute(
                "title",
                links.querySelector(".sidebar-content").textContent
            );
        } else {
            links.removeAttribute("title");
        }
    });

    // Save sidebar state in localStorage
    if (sidebar.classList.contains("shrink")) {
        localStorage.setItem("sidebarState", "shrink");
    } else {
        localStorage.setItem("sidebarState", "expanded");
    }
}

document.getElementById("menu-toggle").addEventListener("click", toggleSidebar);
document.getElementById("menu-toggle-reverse").addEventListener("click", toggleSidebar);

document.addEventListener("DOMContentLoaded", () => {
    window.addEventListener("resize", function () {
        const sidebar = document.getElementById("sidebar");

        if (window.innerWidth <= 1400) {
            sidebar.classList.add("shrink");
            document.getElementById("menu-toggle").classList.add("hidden");
            document
                .getElementById("menu-toggle-reverse")
                .classList.remove("hidden");
            localStorage.setItem("sidebarState", "shrink");
        } else {
            sidebar.classList.remove("shrink");
            document.getElementById("menu-toggle").classList.remove("hidden");
            document
                .getElementById("menu-toggle-reverse")
                .classList.add("hidden");
            localStorage.setItem("sidebarState", "expanded");
        }
    });
});
