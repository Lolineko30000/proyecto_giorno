const transport = document.querySelector('.transport')
const btnPopT= document.querySelector('.btnTransport')
const iconCloseT= document.querySelector('.closeT')

btnPopT.addEventListener('click', () => {
    transport.classList.add('active-popup');//cambiar el nombre de la clase transport a transport active-popup en html
});
iconCloseT.addEventListener('click', () => {
    transport.classList.remove('active-popup');//regresar el nombre orignal de la clase transport
});

const viajes = document.querySelector('.viajes')
const btnPopV = document.querySelector('.btnViajes')
const iconCloseV = document.querySelector('.closeV')

btnPopV.addEventListener('click', () => {
    viajes.classList.add('active-popup');//cambiar el nombre de la clase transport a transport active-popup en html
});
iconCloseV.addEventListener('click', () => {
    viajes.classList.remove('active-popup');//regresar el nombre orignal de la clase transport
});

const hotel = document.querySelector('.hotel')
const btnPopH = document.querySelector('.btnHoteles')
const iconCloseH = document.querySelector('.closeH')

btnPopH.addEventListener('click', () => {
    hotel.classList.add('active-popup');//cambiar el nombre de la clase transport a transport active-popup en html
});
iconCloseH.addEventListener('click', () => {
    hotel.classList.remove('active-popup');//regresar el nombre orignal de la clase transport
});
