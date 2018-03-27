/* Usuarios sin login */
(function(){
  // TAGS INPUT
  $('[data-input="tags"], .input-tags').each(function(){
    var $this = $(this),
    placeholder = ($this.attr('placeholder') === undefined) ? '' : $this.attr('placeholder');

    $this.tagsInput({
      'width': '100%',
      'height': 'auto',
      'defaultText': placeholder,
      'onAddTag':checkTag,
      'delimiter': [','],
      'placeholderColor' : 'rgba(22, 24, 27, 0.54)'
    });
  });
  $('.tagsinput input').on('focus', function(){
    var input = $(this),
    tagsInput = input.parent().parent();
    tagsInput.addClass('focus');
  })
  .on('blur', function(){
    var input = $(this),
    tagsInput = input.parent().parent();
    tagsInput.removeClass('focus');
  });
  // END TAGS INPUT
})(window);
// Verifica si la patente esta bien ingresada, sino la saca removeTag
function checkTag(tag){
  if(!preVerifiedPlate(tag)){
    $('#domain-input').removeTag(tag);
  }
}
