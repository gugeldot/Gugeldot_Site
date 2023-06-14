window.addEventListener("scroll", function() {
  var navbar = document.getElementById("navigationBar");
  var scrollPosition = window.scrollY;

  if (scrollPosition > 50) {            // Ajusta la cantidad de desplazamiento a partir de la cual la opacidad cambia
    navbar.style.opacity = "0.8";       // Ajusta el nivel de opacidad deseado
    navbar.style.backgroundColor = "#6a00b8";
    navbar.style.borderRadius = "20px";
    navbar.style.margin = "10px";
    navbar.style.padding = "15px";
    navbar.style.width = "calc(98% - 20px)";
  } else {
    navbar.style.opacity = "1"; // Opacidad completa
    navbar.style.backgroundColor = "#202020";
    navbar.style.margin = "0px";
    navbar.style.borderRadius = "0px";
    navbar.style.width = "100%";
  }
});