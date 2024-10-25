<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CATEGORIA.php";

ejecutaServicio(function () {

  $lista = select(pdo: Bd::pdo(),  from: CATEGORIA,  orderBy: CAT_NOMBRE);

  $render = "";
  foreach ($lista as $modelo) {
    $encodeId = urlencode($modelo[CAT_ID]);
    $id = htmlentities($encodeId);
    $nombre = htmlentities($modelo[CAT_NOMBRE]);
    $descripcion = htmlentities($modelo[CAT_DESCRIPCION]);
    $estado = htmlentities($modelo[CAT_ESTADO]);
    $render .=
    "<dl>
      <dt>
        <a href='modifica.html?id=$id'>$nombre</a>
      </dt>
      <dd>
      <strong>Descripción: </strong>  $descripcion
      </dd>
      <dd>
        <strong>Estado: </strong>$estado
      </dd>
    </dl>";
  }

  devuelveJson(["lista" => ["innerHTML" => $render]]);
});
