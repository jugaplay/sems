/* Usuarios sin login */
(function(){
  cars =  JSON.parse($("#owned-cars").val());
  $('#ticketPlate').typeahead({
    highlight: true,
    hint: true,
    minLength: 0
  },{
    name: 'cars',
    displayKey: 'value',
    source: substringMatcher(cars)
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
