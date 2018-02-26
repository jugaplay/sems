@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
      <div class="content">
          <div id="content-hero" class="content-hero">
          <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
          <div class="content-hero-overlay bg-grd-blue"></div>
          <div class="content-hero-body">
            <!-- /.content-bar -->
            <h1 style="color: white;">USUARIOS</h1>
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
                <h3 class="panel-title">Usuarios</h3>
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
                    <p class="lead">Agregar usuario</p>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createName" id="createName" class="form-control input-sm" placeholder="Nombre" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createMail" id="createMail" class="form-control input-sm" placeholder="Mail" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createPhone" id="createPhone" class="form-control input-sm" placeholder="Teléfono" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createAccountType" id="createAccountType" required="">
                              <option value="">Tipo</option>
                              <option value="Inspector">Inspector</option>
                              <option value="Asistente">Asistente</option>
                              <option value="Juez">Juez</option>
                              <option value="Administrador">Administrador</option>
                              <option value="Super admin">Super admin</option>
                              <option value="Municipalidad">Municipalidad</option>
                              <option value="Conductor">Conductor</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createAccountStatus" id="createAccountStatus" required="">
                              <option value="">Estado</option>
                              <option value="Confirmada"> Confirmada </option>
                              <option value="No confirmada"> No confirmada </option>
                              <option value="Baja"> Baja </option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createPassword" id="createPassword" class="form-control input-sm" placeholder="Contraseña" autocomplete="off" required="">
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
                  <div class="form-group">
                    <p class="lead">Editar usuario seleccionado</p>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <input type="hidden" name="datatables1ID" id="datatables1ID">
                          <input type="hidden" name="userId" id="userId">
                          <input name="editName" id="editName" class="form-control input-sm" placeholder="Nombre" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editMail" id="editMail" class="form-control input-sm" placeholder="Mail" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editPhone" id="editPhone" class="form-control input-sm" placeholder="Teléfono" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editAccountType" id="editAccountType" required="">
                              <option value="">Tipo</option>
                              <option value="Inspector">Inspector</option>
                              <option value="Asistente">Asistente</option>
                              <option value="Juez">Juez</option>
                              <option value="Administrador">Administrador</option>
                              <option value="Super admin">Super admin</option>
                              <option value="Municipalidad">Municipalidad</option>
                              <option value="Conductor">Conductor</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editAccountStatus" id="editAccountStatus" required="">
                              <option value="">Estado</option>
                              <option value="Confirmada"> Confirmada </option>
                              <option value="No confirmada"> No confirmada </option>
                              <option value="Baja"> Baja </option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editPassword" id="editPassword" class="form-control input-sm" placeholder="Contraseña" autocomplete="off">
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
                    <th>Nombre</th>
                    <th>Mail</th>
                    <th>Teléfono</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                  </tr>
                </thead>

                <tbody></tbody>

                <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Mail</th>
                    <th>Teléfono</th>
                    <th>Tipo</th>
                    <th>Estado</th>
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
  <script src="scripts/sems/adm-datatables-users.js"></script>
@endpush
