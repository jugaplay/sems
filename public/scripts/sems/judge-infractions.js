(function(){
  'use strict';

  // DATE RANGE PICKER DEMO
  var moment = window.moment;
  // Pongo el formato de las fechas de manera local
  window.moment.locale('es');
  var regional= {closeText: 'Cerrar', prevText: '< Ant', nextText: 'Sig >', applyLabel: "Aplicar", cancelLabel: "Cancelar", currentText: 'Hoy', monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'], monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'], dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'], dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'], dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'], weekHeader: 'Sm', dateFormat: 'dd/mm/yy', firstDay: 1, isRTL: false, showMonthAfterYear: false, yearSuffix: ''};
  // Fin del regional
  $('[data-input="daterangepicker"]').each(function(){
    var $this = $(this),
    dataset = $(this).data();
    dataset.applyClass = 'btn-primary';
    $this.daterangepicker(dataset);
  });

  $('#reportrange').on('click', function(e){
    e.preventDefault();
  })
  .daterangepicker({
    applyClass: 'btn-primary',
    //startDate: moment().subtract(29,'days'),
    //endDate: moment(),
    opens: 'left',
    drops: 'down',
    locale:regional // Aplico el seleccionar fechas locales
  },
  function(start, end) {
    $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    $("#infringementStarts").val(start.format('YYYY-MM-DD'));
    $("#infringementEnds").val(end.format('YYYY-MM-DD'));
  });
  // Inicializo la fecha contemplando un posible filtro
  if($("#infringementStarts").val()==""){
    $('#reportrange').find('span').html("Seleccionar fechas para filtrar");
  }else{
    $('#reportrange').find('span').html(parseSimpleDate($("#infringementStarts").val())+ ' - ' + parseSimpleDate($("#infringementEnds").val()));
  }


  // add animation on show/hide picker
  $('[data-input="daterangepicker"], #reportrange').on('show.daterangepicker', function(e, picker){
    var target = picker.container;
    target.velocity('transition.expandIn', 250);
  })
  .on('hide.daterangepicker', function(e, picker){
    var target = picker.container;
    target.css('display', 'block')
    .velocity('transition.slideUpOut', 250);
  });
  $('#reportrange').on('showCalendar.daterangepicker', function(e, picker){
    var target = picker.container.children('.calendar');
    target.velocity('transition.slideRightIn', 250);
  })
  .on('hide.daterangepicker', function(e, picker){
    var target = picker.container.children('.calendar');
    target.velocity('transition.slideRightOut', 250);
  });
  // END DATE RANGE PICKER DEMO

})(window);
