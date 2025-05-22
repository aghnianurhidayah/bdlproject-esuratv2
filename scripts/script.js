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

// function loadForm(select) {
//   const selectedValue = select.value;
//   const formContainer = document.getElementById("form-container");

//   if (selectedValue === "") {
//     formContainer.innerHTML = "";
//     return;
//   }

//   fetch(`surat/${selectedValue}.php`)
//     .then((response) => {
//       if (!response.ok) throw new Error("Form gagal dimuat");
//       return response.text();
//     })
//     .then((html) => {
//       formContainer.innerHTML = html;

//       // Ambil form yang baru dimuat
//       const loadedForm = formContainer.querySelector("form");

//       if (loadedForm) {
//         loadedForm.addEventListener("submit", function (e) {
//           e.preventDefault(); // Mencegah submit default

//           const formData = new FormData(loadedForm);

//           fetch(loadedForm.action, {
//             method: loadedForm.method,
//             body: formData,
//           })
//             .then((response) => response.text())
//             .then((result) => {
//               formContainer.innerHTML = result;

//               // Jika ingin redirect setelah submit sukses
//               if (result.includes("Formulir Berhasil Diisi")) {
//                 alert("Formulir Berhasil Diisi!");
//                 window.location.href = "hist.php";
//               }
//             })
//             .catch((error) => {
//               console.error("Gagal mengirim form:", error);
//               alert("Terjadi kesalahan saat mengirim formulir.");
//             });
//         });
//       }
//     });
// }

function loadForm(select) {
  const selectedValue = select.value;
  const formContainer = document.getElementById("form-container");

  if (selectedValue === "") {
    formContainer.innerHTML = "";
    return;
  }

  fetch(`surat/${selectedValue}.php`)
    .then((response) => {
      if (!response.ok) throw new Error("Form gagal dimuat");
      return response.text();
    })
    .then((html) => {
      formContainer.innerHTML = html;
    })
    .catch((error) => {
      formContainer.innerHTML = "<p>Terjadi kesalahan saat memuat form.</p>";
      console.error(error);
    });
}