// Un Js para que acompañe a todas las pantallas de los drivers
window.userLocation=[-43.29976679330353,-65.1062780839493];
function openBuyTickets(){
    var form = document.createElement("form");
    var element1 = document.createElement("input");
    var element2 = document.createElement("input");
    var latlng=JSON.stringify(window.userLocation); // Le envio el donde se encuenta

    form.method = "POST";
    form.action = window.apiUrl+"tickets/driverticket";

    element1.value=window.ajax_token;
    element1.name="_token";
    form.appendChild(element1);

    element2.value=latlng;
    element2.name="latlng";
    form.appendChild(element2);

    document.body.appendChild(form);

    form.submit();
}
