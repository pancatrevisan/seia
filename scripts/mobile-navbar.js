function menuNavbar() { /*abre o menu header responsivo*/
    var menu = window.document.querySelector(".menu-links");
    var mobileMenu = window.document.querySelector(".mobile-menu");
    var menuX = window.document.querySelector(".menuX");

    menu.style.display = "block";
    menu.style.marginRight = "70vw";
    menu.style.width = "70vw";
    menu.style.transition = "0.3s ease-in";
    menu.style.color = "#fff";

    mobileMenu.style.display = "none";
    menuX.style.display = "block";    
}

function fechaMenuNavbar() { /*fecha o menu header responsivo*/
    var menu = window.document.querySelector(".menu-links");
    var mobileMenu = window.document.querySelector(".mobile-menu");
    var menuX = window.document.querySelector(".menuX");

    menu.style.display = "none";
    menu.style.marginRight = "0";
    menu.style.width = "70vw";
    menu.style.transition = "0.3s ease-in";
    menu.style.color = "#fff";

    mobileMenu.style.display = "block";
    menuX.style.display = "none";  
}