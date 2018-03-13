@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">CHEQUEAR ESTACIONAMIENTOS</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>
        <!-- /.content-hero -->

        <div class="content-body">

            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Datos a chequear</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" class="my-form"  id="ticketFormControl">
                                <p>
                                    <i class="fa fa-map-marker fa-fw"></i> Gps Activo</p>
                                <div class="form-group form-group-lg">
                                    <label class="control-label" for="mask-date">Patente</label>
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon">
                                            <i class="fa fa-car"></i>
                                        </span>
                                        <input type="text" class="form-control input-lg" name="controlPlate" id="controlPlate" placeholder="Patente" required="">
                                    </div>
                                    <!-- /input-group-in -->
                                </div>
                                <!--/form-group-->
                                <div class="form-group form-group-lg">
                                    <input type="submit" class="btn btn-primary btn-lg" value="Verificar" />
                                </div>
                            </form>
                            <!--/form-->
                            <form role="form" class="my-form" id="myAwesomeForm" action="{{ route('infringements.img.upload') }}" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="infringementId" value="1">
                              <input type="hidden" id="infringementImg" name="infringementImg" value="">
                              <input type="file" name="preview" id="preview"  accept="image/*" onchange="uploadPhotos(this)">
                              {{csrf_field()}}
                              <input type="submit" value="Upload Image" name="submit">
                              <img src="" id="compress_img" style="display:none;">
                            </form>
                        </div>
                        <!-- /panel-body -->
                    </div>
                    <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->
                </div>
                <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
<script type="text/javascript">
    window.ajax_token = '{{ csrf_token() }}';
</script>
<script type="text/javascript">
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
                // Ya esta lista la imagen
                $("#infringementImg").val(target.src);
                //transformForm(target.src);
                console.log("Imagen lista");
            };
         };
    });
   // 312429 (312K)
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
// La funcion que transformation
function transformForm(imgUrl){
  console.log("Base64-- "+imgUrl);
  var form = document.getElementById("myAwesomeForm");

  var ImageURL = imgUrl;
  // Split the base64 string in data and contentType
  var block = ImageURL.split(";");
  // Get the content type of the image
  var contentType = block[0].split(":")[1];// In this case "image/gif"
  console.log("contentType: "+contentType);
  // get the real base64 content of the file
  var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."
  console.log("realData: "+realData);
  // Convert it to a blob to upload
  var blob = b64toBlob(realData, contentType);
  console.log("blob: "+blob);
  // Create a FormData and append the file with "image" as parameter name
  var formDataToUpload = new FormData(form);
  formDataToUpload.append("infringementImg", "hola");
  //formDataToUpload.append("infringementImg", blob);
  console.log("Form listo");
}

</script>
@endsection

@push('scripts')
<!-- COMPONENTS -->
  <script src="scripts/sems/check-tickets.js"></script>
  <script src="scripts/jic.min.js"></script>
  <script src="scripts/image_tool.js"></script>

@endpush
