'use strict';

function likeBtn(event) {
    if (getCookie('user') != "") {
        const element_box = event.closest('.box');
        const id = element_box.dataset.id;
        let favourites = getCookie('fa_list');
        if (favourites == "") {
            event.classList.add('_liked');
            toggleLike(id);
        }
        else {
            let fa_list = favourites.split('%2C');
            for (let i = 0; i < fa_list.length; i++) {
                if (fa_list[i] == id) {
                    event.classList.remove('_liked');
                    toggleLike(id);
                    return 0;
                }
            }
            event.classList.add('_liked');
            toggleLike(id);

        }
    }
    else {
        window.open('auth.html', '_self');
    }
}

function cartBtn(event) {
    if (getCookie('user') != "") {
        const element_box = event.closest('.box');
        const id = element_box.dataset.id;0
        let cart = getCookie('cart_list');
        if (cart == "") {
            event.classList.add('_incart');
            event.innerHTML = "Убрать";
            toggleCart(id);
        }
        else {
            let cart_list = cart.split('%2C');
            for (let i = 0; i < cart_list.length; i++) {
                if (cart_list[i] == id) {
                    event.innerHTML = "Добавить"; 
                    event.classList.remove('_incart');
                    toggleCart(id);
                    return 0;
                }
            }
            event.classList.add('_incart');
            event.innerHTML = "Убрать";
            toggleCart(id);

        }
    }
    else {
        window.open('auth.html', '_self');
    }
}

function toggleLike(id) {
    const options = {
        method: 'POST', // указываем метод запроса
        headers: {
        'Content-Type': 'text/plain' // указываем тип содержимого (text/plain для текста)
        },
        body: id // указываем id
    };
    
    fetch("../php/addfa.php", options);
}

function toggleCart(id) {
    const options = {
        method: 'POST', // указываем метод запроса
        headers: {
        'Content-Type': 'text/plain' // указываем тип содержимого (text/plain для текста)
        },
        body: id // указываем id
    };
    
    fetch("../php/addcart.php", options);
}

function getCookie(name) {
    const cookies = document.cookie.split("; ");
    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].split("=");
      if (cookie[0] === name) {
        return cookie[1];
      }
    }
    return "";
}