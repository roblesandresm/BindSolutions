<!-- GESTION DE PUNTOS DE VENTA -->
<main class="main col">
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <h1>Administrar puntos de venta</h1>
        </div>
        <div class="col-lg-6 col-xs-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio"><i class="fas fa-home"></i>Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Administrar puntos de venta</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row action-buttons mb-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPuntoVenta">Agregar punto de venta</button>
    </div>

    <table class="table dt-responsive table-hover tablas-pos tablaEventos">
        <thead>
            <tr>
                <th scope="col" style="width: 10px;">ID</th>
                <th scope="col">Nombre punto venta</th>
                <th scope="col">Nombre evento</th>
                <th scope="col">Nombre vendedor</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $item = null;
            $valor = null;
            $puntosVenta = ControllerPuntosVenta::ctrMostrarPuntosVenta($item, $valor);

            foreach ($puntosVenta as $key => $value) {
                if ($value['estado'] != 0) {
            ?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td class='text-success'><?php echo $value['nombre']; ?></td>
                <td class='text-success'><?php echo $value['evento']; ?></td>
                <td class='text-success'><?php echo $value['vendedor']; ?></td>
                <td>
                    <?php
                    if ($value['estado'] == 1) {
                        echo "<button class='btn btn-sm btn-success btnActivarPv' estadoPuntoVenta='".$value['estado']."' idPuntoVenta='".$value['id']."'>Activo</button>";
                    } else if ($value['estado'] == 2) {
                        echo "<button class='btn btn-sm btn-warning btnActivarPv' estadoPuntoVenta='".$value['estado']."' idPuntoVenta='".$value['id']."'>Desactivado</button>";
                    }
                    ?>
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm btnEditarPuntoVenta" idPuntoVenta="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#modalEditarPuntoVenta"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm btnEliminarPuntoVenta" idPuntoVenta="<?php echo $value['id']; ?>"><i class="fas fa-times"></i></button>
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
    = MODAL CREAR PUNTO DE VENTA
    ==================-->
    <div class="modal fade" id="modalAgregarPuntoVenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" role="form" enctype="multipart/form-data">

                    <!-- CABECERA DEL MODAL-->
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Punto de venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- CUERPO DEL MODAL -->
                    <div class="modal-body">

                        <!--Entrada para el nombre del punto de venta -->
                        <!-- <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoPv"><i class="fas fa-calendar-check"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="nuevoPv" name="nuevoPv" placeholder="Ingresar nombre punto fr venta" required>
                            </div>
                        </div> -->

                        <!-- Entreda para el vevento donde se creara el punto de venta -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoEventoPv"><i class="fas fa-calendar-check"></i></label>
                                </div>
                                <select name="nuevoEventoPv" class="form-control input-lg" id="nuevoEventoPv" required>
                                    <option value="">-- Seleccionar un evento --</option>

                                    <?php
                                    $item = null;
                                    $valor = null; 
                                    $evento = ControllerEventos::ctrMostrarEventos($item, $valor);

                                    foreach ($evento as $key => $value) {
                                        if ($value['estado'] == 1) {
                                            echo "<option value=".$value['id'].">".$value['nombre']."</option>";
                                        }
                                    }      
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Entreda para el vendedor del punto de venta -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoVendedorPv"><i class="fas fa-user"></i></label>
                                </div>
                                <select name="nuevoVendedorPv" class="form-control input-lg" id="nuevoVendedorPv" required>
                                    <option value="">-- Seleccionar un vendedor --</option>

                                    <?php
                                    $item = null;
                                    $valor = null; 
                                    $vendedor = ControllerUsuarios::ctrMostrarUsuario($item, $valor);

                                    foreach ($vendedor as $key => $value) {
                                        if ($value['tipo'] == 'vendedor' && $value['estado'] == 1) {
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
                        <button type="submit" class="btn btn-primary" id="btnAgregarPv">Crear punto de venta</button>
                    </div>
                </form>
                <?php 
                    $crearPv = new ControllerPuntosVenta();
                    $crearPv->ctrCrearPuntoVenta();
                ?>
            </div>
        </div>
    </div>

    <!--========================== 
    = MODAL EDITAR PUNTO DE VENTA
    ============================-->

    <div class="modal fade" id="modalEditarPuntoVenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" role="form" enctype="multipart/form-data">

                    <!-- CABECERA DEL MODAL-->
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Punto de venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- CUERPO DEL MODAL -->
                    <div class="modal-body">

                        <input type="hidden" name="editarPuntoVenta" id="editarPuntoVenta">
                        <input type="hidden" name="idPuntoVenta" id="idPuntoVenta">

                        <!-- Entreda para el vevento donde se creara el punto de venta -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarEventoPv"><i class="fas fa-calendar-check"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="editarEventoNombre" readonly required>
                                <input type="hidden" name="editarEventoPv" id="editarEventoPv">
                            </div>
                        </div>

                        <!-- Entreda para el vendedor del punto de venta -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarVendedorPv"><i class="fas fa-user"></i></label>
                                </div>
                                <select name="editarVendedorPv" class="form-control input-lg" required>
                                    <option id="editarVendedorPv" value="">-- Seleccionar un vendedor --</option>

                                    <?php
                                    $item = null;
                                    $valor = null; 
                                    $vendedor = ControllerUsuarios::ctrMostrarUsuario($item, $valor);

                                    foreach ($vendedor as $key => $value) {
                                        if ($value['tipo'] == 'vendedor' && $value['estado'] == 1) {
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
                        <button type="submit" class="btn btn-primary" id="btnAgregarPv">Crear punto de venta</button>
                    </div>
                </form>
                <?php 
                    $editarPv = new ControllerPuntosVenta();
                    $editarPv->ctrEditarPuntoVenta();
                ?>
            </div>
        </div>
    </div>
</main>