<?php

class Bd
{
  private static ?PDO $pdo = null;

  static function pdo(): PDO
  {
    if (self::$pdo === null) {

      self::$pdo = new PDO(
        // cadena de conexión
        "mysql:host=fdb1030.awardspace.net;dbname=4543777_srvdb",
        // usuario
        "4543777_srvdb",
        // contraseña
        "jSSGkV0j2J@}KpYn",
        // Opciones: pdos no persistentes y lanza excepciones.
        [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );

      self::$pdo->exec(
        "CREATE TABLE IF NOT EXISTS CATEGORIA (
          CAT_ID INT NOT NULL AUTO_INCREMENT,
          CAT_NOMBRE VARCHAR(75) NOT NULL,
          CAT_DESCRIPCION VARCHAR(255) NOT NULL,
          CAT_ESTADO VARCHAR(50) NOT NULL,
          CONSTRAINT CAT_PK PRIMARY KEY (CAT_ID),
          CONSTRAINT CAT_NOM_UNQ UNIQUE (CAT_NOMBRE),
          CONSTRAINT CAT_NOM_NV CHECK (LENGTH(CAT_NOMBRE) > 0),
          CONSTRAINT CAT_DES_NV CHECK (LENGTH(CAT_DESCRIPCION) > 0),
          CONSTRAINT CAT_EST_NV CHECK (LENGTH(CAT_ESTADO) > 0)
        );
        "
      );
    }

    return self::$pdo;
  }
}
