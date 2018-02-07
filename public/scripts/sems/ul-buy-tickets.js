/* Usuarios sin login */
(function(){
  cars =  [ 'IQW938', 'CVB752', 'IIM654','KKG679','MMA689','MMA689','ILW938', 'CVW752', 'WIM654','MKG679','NMA689','OMA689'];

  $('#user-cars-autocomplete-input').typeahead({
    highlight: true,
    hint: true,
    minLength: 0
  },{
    name: 'cars',
    displayKey: 'value',
    source: substringMatcher(cars)
  });
  $('.my-form').on('submit', function () {
    if(jQuery.inArray( $('#user-cars-autocomplete-input').val(), cars )==-1){
      bootbox.confirm({
        title: '<i class="fa fa fa-car fa-fw" aria-hidden="true"></i> Guardar vehiculo',
        message: "¿Desea agregar "+$('#user-cars-autocomplete-input').val()+" a sus vehiculos guardados?",
        buttons: {
            confirm: {
                label: 'Guardar',
                className: 'btn-success'
            },
            cancel: {
                label: 'No, gracias',
                className: 'btn-danger'
            }
        },
        callback: function(result){ if(result){alert("Guardo auto")}; }
      });
    }
    return false;
  });
})(window);
function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}
function substringMatcher(strs) {
  return function findMatches(q, cb) {
    var matches, substrRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });

    cb(matches);
  };
};
