// loader.js
$(window).on("load", function() {
  // medir tempo real de carregamento
  let loadTime = performance.now(); // milissegundos desde que a página começou a carregar

  // normalizar (tempo mínimo e máximo do fadeOut)
  let fadeOutTime = Math.max(800, Math.min(loadTime, 3000));
  let fadeInTime  = fadeOutTime / 2;

  // mostrar no console em segundos (com 2 casas decimais)
  console.log("⏳ Loader vai durar: " + (fadeOutTime / 1000).toFixed(2) + "s");

  $("#loader-wrapper").fadeOut(fadeOutTime, function() {
    $("#content").fadeIn(fadeInTime);
  });
});
