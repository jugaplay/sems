@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
      <div class="content">
          <div id="content-hero" class="content-hero">
          <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
          <div class="content-hero-overlay bg-grd-blue"></div>
          <div class="content-hero-body">
            <!-- /.content-bar -->
            <h1 style="color: white;">Zonas / Precios</h1>
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
                <h3 class="panel-title">Zonas / Precios</h3>
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
                  <div class="btn-group btn-group-sm pull-right">
                    <a href="areas_price.html" data-toggle="tooltip" data-container="body" title="Precio de areas" class="btn btn-default datatables1-actions" role="button">
                      <i class="fa fa-usd"></i>
                    </a>
                  </div>
                </div><!-- /btn-toolbar -->
              </div><!-- /.panel-body -->

              <div class="panel-body hide" id="addFormContainer">
                <form id="formAddDatatables1" action="#" method="POST">
                  <div class="form-group">
                    <p class="lead">Agregar nueva area/precio</p>
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createAreaId" id="createAreaId" style=" width:100%" data-input="select2" placeholder="Elegir área">
                              <option value="">Areas</option>
                              @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}, id:{{ $area->id }}</option>
                              @endforeach
                            </select>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createStarts" id="createStarts" type="date" class="form-control input-sm" placeholder="Desde" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createEnds" id="createEnds" type="date" class="form-control input-sm" placeholder="Hasta" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createStartDay" id="createStartDay" required="">
                              <option value="">Empieza el día</option>
                              <option value="Domingo">Domingo</option>
                              <option value="Lunes">Lunes</option>
                              <option value="Martes">Martes</option>
                              <option value="Miércoles">Miércoles</option>
                              <option value="Jueves">Jueves</option>
                              <option value="Viernes">Viernes</option>
                              <option value="Sábado">Sábado</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createEndDay" id="createEndDay" required="">
                              <option value="">Termina el día</option>
                              <option value="Domingo">Domingo</option>
                              <option value="Lunes">Lunes</option>
                              <option value="Martes">Martes</option>
                              <option value="Miércoles">Miércoles</option>
                              <option value="Jueves">Jueves</option>
                              <option value="Viernes">Viernes</option>
                              <option value="Sábado">Sábado</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                  </div>
                  <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createStartTimezone" id="createStartTimezone" type="time" class="form-control input-sm" placeholder="Hora comienzo" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createEndTimezone" id="createEndTimezone" type="time" class="form-control input-sm" placeholder="Hora Fin" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createPrice" id="createPrice" type="text" class="form-control input-sm" placeholder="Precio" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createType" id="createType" required="">
                              <option value="">Tipo</option>
                              <option value="Tiempo">Tiempo</option>
                              <option value="Estadía">Estadía</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createPriority" id="createPriority" type="number" class="form-control input-sm" placeholder="Prioridad" autocomplete="off" required="">
                        </div>
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
                  <input type="hidden" name="editapId" id="editapId">
                  <div class="form-group">
                    <p class="lead">Editar area/precio seleccionada</p>
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editAreaId" id="editAreaId" style=" width:100%" data-input="select2" placeholder="Elegir área">
                              <option value="">Areas</option>
                              @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}, id:{{ $area->id }}</option>
                              @endforeach
                            </select>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editStarts" id="editStarts" type="date" class="form-control input-sm" placeholder="Desde" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editEnds" id="editEnds" type="date" class="form-control input-sm" placeholder="Hasta" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editStartDay" id="editStartDay" required="">
                              <option value="">Empieza el día</option>
                              <option value="Domingo">Domingo</option>
                              <option value="Lunes">Lunes</option>
                              <option value="Martes">Martes</option>
                              <option value="Miércoles">Miércoles</option>
                              <option value="Jueves">Jueves</option>
                              <option value="Viernes">Viernes</option>
                              <option value="Sábado">Sábado</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editEndDay" id="editEndDay" required="">
                              <option value="">Termina el día</option>
                              <option value="Domingo">Domingo</option>
                              <option value="Lunes">Lunes</option>
                              <option value="Martes">Martes</option>
                              <option value="Miércoles">Miércoles</option>
                              <option value="Jueves">Jueves</option>
                              <option value="Viernes">Viernes</option>
                              <option value="Sábado">Sábado</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                  </div>
                  <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editStartTimezone" id="editStartTimezone" type="time" class="form-control input-sm" placeholder="Hora comienzo" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editEndTimezone" id="editEndTimezone" type="time" class="form-control input-sm" placeholder="Hora Fin" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editPrice" id="editPrice" type="text" class="form-control input-sm" placeholder="Precio" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editType" id="editType" required="">
                              <option value="">Tipo</option>
                              <option value="Tiempo">Tiempo</option>
                              <option value="Estadía">Estadía</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editPriority" id="editPriority" type="number" class="form-control input-sm" placeholder="Prioridad" autocomplete="off" required="">
                        </div>
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
                    <th>Area</th>
                    <th>Tipo</th>
                    <th>Franja Días</th>
                    <th>Franja Horaria</th>
                    <th>Precio</th>
                    <th>Final</th>
                  </tr>
                </thead>

                <tbody></tbody>

                <tfoot>
                  <tr>
                    <th>Area</th>
                    <th>Tipo</th>
                    <th>Franja Días</th>
                    <th>Franja Horaria</th>
                    <th>Precio</th>
                    <th>Final</th>
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
  <script src="scripts/select2.js"></script>
  <link rel="stylesheet" href="styles/components.css">
  <script src="scripts/sems/select2-complement-functions.js"></script>
  <!-- END COMPONENTS -->

  <!-- DUMMY: Use for demo -->
  <script src="scripts/sems/adm-datatables-extras.js"></script>
  <script src="scripts/sems/adm-datatables-areas-price.js"></script>

@endpush
