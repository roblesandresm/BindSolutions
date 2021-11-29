<!-- CONTENIDO GESTION DE PRODUCTOS 
    1- crear producto
    2- actualizar prodcuto
    3- listar productos
    4- dar de baja productos
-->
<main class="main col">
        <div class="row">
            <div class="col">
                <h1>Administrar productos</h1>
            </div>
            <div class="col">
                <ul class="breadcrumb">
                    <li style="margin-right: 10px;"><a href="inicio"><i class="fas fa-home"></i>Inicio</a></li>
                    <li>Administrador productos</li>
                </ul>
            </div>
        </div>
    <div class="row action-buttons">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAgregarProducto">Agregar producto</button>
    </div>
    <table class="table dt-responsive table-hover tablas-pos">
        <thead>
            <tr>
                <th scope="col" style="width: 10px;">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Foto</th>
                <th scope="col">Estado</th>
                <th scope="col">Precio de compra</th>
                <th scope="col">Precio de venta</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Aguardiente Antioqueño</td>
                <td><img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td><button class="btn btn-success btn-sm">Activado</button></td>
                <td class="text-success">$45000</td>
                <td class="text-success">$56500</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm btnEditarProducto" data-toggle="modal" data-target="#modalEditarProducto"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>

            <tr>
                <td>1</td>
                <td>Aguardiente Antioqueño</td>
                <td><img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td><button class="btn btn-success btn-sm">Activado</button></td>
                <td class="text-success">$45000</td>
                <td class="text-success">$56500</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm btnEditarProducto" data-toggle="modal" data-target="#modalEditarProducto"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>

            <tr>
                <td>1</td>
                <td>Aguardiente Antioqueño</td>
                <td><img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td><button class="btn btn-success btn-sm">Activado</button></td>
                <td class="text-success">$45000</td>
                <td class="text-success">$56500</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm btnEditarProducto" data-toggle="modal" data-target="#modalEditarProducto"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>
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
                                <input class="form-control input-lg" type="text" id="nuevoProducto" name="nuevoProducto" placeholder="Ingresar nombre producto" require>
                            </div>
                        </div>
                        <!-- Entreda para el precio de compra -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoPrecioCompra"><i class="fas fa-dollar-sign"></i></label>
                                </div>
                                <input class="form-control input-lg" type="number" min="0" id="nuevoPrecioCompra" name="nuevoPrecioCompra" placeholder="precio de compra" require>
                            </div>
                        </div>

                        <!-- Entreda para el precio de venta -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoPrecioVenta"><i class="fas fa-dollar-sign"></i></label>
                                </div>
                                <input class="form-control input-lg" type="number" min="0" id="nuevoPrecioVenta" name="nuevoPrecioVenta" placeholder="precio de venta" require>
                            </div>
                        </div>
                
                        <!-- Entrada para foto de producto -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div><br>
                            <input type="file" name="nuevaFoto" class="nuevaFoto"><br>
                            <p class="help-block">Peso maximo de la foto 2 mb</p>
                            <img src="views/img/productos/default/anonymous.png"  class="img-tumbneil previsualizar" alt="imagen usuario por defecto" width="100px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar producto</button>
                    </div>
                    <?php 
                        /*
                        $crearUsuario = new ControllerProductos();
                        $crearUsuario->ctrCrearProducto();*/
                    ?>
                </form>
            </div>
        </div>
    </div>
</main>