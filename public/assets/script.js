document.addEventListener("DOMContentLoaded", function () {
    navActive();
});

function navActive() {
    const navItems = document.querySelectorAll(".nav-item .nav-link");
    const currentPage = window.location.pathname.split("/").pop();

    navItems.forEach(function (navLink) {
        if (navLink.getAttribute("href") === currentPage) {
            navLink.classList.add("active");
        } else {
            navLink.classList.remove("active");
        }
    });
}
