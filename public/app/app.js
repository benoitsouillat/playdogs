let menuButton = document.getElementById('menu-btn');
let menuList = document.getElementById('menu-list');

let btnStyle = window.getComputedStyle(menuButton);
let listStyle = window.getComputedStyle(menuList);

if (listStyle.display === 'flex')
{
    menuButton.textContent = "Fermer";
}
else 
{
    menuButton.textContent = " Menu ";
}

const toggleMenu = () => {

    if(menuButton.textContent === "Fermer")
    {
        menuList.style.display = "none";
        menuButton.textContent = " Menu ";
    }
    else
    {
        menuList.style.display = "flex";
        menuButton.textContent = "Fermer";
    }
}

let theTimer;
window.addEventListener('resize', function () {
    clearTimeout(theTimer);
    theTimer = setTimeout(function () {
        if (window.innerWidth > 550) {
            menuList.style.display = "flex"
        }
        else if (window.innerWidth <= 550) {
            menuList.style.display = "none";
            menuButton.textContent = " Menu ";
        }
    }, 75)
});

menuButton.addEventListener("click", toggleMenu);


const searching = () => {
    console.log('recherche');
}


try {
    let search = document.getElementById('search-bar');
    search.addEventListener("keyup", searching);
}

catch {}