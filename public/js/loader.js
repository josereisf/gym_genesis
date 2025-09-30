// loader.js

// dispara logo que o DOM estiver pronto
$(document).ready(function() {
  let start = performance.now();

  console.log("⏳ Página começou a carregar... (DOM pronto em " + (start / 1000).toFixed(2) + "s)");
});

// dispara só quando TUDO estiver carregado
$(window).on("load", function() {
  let loadTime = performance.now();

  let fadeOutTime = Math.max(800, Math.min(loadTime, 3000));
  let fadeInTime  = fadeOutTime / 2;

  console.log("✅ Tudo carregado! Loader vai durar: " + (fadeOutTime / 1000).toFixed(2) + "s");

  $("#loader-wrapper").fadeOut(fadeOutTime, function() {
    $("#content").fadeIn(fadeInTime);
  });
});
