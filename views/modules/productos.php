<!-- CONTENIDO GESTION DE PRODUCTOS 
    1- crear producto
    2- actualizar prodcuto
    3- listar productos
    4- dar de baja productos
-->
<main class="main col">
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <h1>Administrar productos</h1>
            </div>
            <div class="col-lg-6 col-xs-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i>Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Administrar productos</li>
                    </ol>
                </nav>
            </div>
        </div>
    <div class="row action-buttons">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAgregarProducto">Agregar producto</button>
    </div>
    <table class="table dt-responsive table-hover tablas-pos tablaProductos">
        <thead>
            <tr>
                <th scope="col" style="width: 10px;">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Foto</th>
                <th scope="col">Precio de compra</th>
                <th scope="col">Precio de venta</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $item = null;
                $valor = null;
                $productos = ControllerProductos::ctrMostrarProductos($item, $valor);

                foreach ($productos as $key => $value) {
                    if ($value['estado'] != 0) {
            ?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['nombre']; ?></td>
                <?php
                    if ($value['foto'] != "") {
                        echo "<td><img src=".$value['foto']." class='img-thumbnail' width='40px'></td>";
                    } else {
                        echo "<td><img src='views/img/productos/default/anonymous.png' class='img-thumbnail' width='40px'></td>";
                    }
                ?>
                <td class="text-success">$<?php echo $value['precio_compra']; ?></td>
                <td class="text-success">$<?php echo $value['precio_venta']; ?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm btnEditarProducto" idProducto="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#modalEditarProducto"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm btnEliminarProducto" idProducto="<?php echo $value['id']; ?>"><i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>

    <!--=========================
    =   MODAL CREAR PRODUCTO    =
    ==========================-->
    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" role="form" enctype="multipart/form-data">

                    <!-- CABECERA DEL MODAL-->
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- CUERPO DEL MODAL -->
                    <div class="modal-body">

                        <!--Entrada para el nombre del producto -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoProducto"><i class="fab fa-product-hunt"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="nuevoProducto" name="nuevoProducto" placeholder="Ingresar nombre producto" required>
                            </div>
                        </div>

                        <!-- Entreda para el precio de compra -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoPrecioCompra"><i class="fas fa-dollar-sign"></i></label>
                                </div>
                                <input class="form-control input-lg" type="number" min="0" id="nuevoPrecioCompra" name="nuevoPrecioCompra" placeholder="precio de compra" required>
                            </div>
                        </div>

                        <!-- Entreda para el precio de venta -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoPrecioVenta"><i class="fas fa-dollar-sign"></i></label>
                                </div>
                                <input class="form-control input-lg" type="number" min="0" id="nuevoPrecioVenta" name="nuevoPrecioVenta" placeholder="precio de venta" required>
                            </div>
                        </div>
                
                        <!-- Entrada para foto de producto -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div><br>
                            <input type="file" name="nuevaImagen" class="nuevaImagen"><br>
                            <p class="help-block">Peso maximo de la foto 2 mb</p>
                            <img src="views/img/productos/default/anonymous.png"  class="img-tumbneil previsualizar" alt="imagen producto" width="100px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnAgregarProducto">Agregar producto</button>
                    </div>
                </form>
                <?php 
                    $crearProducto = new ControllerProductos();
                    $crearProducto->ctrCrearProducto();
                ?>
            </div>
        </div>
    </div>


    <!--=========================
    =   MODAL EDITAR PRODUCTO   =
    ==========================-->
    <div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" role="form" enctype="multipart/form-data">

                    <!-- CABECERA DEL MODAL-->
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- CUERPO DEL MODAL -->
                    <div class="modal-body">

                        <!--Entrada para el nombre del producto -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarProducto"><i class="fab fa-product-hunt"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="editarProducto" name="editarProducto"  readonly required>
                                <input type="hidden" id="idProducto" name="idProducto">
                            </div>
                        </div>

                        <!-- Entreda para el precio de compra -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarPrecioCompra"><i class="fas fa-dollar-sign"></i></label>
                                </div>
                                <input class="form-control input-lg" type="number" min="0" id="editarPrecioCompra" name="editarPrecioCompra" required>
                            </div>
                        </div>

                        <!-- Entreda para el precio de venta -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="editarPrecioVenta"><i class="fas fa-dollar-sign"></i></label>
                                </div>
                                <input class="form-control input-lg" type="number" min="0" id="editarPrecioVenta" name="editarPrecioVenta" required>
                            </div>
                        </div>
                
                        <!-- Entrada para foto de producto -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div><br>
                            <input type="file" name="editarImagen" id="editarImagen" class="nuevaImagen"><br>
                            <p class="help-block">Peso maximo de la foto 2 mb</p>
                            <img src="views/img/productos/default/anonymous.png"  class="img-tumbneil previsualizar" alt="imagen producto" width="100px">
                            <input type="hidden" name="imagenActual" id="imagenActual">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnEditarProducto">Agregar producto</button>
                    </div>
                </form>
                <?php 
                    $editarProducto = new ControllerProductos();
                    $editarProducto->ctrEditarProducto();
                ?>
            </div>
        </div>
    </div>
</main>