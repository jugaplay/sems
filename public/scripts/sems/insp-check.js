/* Usuarios sin login */
(function(){
  $('.my-form').on('submit', function () {
    bootbox.dialog({
    message: '<p>El estacionamiento esta vencido</p><p>Algun detalle para la foto de la multa</p>',
    title: 'Estacionamiento vencido!',
    buttons: {
      success: {
        label: 'Tomar fotos',
        className: 'btn-success',
        callback: function() {
          alert("Abre camara");
        }
      }
    }
  });
  return false;
});

})(window);
