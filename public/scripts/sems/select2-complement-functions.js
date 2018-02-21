// SELECT2
$('[data-input="select2"], .select2').each(function(){
  var $this = $(this),
  placeholder = ($this.attr('placeholder') === undefined) ? 'Select a choice' : $this.attr('placeholder');

  $this.select2({
    placeholder: placeholder
  });
});
$('[data-input="select2-tags"], .select2-tags').each(function(){
  var $this = $(this);

  $this.select2({
    tags: true,
    tokenSeparators: [',']
  });
});
// END SELECT2
