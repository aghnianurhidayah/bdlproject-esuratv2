const navBar = document.querySelector("nav"),
  menuBtns = document.querySelectorAll(".menu-icon"),
  overlay = document.querySelector(".overlay");
modeGelap = document.getElementById("dark-mode");

menuBtns.forEach((menuBtn) => {
  menuBtn.addEventListener("click", () => {
    navBar.classList.toggle("open");
  });
});

overlay.addEventListener("click", () => {
  navBar.classList.remove("open");
});

modeGelap.addEventListener("click", function () {
  document.body.classList.toggle("dark-mode");
});

function isInputNumber(evt) {
  var char = String.fromCharCode(evt.which);
  if (!/[0-9]/.test(char)) {
    evt.preventDefault();
  }
}
