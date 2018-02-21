(function(){
  'use strict';

  // custom default setting datatables
  $.extend( true, $.fn.dataTable.defaults, {
    'autoWidth': false, // disabled smart width
    'language': {
      'lengthMenu': '_MENU_ registros',
      'search': ''
    }
  });

  var datatables1 = $( '#datatables1' ).dataTable({
    'sDom': 'rt<"table-footer"<"pull-left"i>p>',
    'oLanguage': {
      'sInfoFiltered': '<span class="label label-info"><i class="fa fa-filter"></i> filtrado de _MAX_ registros</span>',
    },
    'sAjaxSource': 'exeptuatedvehicles/all', // Aca van los datos y los carga con Ajax?!
    'fnInitComplete': function(settings) {
      var aoData = settings.aoData;

      // adding uniquen id to TR to crud
      $.each( aoData, function(i, val){
        var $ntr = $( val.nTr );
        $ntr.attr( 'data-id', 'datatables1_' + i );
        // Guardar los campos ocultos!!
        $ntr.attr( 'data-exceptuatedid', val._aData[5]);
        $ntr.attr( 'data-zone', val._aData[6]);
        $ntr.attr( 'data-detail', val._aData[7]);
      });

      var $nTable = $(settings.nTable);
      $nTable.closest( '.dataTables_wrapper' ).find( '.dataTable' ).wrap('<div class="table-responsive"></div>');
    },
    'drawCallback': function( settings ) {
      var $nTable = $(settings.nTable);
      $nTable.closest( '.dataTables_wrapper' ).find( '.dataTables_paginate' ).children( '.pagination' )
      .addClass( 'pagination-circle' );
    }
  });

  // simple validate to form add and edit datatables1
  $('#formAddDatatables1').validate({
    errorElement: 'small',
    errorClass: 'help-block text-danger',
    errorPlacement: function(error, element) {
      var $errorPlacement = $(element).parent();

      if ( $(element).is( 'select' ) ) {
        $errorPlacement = $errorPlacement.parent();
      }
      error.appendTo( $errorPlacement );
    },
    highlight: function(element){
      var $errorContainer = $(element).parent();

      if ( $(element).is( 'select' ) ) {
        $errorContainer.parent().addClass( 'has-error' );
      } else{
        $errorContainer.addClass( 'has-error' );
      }
    },
    unhighlight: function(element){
      var $errorContainer = $(element).parent();

      if ( $(element).is( 'select' ) ) {
        $errorContainer.parent().removeClass( 'has-error' );
      } else{
        $errorContainer.removeClass( 'has-error' );
      }
    }
  });

  $('#formEditDatatables1').validate({
    errorElement: 'small',
    errorClass: 'help-block text-danger',
    errorPlacement: function(error, element) {
      var $errorPlacement = $(element).parent();

      if ( $(element).is( 'select' ) ) {
        $errorPlacement = $errorPlacement.parent();
      }
      error.appendTo( $errorPlacement );
    },
    highlight: function(element){
      var $errorContainer = $(element).parent();

      if ( $(element).is( 'select' ) ) {
        $errorContainer.parent().addClass( 'has-error' );
      } else{
        $errorContainer.addClass( 'has-error' );
      }
    },
    unhighlight: function(element){
      var $errorContainer = $(element).parent();

      if ( $(element).is( 'select' ) ) {
        $errorContainer.parent().removeClass( 'has-error' );
      } else{
        $errorContainer.removeClass( 'has-error' );
      }
    }
  });

  // custom filtering
  $( '#filterDatatables1' ).on( 'keyup', function(){
    var value = $( this ).val();

    datatables1.fnFilter( value );
  });

  // selectable datatables ( control with single or multiple select )
  $( document ).on( 'change', '#allowMultipleSelect', function(){
    // remove all selected row
    datatables1.$( 'tr.active' ).removeClass( 'active' );
    // disable actions edit & delete
    $( '.datatables1-actions' ).addClass( 'disabled' );
  })
  // selectable rule
  .on( 'click', '#datatables1 tbody tr', function(){
    var $tr = $( this ),
    allowMultipleSelect = $( '#allowMultipleSelect' ).is(':checked');

    if ( allowMultipleSelect ) {  // multiple select
      $tr.toggleClass( 'active' );
    }
    else{ // single select
      if ( $tr.hasClass( 'active' ) ) {
        $tr.removeClass( 'active' );
      }
      else {
        datatables1.$( 'tr.active' ).removeClass( 'active' );
        $tr.addClass( 'active' );
      }
    }

    // control the event buttons
    var selected = datatables1.$( 'tr.active' ).length;

    if ( selected > 1 ) {
      $( '.datatables1-actions' ).addClass( 'disabled' );
      $( '#delete-datatables1' ).removeClass( 'disabled' );
    }
    else if( selected === 1 ){
      $( '.datatables1-actions' ).removeClass( 'disabled' );
    }
    else{
      $( '.datatables1-actions' ).addClass( 'disabled' );
      // hide form edit
      $( '#editFormContainer' ).addClass( 'hide' );
    }

    // control form edit
    // get data from selected row
    getDataSelected();
  });

  // delete rule
  $( document ).on( 'click', '#delete-datatables1', function(e){
    var dataSelected = datatables1.$( 'tr.active' ),
    deleteCount = dataSelected.length, deletes;

    if (deleteCount) {
      window.bootbox.confirm( 'Are you sure want to delete(s) this data?', function(result){
        deletes = result;

        if( deletes ){

          if ( deleteCount !== 0 ) {

            // process it one by one
            dataSelected.each( function( i, $elem ){

              // do server action here ( ajax )
              // ...

              // deleting selected data
              datatables1.fnDeleteRow( $elem );
            });
          }
          // disabled button
          $( '.datatables1-actions' ).addClass( 'disabled' );
        }
      });
    } else{
      e.preventDefault();
      return;
    }
  })
  // add rule
  .on( 'click', '#add-datatables1, #hideAddDatatables1', function(e){
    e.preventDefault();
    $( '#addFormContainer' ).toggleClass( 'hide' );
    $( '#formAddDatatables1' )[0].reset();
  })
  .on( 'submit', '#formAddDatatables1', function(e){
    e.preventDefault();

    var $this = $( this ),
    datas = $this.serializeArray(); // or use $this.serialize()

    // do server action to save change here ( ajax )
    // ...
    // just simple rule after ajax is done (demo)
    $.each( datas, function( i, data ){
      console.log( data.name + ' = ' + data.value );
    });
    var $button = $("#formAddDatatables1 [type=submit]");
    $button.button('loading')
    var jqxhr = $.ajax({
                    method: "POST",
                    url: "exeptuatedvehicles",
                    data: datas
                  })
                  .done(function(xhr) {
                    toastr.success( 'Vehiculo exceptuado <b>' + xhr.plate + '</b> agregada exitosamente!' );
                    var addData = datatables1.fnAddDataAndDisplay([
                      datas[0].value,
                      datas[1].value,
                      datas[2].value,
                      datas[3].value,
                      datas[4].value
                      ]),
                    newRow = addData.nTr; // just sample id (on real case: get it from server callback)
                    datatables1.$( 'tr.active' ).removeClass( 'active' );
                    $( newRow ).attr( 'data-exceptuatedid', xhr.id);// Agrega el Id que devuelve
                    $( newRow ).attr( 'data-zone', datas[5].value);
                    $( newRow ).attr( 'data-detail', datas[6].value)
                    .addClass( 'active' );
                    // activate actions edit & delete
                    $( '.datatables1-actions' ).removeClass( 'disabled' );
                    // reset form
                    $( '#formAddDatatables1' )[0].reset();
                  })
                  .fail(function(xhr) {
                    if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                    else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                    else{ toastr.error('Error: '+JSON.parse(xhr.responseText).error); }
                  })
                  .always(function(){
                    $button.button('reset');
                  });
    // add new row to datatables using datatables plugin fnAddDataAndDisplay([ 1,2,3,... ]) ( see scripts/demo/datatables-plugins.js )
    // or you can just use fnAddData([ 1,2,3,... ]) - without any datatables plugin
  })
  // edit rule
  .on( 'click', '#edit-datatables1, #hideEditDatatables1', function(e){
    e.preventDefault();
    $( '#editFormContainer' ).toggleClass( 'hide' );
    // get data selecter row
    getDataSelected();
  })
  .on( 'submit', '#formEditDatatables1', function(e){
    e.preventDefault();

    var $this = $( this ),
    datas = $this.serializeArray(); // or use $this.serialize()

    // ...
    // just simple rule after ajax is done to demo
    $.each( datas, function( i, data ){
      console.log( data.name + ' = ' + data.value );
    });

    // change data selected row datatables
    // get data from selected row
    var $button = $("#formEditDatatables1 [type=submit]");
    $button.button('loading')
    var jqxhr = $.ajax({
                    method: "PUT",
                    url: "exeptuatedvehicles/"+datas[1].value,
                    data: datas
                  })
                  .done(function(xhr) {
                    toastr.success( 'Vehiculo exceptuado <b>' + xhr.plate + '</b> actualizado exitosamente!' );
                    var dataSelected = datatables1.$( 'tr.active' ),
                    node = getSelectedNode( datatables1 ),
                    dataUpdate = [ datas[2].value, datas[3].value, datas[4].value, datas[5].value, xhr.price ];

                    dataSelected.data( 'id', datas[0].value );
                    dataSelected.data( 'exceptuatedid', datas[1].value);
                    dataSelected.data( 'zone', datas[6].value);
                    dataSelected.data( 'detail', datas[7].value);
                    datatables1.fnUpdate( dataUpdate, node );

                    // keep display on changed row
                    datatables1.fnDisplayRow( node );
                    // hide form edit
                    $( '#editFormContainer' ).addClass( 'hide' );
                  })
                  .fail(function(xhr) {
                    if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                    else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                    else{ toastr.error('Error: '+JSON.parse(xhr.responseText).error); }
                  })
                  .always(function(){
                    $button.button('reset');
                  });

  });

  // simple fn to get a single node of selected row
  var getSelectedNode = function ( datatables ){
    var node,
    nodes = datatables.fnGetNodes();

    for ( var i=0 ; i < nodes.length ; i++ ){
      if ( $( nodes[i] ).hasClass( 'active' ) )
      {
        node =  nodes[i];
      }
    }

    return node;
  },

  // get data from selected row
  // Aca se edita
  getDataSelected = function(){
    var dataSelected = datatables1.$( 'tr.active' ),
    datatables1ID = dataSelected.data( 'id' ),
    exceptuatedid  = dataSelected.data( 'exceptuatedid' ),
    type = dataSelected.children( 'td:eq(0)' ).text(),
    plate = dataSelected.children( 'td:eq(1)' ).text(),
    start = dataSelected.children( 'td:eq(2)' ).text(),
    end = dataSelected.children( 'td:eq(3)' ).text(),
    cost = dataSelected.children( 'td:eq(4)' ).text(),
    zone = dataSelected.attr( 'data-zone' ),
    detail = dataSelected.data( 'detail' );
    // set data form edit
    $( '#datatables1ID' ).val( datatables1ID );
    $( '#exceptuatedId' ).val( exceptuatedid );
    $( '#editType' ).val( type );
    $( '#editPlate' ).val( plate );
    $( '#editStart' ).val( start );
    $( '#editEnd' ).val( end );
    $( '#editCost' ).val( cost );
    // set data on input select
    if(zone!=null){
      $( '#editZone' ).val( String(zone) );
    }else{
      $( '#editZone' ).val(null);
    }

    $( '#editDetail' ).val( detail );
  };


  // Table Tools
  // tabletools setting
  /*
   * TableTools Bootstrap compatibility
   * Required TableTools 2.1+
   */
   if ( $.fn.DataTable.TableTools ) {
    // Set the classes that TableTools uses to something suitable for Bootstrap
    $.extend( true, $.fn.DataTable.TableTools.classes, {
      'container': 'DTTT btn-group',
      'buttons': {
        'normal': 'btn btn-default',
        'disabled': 'disabled'
      },
      'collection': {
        'container': 'DTTT_dropdown dropdown-menu',
        'buttons': {
          'normal': '',
          'disabled': 'disabled'
        }
      },
      'print': {
        'info': 'DTTT_print_info'
      },
      'select': {
        'row': 'selected'
      }
    } );

    // Have the collection use a bootstrap compatible dropdown
    $.extend( true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
      'collection': {
        'container': 'ul',
        'button': 'li',
        'liner': 'a'
      }
    } );
  }


  // adding custom styles to all .datatables
  $('.dataTable').each(function(){
    var datatables = $( this );
    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
    var searchInput = datatables.closest('.dataTables_wrapper').find('div[id$=_filter] input');
    searchInput.attr('placeholder', 'Search');
  });

})(window);
