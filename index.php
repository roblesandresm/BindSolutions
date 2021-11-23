<?php
require_once "controllers/template.controller.php";
require_once "controllers/usuarios.controller.php";
require_once "controllers/productos.controller.php";
require_once "controllers/eventos.controller.php";
require_once "controllers/puntos_venta.controller.php";
require_once "controllers/inventarios.controller.php";
require_once "controllers/vendedores.controller.php";
require_once "controllers/ventas.controller.php";

require_once "models/usuarios.model.php";
require_once "models/productos.model.php";
require_once "models/eventos.model.php";
require_once "models/puntos_venta.model.php";
require_once "models/inventarios.model.php";
require_once "models/vendedores.model.php";
require_once "models/ventas.model.php";

$template = new ControllerTemplate();
$template->ctrTemplate();
