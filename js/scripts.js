const wrapper = document.querySelector('.wrapper')
const loginLink = document.querySelector('.login-link')
const registerLink = document.querySelector('.register-link')
const btnPop= document.querySelector('.btnLogin-popup')
const iconClose= document.querySelector('.icon-close')

registerLink.addEventListener('click', () => {
    wrapper.classList.add('active');//cambiar el nombre de la clase wrapper a wrapper active en html
});
loginLink.addEventListener('click', () => {
    wrapper.classList.remove('active');//regresar el nombre orignal de la clase wrapper
});

btnPop.addEventListener('click', () => {
    wrapper.classList.add('active-popup');//cambiar el nombre de la clase wrapper a wrapper active-popup en html
});
iconClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup');//regresar el nombre orignal de la clase wrapper
});

function changeImageAcapulco() { //Cambia las imágenes del hotel en acapulco
    var img = document.getElementById("imgAcapulco");
    if (img.src.match("./images/hoteles/Acapulco.jpg")){
        img.src = "./images/hoteles/Acapulco2.jpg";
    }else if (img.src.match("./images/hoteles/Acapulco2.jpg")){
        img.src = "./images/hoteles/Acapulco3.jpg";
    }else if (img.src.match("./images/hoteles/Acapulco3.jpg")){
        img.src = "./images/hoteles/Acapulco4.jpg";
    }else if (img.src.match("./images/hoteles/Acapulco4.jpg")){
        img.src = "./images/hoteles/Acapulco5.jpg";
    }else if (img.src.match("./images/hoteles/Acapulco5.jpg")){
        img.src = "./images/hoteles/Acapulco.jpg";
    }
}

function changeImageCancun() {//Cambia las imágenes del hotel en cancun
    var img = document.getElementById("imgCancun");
    if (img.src.match("./images/hoteles/Cancun.jpg")){
        img.src = "./images/hoteles/Cancun2.jpg";
    }else if (img.src.match("./images/hoteles/Cancun2.jpg")){
        img.src = "./images/hoteles/Cancun3.jpg";
    }else if (img.src.match("./images/hoteles/Cancun3.jpg")){
        img.src = "./images/hoteles/Cancun4.jpg";
    }else if (img.src.match("./images/hoteles/Cancun4.jpg")){
        img.src = "./images/hoteles/Cancun5.jpg";
    }else if (img.src.match("./images/hAcapulcooteles/Cancun5.jpg")){
        img.src = "./images/hoteles/Cancun.jpg";
    }
}

function changeImageVallarta() {//Cambia las imágenes del hotel en pto vallarta
    var img = document.getElementById("imgPuertoVallarta");
    if (img.src.match("./images/hoteles/PuertoVallarta.jpg")){
        img.src = "./images/hoteles/PuertoVallarta2.jpg";
    }else if (img.src.match("./images/hoteles/PuertoVallarta2.jpg")){
        img.src = "./images/hoteles/PuertoVallarta3.jpg";
    }else if (img.src.match("./images/hoteles/PuertoVallarta3.jpg")){
        img.src = "./images/hoteles/PuertoVallarta4.jpg";
    }else if (img.src.match("./images/hoteles/PuertoVallarta4.jpg")){
        img.src = "./images/hoteles/PuertoVallarta5.jpg";
    }else if (img.src.match("./images/hoteles/PuertoVallarta5.jpg")){
        img.src = "./images/hoteles/PuertoVallarta.jpg";
    }
}