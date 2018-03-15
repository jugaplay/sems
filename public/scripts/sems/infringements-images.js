// [-43.30062290009731,-65.1072911945994]
// dialog.modal('hide') // Para esconder todos
function newInfringement(infringement){
  var html=''
  +'<p>Suba al menos una foto del vehículo.</p>'
  +' <input type="file" name="preview" id="preview" accept="image/*" onchange="uploadPhotos(this)">'
  +'      <img src="" id="compress_img" style="display:none;">'
  +' <form role="form" class="my-form" id="myImgForm">'
  +'      <input type="hidden" name="infringementId" value="'+infringement.id+'">'
  +'      <input type="hidden" id="infringementImg" name="infringementImg" value="">'
  +'      <input type="hidden" name="_token" value="'+window.ajax_token+'">'
  +' </form>';
  bootbox.dialog({
    message: html,
    title: "Cargar fotos",
    buttons: {
      success: {
        label: 'Cargar foto',
        className: 'btn-success',
        callback: function() {
          if($("#infringementImg").val().length>0){
            uploadInfractionImage($("#myImgForm").serializeArray(),infringement.id);
            return true;
          }else{
            toastr.error("Debe subir al menos una foto");
            return false;
          }
        }
      }
    }
  });
}
// Cargar imagenes al servidor
function uploadInfractionImage(datas,infringementId){
  toastr.info('Cargando imagen <i class="fa fa-spin fa-spin-2x fa-spinner fa-fw"></i>');
  var jqxhr = $.ajax({
                  method: "POST",
                  url: "infringements/img",
                  data: datas
                })
                .done(function(xhr) {
                  toastr.success( 'Imagen cargada con éxito' );
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{ toastr.error('Error: '+JSON.parse(xhr.responseText).error); }
                });
  loadMoreFotosToServer(infringementId);
}
// Si ya tiene una infraccion
function hasInfringement(infringement){
  bootbox.dialog({
    message: "La patente <b>"+infringement.plate+"</b> tiene una infracción realizada hoy </br>¿Desea cargarle más fotos a la infracción?",
    title: "¿Desea cargar otra foto? ",
    buttons: {
      cancel: {
        label: 'Cerrar',
        className: 'btn-info'
      },
      success: {
        label: 'Cargar fotos',
        className: 'btn-success',
        callback: function() {
          loadMoreFotosToServer(infringement.id);
          return true;
        }
      }
    }
  });
}
// Cargar mas fotos al servidor
function loadMoreFotosToServer(infringementId){
  var html=''
  +'<p>¿Desea cargar otra foto a la infracción?</p>'
  +' <input type="file" name="preview" id="preview" accept="image/*" onchange="uploadPhotos(this)">'
  +'      <img src="" id="compress_img" style="display:none;">'
  +' <form role="form" class="my-form" id="myImgForm">'
  +'      <input type="hidden" name="infringementId" value="'+infringementId+'">'
  +'      <input type="hidden" id="infringementImg" name="infringementImg" value="">'
  +'      <input type="hidden" name="_token" value="'+window.ajax_token+'">'
  +' </form>';
  bootbox.dialog({
    message: html,
    title: "¿Desea cargar otra foto? ",
    buttons: {
      cancel: {
        label: 'Cerrar',
        className: 'btn-info'
      },
      success: {
        label: 'Cargar foto',
        className: 'btn-success',
        callback: function() {
          if($("#infringementImg").val().length>0){
            uploadInfractionImage($("#myImgForm").serializeArray(),infringementId);
            return true;
          }else{
            toastr.error("Debe cargar una foto");
            return false;
          }
        }
      }
    }
  });
}
// Funciones para la imagenes
function uploadPhotos(inputElement) {
   var output_format = 'jpg';
   var fileImg = inputElement.files[0];
   var maxWidthHeight=1280;//1280;
   var target=document.getElementById('compress_img');
    ImageTools.resize(fileImg, {
        width: maxWidthHeight, // maximum width
        height: maxWidthHeight // maximum height
    }, function(blob, didItResize) {
        // didItResize will be true if it managed to resize it, otherwise false (and will return the original file as 'blob')
        target.src = window.URL.createObjectURL(blob);
        target.onload = function() {
          // Comprime en 72 Dpi
          target.src = jic.compress(target,72,output_format).src;
          target.onload = function() {
                $("#infringementImg").val(target.src);
                console.log("Imagen lista");
            };
         };
    });
}
// El BlobBuilder
function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;
        var byteCharacters = atob(b64Data);
        var byteArrays = [];
        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);
            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }
            var byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }
      var blob = new Blob(byteArrays, {type: contentType});
      return blob;
}
