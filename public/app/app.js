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
        if (window.innerWidth > 600) {
            menuList.style.display = "flex"
        }
        else if (window.innerWidth <= 600) {
            menuList.style.display = "none";
            menuButton.textContent = " Menu ";
        }
    }, 75)
});

menuButton.addEventListener("click", toggleMenu);


const searching = (e, list) => {
    let value = e.target.value; // Get the search value
    console.log('recherche' + value + list);
}


try {
    let list = document.getElementsByClassName('client');
    let search = document.getElementById('search-bar');
    let arr = Array.from(list); // Converti l'HTML collection en Array

    search.addEventListener("keyup", function () {
        let value = search.value.toLowerCase(); // Get the search value

        arr.forEach(elm => {
            let searchWord = elm.textContent.replace(/ /g, ""); // Remplace les espaces dans la liste <li>
            elm.classList.remove('hide');                       // Reinitialise le tableau de <li>
            if (!(searchWord.toLowerCase().indexOf(value.replace(/ /g, "")) >= 0))
            {
                elm.classList.add('hide');                         // Cache tous les <li> qui ne correspondent pas
            }
        });
    });
}

catch {}