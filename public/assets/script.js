document.addEventListener("DOMContentLoaded", function () {
  navActive();
});
console.log(window.location.pathname.split("/").pop());
function navActive() {
  const navItems = document.querySelectorAll(".nav-item .nav-link");
  const currentPage = window.location.origin + window.location.pathname;

  navItems.forEach(function (navLink) {
    if (navLink.getAttribute("href") === currentPage) {
      navLink.classList.add("active");
    } else {
      navLink.classList.remove("active");
    }
  });
}
