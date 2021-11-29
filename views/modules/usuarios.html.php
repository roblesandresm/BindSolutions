<!-- CONTENIDO GESTION DE USUARIOS -->
<main class="main col col-sm-auto">
    <div class="row action-buttons">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Crear usuario</button>
    </div>
    <table class="table dt-responsive table-hover tablas-pos">
        <thead>
            <tr>
                <th scope="col" style="width: 10px;">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Username</th>
                <th scope="col">Perfil</th>
                <th scope="col">Estado</th>
                <th scope="col">Ultimo login</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Andres Robles</td>
                <td>crashzedran</td>
                <td>administrador</td>
                <td><button class="btn btn-success btn-sm">Activado</button></td>
                <td>2021-11-20 04:22:12</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Andres Robles</td>
                <td>crashzedrandev</td>
                <td>administrador</td>
                <td><button class="btn btn-danger btn-sm">Desactivado</button></td>
                <td>2021-11-20 04:22:12</td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- MODAL CREAR USUARIO -->
    <div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" role="form" enctype="multipart/form-data">
                    <div class="modal-header" style="background: #3c8dbc; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--Entrada para el nombre  -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoNombre"><i class="fas fa-user"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="nuevoNombre" name="nuevoNombre" placeholder="Ingresar nombre" require>
                            </div>
                        </div>
                        <!-- Entreda para el username -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoUsuario"><i class="fas fa-key"></i></label>
                                </div>
                                <input class="form-control input-lg" type="text" id="nuevoUsuario" name="nuevoUsuario" placeholder="Ingresar usuario" require>
                            </div>
                        </div>
                        <!-- Entreda para el password -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoPassword"><i class="fas fa-lock"></i></label>
                                </div>
                                <input class="form-control input-lg" type="password" id="nuevoPassword" name="nuevoPassword" placeholder="Ingresar una contraseña" require>
                            </div>
                        </div>
                        <!-- Entreda para el tipo de usuario -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="nuevoUsuario"><i class="fas fa-users"></i></label>
                                </div>
                                <select name="nuevoTipo" class="form-control input-lg" id="nuevoTipo">
                                    <option value="">-- Seleccionar perfil --</option>
                                    <option value="administrador">administrador</option>
                                    <option value="socio">socio</option>
                                    <option value="vendedor">vendedor</option>
                                </select>
                            </div>
                        </div>
                        <!-- Entrada para foto de usuario -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" name="nuevaFoto" id="nuevaFoto">
                            <p class="help-block">Peso maximo de la foto 200 kb</p>
                            <img src="views/img/usuarios/default/anonymous.png"  class="img-tumbneil" alt="imagen usuario por defecto" width="100px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>