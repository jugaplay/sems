@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
      <div class="content">
          <div id="content-hero" class="content-hero">
          <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
          <div class="content-hero-overlay bg-grd-blue"></div>
          <div class="content-hero-body">
            <!-- /.content-bar -->
            <h1 style="color: white;">LOCALES</h1>
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
                <h3 class="panel-title">Locales</h3>
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
                    <p class="lead">Agregar local</p>
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
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createAddres" id="createAddres" class="form-control input-sm" placeholder="Dirección" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="createPhone" id="createPhone" class="form-control input-sm" placeholder="Teléfono" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createAccountStatus " id="createAccountStatus" required="">
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
                          <label class="select select-sm">
                            <select name="createAccountVerified" id="createAccountVerified" required="">
                              <option value="No Verificada"> No Verificada </option>
                              <option value="Verificada"> Verificada </option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createPassword" id="createPassword" class="form-control input-sm" placeholder="Contraseña" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="input-group input-group-in">
                          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                          <input type="hidden" name="createLatitud" id="createLatitud" class="form-control input-sm" autocomplete="off" required="">
                          <input name="createLongitud" id="createLongitud" class="form-control input-sm" placeholder="Mapa" autocomplete="off" required="">
                          <span class="input-group-btn">
                            <a rel="tooltip" data-container="body" title="Marcar en mapa" onclick="markLocalInMap('create');" class="btn">
                              <i class="fa fa-map-pin" aria-hidden="true"></i>
                            </a>
                          </span>
                        </div><!-- /input-group-in -->
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createFee" id="createFee" class="form-control input-sm" placeholder="Comisión" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createBussinesName" id="createBussinesName" class="form-control input-sm" placeholder="Razon social" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createTaxTreatment" id="createTaxTreatment" required="">
                              <option value="">Trato impositivo</option>
                              <option value="Inscripto">Inscripto</option>
                              <option value="Monotributo">Monotributo</option>
                              <option value="Consumidor final">Consumidor final</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createBillingAddress" id="createBillingAddress" class="form-control input-sm" placeholder="Dir de Facturación" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createBillingCity" id="createBillingCity" class="form-control input-sm" placeholder="Ciudad de Facturación" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createBillingState" id="createBillingState" class="form-control input-sm" placeholder="Provincia de Facturación" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="createDocumentType" id="createDocumentType" required="">
                              <option value="">Tipo Documento</option>
                              <option value="CUIT">CUIT</option>
                              <option value="CUIL">CUIL</option>
                              <option value="DNI">DNI</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="createDocumentNumber" id="createDocumentNumber" class="form-control input-sm" placeholder="Nro documento" autocomplete="off" required="">
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
                  <input type="hidden" name="userId" id="userId">
                  <div class="form-group">
                    <p class="lead">Editar local</p>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editName" id="editName" class="form-control input-sm" placeholder="Nombre" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editMail" id="editMail" class="form-control input-sm" placeholder="Mail" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editAddres" id="editAddres" class="form-control input-sm" placeholder="Mail" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <input name="editPhone" id="editPhone" class="form-control input-sm" placeholder="Teléfono" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editAccountStatus " id="editAccountStatus" required="">
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
                          <label class="select select-sm">
                            <select name="editAccountVerified" id="editAccountVerified" required="">
                              <option value="No Verificada"> No Verificada </option>
                              <option value="Verificada"> Verificada </option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editPassword" id="editPassword" class="form-control input-sm" placeholder="Contraseña" autocomplete="off">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="input-group input-group-in">
                          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                          <input type="hidden" name="editLatitud" id="editLatitud" class="form-control input-sm" autocomplete="off" required="">
                          <input name="editLongitud" id="editLongitud" class="form-control input-sm" placeholder="Mapa" autocomplete="off" required="">
                          <span class="input-group-btn">
                            <a rel="tooltip" data-container="body" title="Marcar en mapa" onclick="markLocalInMap('edit');" class="btn">
                              <i class="fa fa-map-pin" aria-hidden="true"></i>
                            </a>
                          </span>
                        </div><!-- /input-group-in -->
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editFee" id="editFee" class="form-control input-sm" placeholder="Comisión" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editBussinesName" id="editBussinesName" class="form-control input-sm" placeholder="Razon social" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editTaxTreatment" id="editTaxTreatment" required="">
                              <option value="">Trato impositivo</option>
                              <option value="Inscripto">Inscripto</option>
                              <option value="Monotributo">Monotributo</option>
                              <option value="Consumidor final">Consumidor final</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editBillingAddress" id="editBillingAddress" class="form-control input-sm" placeholder="Dir de Facturación" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editBillingCity" id="editBillingCity" class="form-control input-sm" placeholder="Ciudad de Facturación" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editBillingState" id="editBillingState" class="form-control input-sm" placeholder="Provincia de Facturación" autocomplete="off" required="">
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="select select-sm">
                            <select name="editDocumentType" id="editDocumentType" required="">
                              <option value="">Tipo de documento</option>
                              <option value="CUIT">CUIT</option>
                              <option value="CUIL">CUIL</option>
                              <option value="DNI">DNI</option>
                            </select>
                          </label>
                        </div>
                      </div><!-- /.cols -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <input name="editDocumentNumber" id="editDocumentNumber" class="form-control input-sm" placeholder="Nro documento" autocomplete="off" required="">
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
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                  </tr>
                </thead>

                <tbody></tbody>

                <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Mail</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
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
  <script src="scripts/sems/adm-datatables-locals.js"></script>
  <link rel="stylesheet" href="styles/leaflet.css">
  <script src="scripts/sems/leaflet.js"></script>
  <script src="scripts/sems/adm-locals-maps.js"></script>
@endpush
