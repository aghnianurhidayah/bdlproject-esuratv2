document.addEventListener("DOMContentLoaded", function () {
  // Aman dari duplikasi deklarasi
  const navBar = document.querySelector("nav");
  const menuBtns = document.querySelectorAll(".menu-icon");
  const overlay = document.querySelector(".overlay");
  const modeGelap = document.getElementById("dark-mode");

  if (navBar && menuBtns.length > 0) {
    menuBtns.forEach((menuBtn) => {
      menuBtn.addEventListener("click", () => {
        navBar.classList.toggle("open");
      });
    });
  }

  if (overlay && navBar) {
    overlay.addEventListener("click", () => {
      navBar.classList.remove("open");
    });
  }

  if (modeGelap) {
    modeGelap.addEventListener("click", function () {
      document.body.classList.toggle("dark-mode");
    });
  }

  // Fungsi untuk memuat detail surat jika ada ID di URL
  const suratId = getSuratIdFromURL();
  if (suratId) {
    const detailForm = document.getElementById("detail-form");
    if (detailForm) {
      let targetURL = "";

      if (suratId.startsWith("DOM")) {
        targetURL = "detail/keterangan_domisili.php?surat_id=" + suratId;
      } else if (suratId.startsWith("LHR")) {
        targetURL = "detail/keterangan_kelahiran.php?surat_id=" + suratId;
      } else if (suratId.startsWith("KMT")) {
        targetURL = "detail/keterangan_kematian.php?surat_id=" + suratId;
      } else if (suratId.startsWith("KTM")) {
        targetURL = "detail/keterangan_tidak_mampu.php?surat_id=" + suratId;
      } else if (suratId.startsWith("EKTP")) {
        targetURL = "detail/pengantar_e_ktp.php?surat_id=" + suratId;
      } else if (suratId.startsWith("NKH")) {
        targetURL = "detail/pengantar_nikah.php?surat_id=" + suratId;
      } else if (suratId.startsWith("KCK")) {
        targetURL = "detail/pengantar_skck.php?surat_id=" + suratId;
      } else if (suratId.startsWith("AKL")) {
        targetURL = "detail/pernyataan_akte_kelahiran.php?surat_id=" + suratId;
      } else if (suratId.startsWith("STS")) {
        targetURL = "detail/pernyataan_status.php?surat_id=" + suratId;
      } else {
        detailForm.innerHTML = "<p>Jenis surat tidak dikenali.</p>";
        return;
      }

      fetch(targetURL)
        .then((response) => response.text())
        .then((html) => {
          detailForm.innerHTML = html;
        })
        .catch((error) => {
          detailForm.innerHTML = "<p>Gagal memuat detail surat.</p>";
          console.error(error);
        });
    }
  }
});

// Fungsi untuk mengambil ID surat dari URL
function getSuratIdFromURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get("surat_id") || "";
}

// Validasi input angka
function isInputNumber(evt) {
  var char = String.fromCharCode(evt.which);
  if (!/[0-9]/.test(char)) {
    evt.preventDefault();
  }
}

// Load form dari dropdown
function loadForm(select) {
  const selectedValue = select.value;
  const formContainer = document.getElementById("form-container");

  if (!formContainer) return;

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

function initLaporanFilter() {
  $(document).ready(function () {
    function fetchFilteredData() {
      const data = {
        ta: $("#ta").val(),
        ti: $("#ti").val(),
        jenis_surat: $("#jenis_surat").val(),
        status: $("#status").val(),
      };

      $.ajax({
        url: "filter_laporan.php",
        type: "POST",
        data: data,
        dataType: "json",
        success: function (response) {
          let tbody = "";
          if (response.length > 0) {
            $.each(response, function (index, item) {
              tbody += `
                <tr>
                  <td>${index + 1}</td>
                  <td>${item.tgl_masuk}</td>
                  <td>${item.jenis_surat}</td>
                  <td>${item.status}</td>
                  <td>${item.jumlah}</td>
                </tr>`;
            });
          } else {
            tbody =
              '<tr><td colspan="5" style="text-align:center;">Data tidak ditemukan</td></tr>';
          }
          $("table tbody").html(tbody);
        },
        error: function () {
          alert("Terjadi kesalahan saat memuat data.");
        },
      });
    }

    fetchFilteredData();

    $("#ta, #ti, #jenis_surat, #status").on("change", function () {
      fetchFilteredData();
    });
  });
}