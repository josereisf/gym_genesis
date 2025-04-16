document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");

    // Abrir/fechar o sidebar
    sidebarToggle.addEventListener("click", function () {
      sidebar.classList.toggle("active");
      mainContent.classList.toggle("active");
    });

    // Fechar o sidebar ao clicar fora dele (em dispositivos móveis)
    document.addEventListener("click", function (event) {
      if (window.innerWidth <= 768 && !sidebar.contains(event.target)) {
        sidebar.classList.remove("active");
        mainContent.classList.remove("active");
      }
    });
  });
