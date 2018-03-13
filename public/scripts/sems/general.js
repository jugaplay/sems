function simpleAlert(title,message){
  bootbox.dialog({
    message: message,
    title: title,
    buttons: {
      success: {
        label: 'Aceptar',
        className: 'btn-success'
      }
    }
  });
}
