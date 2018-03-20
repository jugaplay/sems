@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
      <div class="content">
          <div id="content-hero" class="content-hero">
          <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
          <div class="content-hero-overlay bg-grd-blue"></div>
          <div class="content-hero-body">
            <!-- /.content-bar -->
            <h1 style="color: white;">Espacios reservados</h1>
          </div><!-- /.content-hero-body -->
        </div>

          <div class="content-body">
            <div class="panel" data-fill-color="true">
              <div class="panel-heading">
                <div class="panel-control pull-right">
                  <a href="#" class="btn btn-icon" data-toggle="panel-refresh" rel="tooltip" data-placement="bottom" title="Actualizar"><i class="icon-refresh"></i></a>
                  <a href="#" class="btn btn-icon" data-toggle="panel-expand" rel="tooltip" data-placement="bottom" title="Expandir"><i class="arrow_expand"></i></a>
                  <a href="#" class="btn btn-icon" data-toggle="panel-collapse" rel="tooltip" data-placement="bottom" title="Achicar"><i class="icon_minus_alt2"></i></a>
                </div>
                <h3 class="panel-title">Espacios reservados</h3>
              </div><!-- /.panel-heading -->

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
                </div><!-- /btn-toolbar -->
              </div><!-- /.panel-body -->

              <div class="panel-body hide" id="addFormContainer">
                <form id="formAddDatatables1" action="#" method="POST">
                  <div class="form-group">
                    <p class="lead">Agregar espacios reservados</p>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createType" id="createType" required="">
                              <option value="">Tipo</option>
                              <option value="Contenedor">Contenedor</option>
                              <option value="Carga/Descarga">Carga/Descarga</option>
                              <option value="Otros">Otros</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createIdentifier" id="createIdentifier" class="form-control input-sm" placeholder="Identificador" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createCompany" id="createCompany" class="form-control input-sm" placeholder="Compañía" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createSize" id="createSize" class="form-control input-sm" placeholder="Tamaño" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createStart" type="datetime-local" id="createStart" class="form-control input-sm" placeholder="" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createEnd" type="datetime-local" id="createEnd" class="form-control input-sm" placeholder="" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createCost" id="createCost" class="form-control input-sm" placeholder="Costo" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="input-group input-group-in">
                          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                          <input type="hidden" name="createLatitud" id="createLatitud" class="form-control input-sm" autocomplete="off" required="">
                          <input name="createLongitud" id="createLongitud" class="form-control input-sm" placeholder="Mapa" autocomplete="off" required="">
                          <span class="input-group-btn">
                            <a rel="tooltip" data-container="body" title="Marcar en mapa" onclick="markSpecialSpaceInMap('create');" class="btn">
                              <i class="fa fa-map-pin" aria-hidden="true"></i>
                            </a>
                          </span>
                        </div><!-- /input-group-in -->
                      </div><!-- /.cols -->
                    </div><!-- /.row -->
                  </div><!-- /.form-group -->
                  <div class="form-grouphide">
                    {{csrf_field()}}
                    <button id="hideAddDatatables1" class="btn btn-default btn-sm">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Crear</button>
                  </div><!-- /.form-group -->
                </form><!-- /#formAddDatatables1 -->
              </div><!-- /.panel-body -->
              <div class="panel-body hide" id="editFormContainer">
                <form id="formEditDatatables1" action="#" method="POST">
                  <input type="hidden" name="datatables1ID" id="datatables1ID">
                  <input type="hidden" name="specialid" id="specialid">
                  <div class="form-group">
                    <p class="lead">Editar zona especial</p>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editBlockName" id="editBlockName" class="form-control input-sm" placeholder="Nombre de la cuadra" autocomplete="off" disabled>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editType" id="editType" required="">
                              <option value="">Tipo</option>
                              <option value="Contenedor">Contenedor</option>
                              <option value="Carga/Descarga">Carga/Descarga</option>
                              <option value="Otros">Otros</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editIdentifier" id="editIdentifier" class="form-control input-sm" placeholder="Identificador" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editCompany" id="editCompany" class="form-control input-sm" placeholder="Compañía" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editSize" id="editSize" class="form-control input-sm" placeholder="Tamaño" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editStart" id="editStart" type="datetime-local" class="form-control input-sm" placeholder="" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editEnd" id="editEnd" type="datetime-local" class="form-control input-sm" placeholder="" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editCost" id="editCost" class="form-control input-sm" placeholder="Costo" autocomplete="off" required="" disabled>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="input-group input-group-in">
                          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                          <input type="hidden" name="editLatitud" id="editLatitud" class="form-control input-sm" autocomplete="off" required="">
                          <input name="editLongitud" id="editLongitud" class="form-control input-sm" placeholder="Mapa" autocomplete="off" required="">
                          <span class="input-group-btn">
                            <a rel="tooltip" data-container="body" title="Marcar en mapa" onclick="markSpecialSpaceInMap('edit');" class="btn">
                              <i class="fa fa-map-pin" aria-hidden="true"></i>
                            </a>
                          </span>
                        </div><!-- /input-group-in -->
                      </div><!-- /.cols -->
                    </div><!-- /.row -->
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    {{csrf_field()}}
                    <button id="hideEditDatatables1" class="btn btn-default btn-sm">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm">Guardar cambios</button>
                  </div><!-- /.form-group -->
                </form><!-- /#formAddDatatables1 -->
              </div><!-- /.panel-body -->

              <!-- datatables1 -->
              <table id="datatables1" class="table table-noborder table-hover bordered-top">
                <thead>
                  <tr>
                    <th>Calle</th>
                    <th>Tipo</th>
                    <th>Identificador</th>
                    <th>Compañía</th>
                    <th>Espacios</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Costo</th>
                  </tr>
                </thead>

                <tbody></tbody>


                <tfoot>
                  <tr>
                    <th>Calle</th>
                    <th>Tipo</th>
                    <th>Identificador</th>
                    <th>Compañía</th>
                    <th>Espacios</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Costo</th>
                  </tr>
                </tfoot>
              </table>
            </div><!-- /.panel -->
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
  <script src="scripts/sems/adm-datatables-specialspaces.js"></script>
  <link rel="stylesheet" href="styles/leaflet.css">
  <script src="scripts/sems/leaflet.js"></script>
  <script src="scripts/sems/adm-special-places-maps.js"></script>

@endpush
