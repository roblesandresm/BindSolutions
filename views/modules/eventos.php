<!-- GESTION DE EVENTOS -->
<main class="main col">
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <h1>Administrar eventos</h1>
        </div>
        <div class="col-lg-6 col-xs-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio"><i class="fas fa-home"></i>Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Administrar Eventos</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row action-buttons mb-12">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAgregarEvento">Agregar Evento</button>
    </div>
    <table class="table dt-responsive table-hover tablas-pos tablaEventos">
        <thead>
            <tr>
                <th scope="col" style="width: 10px;">ID</th>
                <th scope="col">Nombre del evento</th>
                <th scope="col">Socio</th>
                <th scope="col">Lugar del evento</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha del evento</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $item = null;
                $valor = null;
                $eventos = ControllerEventos::ctrMostrarEventos($item, $valor);

                foreach ($eventos as $key => $value) {
                    if ($value['estado'] != 0) {
            ?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['nombre']; ?></td>
                <?php
                if ($value['id_socio'] != null) {
                    $item = "id";
                    $valor = $value['id_socio']; 
                    $socio = ControllerUsuarios::ctrMostrarUsuario($item, $valor);
                    echo "<td class='text-success'>".$socio['nombre']."</td>";
                } else {
                    echo '<td class="text-warning">Sin socio</td>';
                }
                
                ?>
                <td><?php echo $value['ubicacion']; ?></td>
                <td>
                    <?php 
                    if ($value['estado'] == 1) {
                        echo "<button class='btn btn-sm btn-success btnActivo' idEvento='".$value['id']."'>Activo</button>";
                    } else if ($value['estado'] == 2) {
                        echo '<button class="btn btn-sm btn-warning" disabled>Terminado</button>';
                    }
                    ?>
                </td>
                <td><?php echo $value['fecha_creacion']; ?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm btnEditarEvento" idEvento="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#modalEditarEvento"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm btnEliminarEvento" idEliminarEvento="<?php echo $value['id']; ?>"><i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>
            <?php 
                    }
                }
            ?>
        </tbody>
    </table>

    <!--================= 
    = MODAL CREAR EVENTOS
    ==================-->
    <div class="modal fade" id="modalAgregarEvento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" role="form" enctype="multipart/form-data">

                    <!-- CABECERA DEL MODAL-->
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- CUERPO DEL MODAL -->
                    <div class="modal-body">

                        <!--Entrada para el nombre del evento -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoEvento"><i class="fas fa-calendar-check"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="nuevoEvento" name="nuevoEvento" placeholder="Ingresar nombre del evento" required>
                            </div>
                        </div>

                        <!-- Entreda para la Ubicacion del evento -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevaUbicacion"><i class="fas fa-map-marker-alt"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="nuevaUbicacion" name="nuevaUbicacion" placeholder="Lugar o ubicacion donde sera el evento" required>
                            </div>
                        </div>

                        <!-- Entreda para el socio del evento si tiene uno -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoSocio"><i class="fas fa-user"></i></label>
                                </div>
                                <select name="nuevoSocio" class="form-control input-lg" id="nuevoSocio">
                                    <option value="">-- Seleccionar perfil --</option>

                                    <?php
                                    $item = null;
                                    $valor = null; 
                                    $socios = ControllerUsuarios::ctrMostrarUsuario($item, $valor);

                                    foreach ($socios as $key => $value) {
                                        if ($value['tipo'] == 'socio' && $value['estado'] == 1) {
                                            echo "<option value=".$value['id'].">".$value['nombre']."</option>";
                                        }
                                    }      
                                    ?>
                                </select>
                            </div>
                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnAgregarEvento">Agregar evento</button>
                    </div>
                </form>
                <?php 
                    $crearEvento = new ControllerEventos();
                    $crearEvento->ctrCrearEvento();
                ?>
            </div>
        </div>
    </div>

    <!--================= 
    = MODAL EDITAR EVENTOS
    ==================-->
    <div class="modal fade" id="modalEditarEvento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" role="form" enctype="multipart/form-data">

                    <!-- CABECERA DEL MODAL-->
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- CUERPO DEL MODAL -->
                    <div class="modal-body">

                        <!--Entrada para el nombre del evento -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarEvento"><i class="fas fa-calendar-check"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="editarEvento" name="editarEvento" required>
                                <input type="hidden" id="idEvento" name="idEvento">
                            </div>
                        </div>

                        <!-- Entreda para la Ubicacion del evento -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarUbicacion"><i class="fas fa-map-marker-alt"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="editarUbicacion" name="editarUbicacion" required>
                            </div>
                        </div>

                        <!-- Entreda para el socio del evento si tiene uno -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarSocio"><i class="fas fa-user"></i></label>
                                </div>
                                <select name="editarSocio" class="form-control input-lg">
                                    <option value="" id="editarSocio"></option>
                                    <option value="">Sin socio</option>

                                    <?php
                                    $item = null;
                                    $valor = null; 
                                    $socios = ControllerUsuarios::ctrMostrarUsuario($item, $valor);

                                    foreach ($socios as $key => $value) {
                                        if ($value['tipo'] == 'socio' && $value['estado'] == 1) {
                                            echo "<option value=".$value['id'].">".$value['nombre']."</option>";
                                        }
                                    }      
                                    ?>
                                </select>
                            </div>
                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnEditarEvento">Editar evento</button>
                    </div>
                </form>
                <?php 
                    $editarEvento = new ControllerEventos();
                    $editarEvento->ctrEditarEvento();
                ?>
            </div>
        </div>
    </div>
</main>