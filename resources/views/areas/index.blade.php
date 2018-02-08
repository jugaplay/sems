@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
  <div class="content">
      <div id="content-hero" class="content-hero">
          <img class="content-hero-embed" src="/images/dummy/people4.jpg" alt="cover">
          <div class="content-hero-overlay bg-grd-blue"></div>
          <div class="content-hero-body">
              <!-- /.content-bar -->
              <h1 style="color: white;">Zonas</h1>
          </div>
          <!-- /.content-hero-body -->
      </div>

      <div class="content-body">
          <div class="panel" data-fill-color="true">
              <div class="panel-heading">
                  <div class="panel-control pull-right">
                      <a href="#" class="btn btn-icon" data-toggle="panel-refresh" rel="tooltip" data-placement="bottom" title="Actualizar">
                          <i class="icon-refresh"></i>
                      </a>
                      <a href="#" class="btn btn-icon" data-toggle="panel-expand" rel="tooltip" data-placement="bottom" title="Expandir">
                          <i class="arrow_expand"></i>
                      </a>
                      <a href="#" class="btn btn-icon" data-toggle="panel-collapse" rel="tooltip" data-placement="bottom" title="Achicar">
                          <i class="icon_minus_alt2"></i>
                      </a>
                  </div>
                  <h3 class="panel-title">Zonas </h3>
              </div>
              <!-- /.panel-heading -->

              <div class="panel-body">
                  <div class="btn-toolbar clearfix" role="toolbar">

                      <div class="btn-group btn-group-sm pull-left">
                          <button data-toggle="tooltip" data-container="body" title="Agregar nuevo" id="add-datatables1" class="btn btn-default" role="button">
                              <i class="fa fa-plus"></i>
                          </button>
                      </div>
                      <div class="btn-group btn-group-sm pull-left">
                          <button id="edit-datatables1" data-toggle="tooltip" data-container="body" title="editar" class="btn btn-default datatables1-actions disabled" role="button">
                              <i class="fa fa-edit"></i>
                          </button>
                      </div>
                      <div class="btn-group pull-left">
                          <input id="filterDatatables1" class="form-control input-sm" placeholder="Filtro">
                      </div>
                      <div class="btn-group btn-group-sm pull-right">
                          <a href="areas_price.html" data-toggle="tooltip" data-container="body" title="Precio de areas" class="btn btn-default datatables1-actions" role="button">
                              <i class="fa fa-usd"></i>
                          </a>
                      </div>
                  </div>
                  <!-- /btn-toolbar -->
              </div>
              <!-- /.panel-body -->

              <div class="panel-body hide" id="addFormContainer">
                  <form id="formAddDatatables1" action="#" method="POST">
                      <div class="form-group">
                          <p class="lead">Agregar nueva area</p>
                          <div class="row">
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <input name="createName" id="createName" class="form-control input-sm" placeholder="Nombre de la calle" autocomplete="off" required="">
                                  </div>
                              </div>
                              <!-- /.cols -->
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label class="select select-sm">
                                          <select name="createActive" id="createActive" required="">
                                              <option value="">Estado</option>
                                              <option value="true">Activa</option>
                                              <option value="false">No activa</option>
                                          </select>
                                      </label>
                                  </div>
                              </div>
                              <!-- /.cols -->
                              <div class="col-md-2">
                                  <div class="input-group input-group-in">
                                      <span class="input-group-addon">
                                          <i class="fa fa-map-marker"></i>
                                      </span>
                                      <input name="createZone" id="createZone" class="form-control input-sm" autocomplete="off" placeholder="Marcar calle" required="">
                                      <span class="input-group-btn">
                                          <a rel="tooltip" data-container="body" title="Marcar en mapa" onclick="markStreetZoneInMap('create');" class="btn">
                                              <i class="fa fa-map-pin" aria-hidden="true"></i>
                                          </a>
                                      </span>
                                  </div>
                                  <!-- /input-group-in -->
                              </div>
                              <!-- /.cols -->
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <input name="editDetail" id="createDetail" class="form-control input-sm" placeholder="Detalle" autocomplete="off">
                                  </div>
                              </div>
                              <!-- /.cols -->
                          </div>
                          <!-- /.row -->
                      </div>
                      <!-- /.form-group -->

                      <div class="form-grouphide">
                          <button id="hideAddDatatables1" class="btn btn-default btn-sm">Cancelar</button>
                          <button type="submit" class="btn btn-success btn-sm">Crear</button>
                      </div>
                      <!-- /.form-group -->
                  </form>
                  <!-- /#formAddDatatables1 -->
              </div>
              <!-- /.panel-body -->

              <div class="panel-body hide" id="editFormContainer">
                  <form id="formEditDatatables1" action="#" method="POST">
                      <input type="hidden" name="datatables1ID" id="datatables1ID">
                      <input type="hidden" name="editAreaId" id="editAreaId">
                      <div class="form-group">
                          <p class="lead">Editar calle seleccionada</p>
                          <div class="row">
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <input name="editName" id="editName" class="form-control input-sm" placeholder="Nombre de la calle" autocomplete="off" required="">
                                  </div>
                              </div>
                              <!-- /.cols -->
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label class="select select-sm">
                                          <select name="editActive" id="editActive" required="">
                                              <option value="">Estado</option>
                                              <option value="true">Activa</option>
                                              <option value="false">No activa</option>
                                          </select>
                                      </label>
                                  </div>
                              </div>
                              <!-- /.cols -->
                              <div class="col-md-2">
                                  <div class="input-group input-group-in">
                                      <span class="input-group-addon">
                                          <i class="fa fa-map-marker"></i>
                                      </span>
                                      <input name="editZone" id="editZone" class="form-control input-sm" autocomplete="off" placeholder="Marcar calle" required="">
                                      <span class="input-group-btn">
                                          <a rel="tooltip" data-container="body" title="Marcar en mapa" onclick="markStreetZoneInMap('edit');" class="btn">
                                              <i class="fa fa-map-pin" aria-hidden="true"></i>
                                          </a>
                                      </span>
                                  </div>
                                  <!-- /input-group-in -->
                              </div>
                              <!-- /.cols -->
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <input name="editDetail" id="editDetail" class="form-control input-sm" placeholder="Detalle" autocomplete="off">
                                  </div>
                              </div>
                              <!-- /.cols -->
                          </div>
                          <!-- /.row -->
                      </div>
                      <!-- /.form-group -->

                      <div class="form-group">
                          <button id="hideEditDatatables1" class="btn btn-default btn-sm">Cancelar</button>
                          <button type="submit" class="btn btn-primary btn-sm">Guardar cambios</button>
                      </div>
                      <!-- /.form-group -->
                  </form>
                  <!-- /#formAddDatatables1 -->
              </div>
              <!-- /.panel-body -->

              <!-- datatables1 -->
              <table id="datatables1" class="table table-noborder table-hover bordered-top">
                  <thead>
                      <tr>
                          <th>id</th>
                          <th>Nombre</th>
                          <th>Activa</th>
                          <th>Detalle</th>
                          <th>Precios Acivos</th>
                      </tr>
                  </thead>

                  <tbody></tbody>

                  <tfoot>
                      <tr>
                          <th>id</th>
                          <th>Nombre</th>
                          <th>Activa</th>
                          <th>Detalle</th>
                          <th>Precios Acivos</th>
                      </tr>
                  </tfoot>
              </table>
          </div>
          <!-- /.panel -->
      </div>
      <!-- /.content-body -->
  </div>
  <!-- /.content -->
</section>
@endsection

@push('scripts')
<!-- COMPONENTS -->
  <script src="scripts/dataTables.bootstrap.js"></script>
  <script src="scripts/dataTables.tableTools.js"></script>
  <script src="scripts/jquery.validate.js"></script>
  <!-- END COMPONENTS -->

  <!-- DUMMY: Use for demo -->
  <script src="scripts/sems/adm-datatables-extras.js"></script>
  <script src="scripts/sems/adm-datatables-areas.js"></script>
  <link rel="stylesheet" href="styles/leaflet.css">
  <script src="scripts/sems/leaflet.js"></script>
  <script src="scripts/sems/adm-areas-maps.js"></script>
@endpush
