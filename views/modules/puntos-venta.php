<!-- GESTION DE PUNTOS DE VENTA -->
<main class="main col-10">
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
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalAgregarPuntoVenta">Agregar punto de venta</button>
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
            <tr>
                <td>1</td>
                <td class='text-success'>puntoventa0012</td>
                <td class='text-success'>Concierto maluma</td>
                <td class='text-success'>Federico Contreras</td>
                <td><button class='btn btn-sm btn-success btnActivo' idPuntoVenta=''>Activo</button></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm btnEditarPuntoVenta" idPuntoVenta="" data-toggle="modal" data-target="#modalEditarPuntoVenta"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-sm btnEliminarPuntoVenta" idEliminarPuntoVenta=""><i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</main>