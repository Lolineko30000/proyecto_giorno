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