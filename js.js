function toggleNavMenuDisplay() {
    const navmenu = document.getElementById('navmenu');
    const logincontainer = document.getElementById('logincontainer__form');

    if (navmenu.style.display === 'none' || navmenu.style.display === '') {
        if (logincontainer.style.display !== 'flex') {
            navmenu.style.display = 'flex';
        } else {
            
        }
    } else {
        navmenu.style.display = 'none';
    }
}

function toggleLoginContainerDisplay() {
    const logincontainer = document.getElementById('logincontainer__form');
    const navmenu = document.getElementById('navmenu');

    if (logincontainer.style.display === 'none' || logincontainer.style.display === '') {
        if (navmenu.style.display !== 'flex') {
            logincontainer.style.display = 'flex';
            logincontainer.style.zIndex = '11';  // Para asegurarse de que se muestre sobre navmenu
        } else {
            
        }
    } else {
        logincontainer.style.display = 'none';
        logincontainer.style.zIndex = '-1';  // Resetea el z-index cuando se oculta
    }
}
function toggleNavMenuDisplaycolor() {
    const mainnav = document.getElementById("mainnav")
    if (mainnav.style.backgroundColor === "#fff" || mainnav.style.backgroundColor === "") {
        mainnav.style.backgroundColor = "#222"
    }
    else{
        mainnav.style.backgroundColor = "#fff"
        mainnav.style.backgroundColor = ""
    }
}


function ToggleColorEventid () {
    const mainbck__dark = document.getElementById ("mainbck__dark");
    const h1color__darktheme = document.getElementById("h1color__darktheme");
    const h2color__darktheme = document.getElementById("h2color__darktheme");

    if (h2color__darktheme.style.color === "#222" || h2color__darktheme.style.color === "") {
        h2color__darktheme.style.color = "#fff"
    }
    else{
        h2color__darktheme.style.color = "#222"
        h2color__darktheme.style.color = ""
    }
    if (h1color__darktheme.style.color === "#222" || h1color__darktheme.style.color === "") {
        h1color__darktheme.style.color = "#fff"
    }
    else{
        h1color__darktheme.style.color = "#222"
        h1color__darktheme.style.color = ""
    }
    if (mainbck__dark.style.backgroundColor === "#fff" || mainbck__dark.style.backgroundColor === "") {
        mainbck__dark.style.backgroundColor = "#222"
    }  
    else{
        mainbck__dark.style.backgroundColor ="#fff"
        mainbck__dark.style.backgroundColor =""
    } 
}
function ToggleColorEventclass() {
    const h2__flexstart = document.getElementsByClassName("h2__flexstart");
    
    for (let i = 0; i < h2__flexstart.length; i++) {
        if (h2__flexstart[i].style.color === "rgb(34, 34, 34)" || h2__flexstart[i].style.color === "") {
            h2__flexstart[i].style.color = "#fff";
        } else {
            h2__flexstart[i].style.color = "#222";
        }
    }
}
function ToggleColorEventsummary(){
    const summary = document.getElementsByTagName("summary");
    
    for (let i = 0; i < summary.length; i++) {
        if (summary[i].style.color === "rgb(34, 34, 34)" || summary[i].style.color === "") {
            summary[i].style.color = "#fff";
        } else {
            summary[i].style.color = "#222";
        }
    }
}
function togglebackgroundcolorFt () {
    const footer__darktheme = document.getElementById("footer__darktheme") 

    if (footer__darktheme.style.backgroundColor === "#fff" || footer__darktheme.style.backgroundColor === "") {
        footer__darktheme.style.backgroundColor = "#222" 
    }
    else{
        footer__darktheme.style.backgroundColor = "#fff" 
        footer__darktheme.style.backgroundColor = "" 
    }

}

function toggleColorh2footeritem(){
    const footer__item  = document.getElementsByClassName("footer__item ");
    
    for (let i = 0; i < footer__item.length; i++) {
        if (footer__item [i].style.color === "rgb(34, 34, 34)" || footer__item [i].style.color === "") {
            footer__item [i].style.color = "#fff";
        } else {
            footer__item [i].style.color = "#222";
        }
    }
}
function toggleColorh2footeritem(){
    const footer__item  = document.getElementsByClassName("footer__item ");
    
    for (let i = 0; i < footer__item.length; i++) {
        if (footer__item [i].style.color === "rgb(34, 34, 34)" || footer__item [i].style.color === "") {
            footer__item [i].style.color = "#fff";
        } else {
            footer__item [i].style.color = "#222";
        }
    }
}
function toggleFilterButton(){
    const b__filter  = document.getElementsByClassName("b__filter ");
    
    for (let i = 0; i < b__filter.length; i++) {
        if (b__filter [i].style.filter === "grayscale(100%)" || b__filter [i].style.color === "") {
            b__filter [i].style.filter = "none";
        } else {
            b__filter [i].style.color = "grayscale(100%)";
        }
    }
}

var buttons = document.querySelectorAll('.flexstart__b');
var contents = document.querySelectorAll('.ddpm__button');

buttons.forEach(function(button) {
    button.addEventListener('click', function() {
        var targetContentId = this.getAttribute('aria-controls');
        var targetContent = document.getElementById(targetContentId);
        var isExpanded = this.getAttribute('aria-expanded') === 'true';

        // Ocultar todos los contenidos y restablecer aria-expanded
        contents.forEach(function(content) {
            content.classList.remove('flex');
            content.setAttribute('aria-expanded', 'false');
        });
        buttons.forEach(function(btn) {
            btn.setAttribute('aria-expanded', 'false');
        });

        // Si el contenedor objetivo no está expandido, mostrarlo
        if (!isExpanded) {
            targetContent.classList.add('flex');
            targetContent.setAttribute('aria-expanded', 'true');
            this.setAttribute('aria-expanded', 'true');
        }
    });
});
