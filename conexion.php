<?php
    class BaseDatos{
        private $conexion;
        private $user ;
        private $host;
        private $pass ;
        private $db;
        
        public function __construct() {
            $this->user = "root";
            $this->host = "localhost";
            $this->pass = "";
            $this->db = "ud04";
        }

        /* Establece la conexión la BD.*/
        public function conectar() {
            $this->conexion = new mysqli($this->host,$this->user,$this->pass,$this->db);

            if ($this->conexion->connect_errno) {
                printf("Connect failed: %s\n", $mysqli->connect_error);
                exit();
            } else {
                return $this->conexion;
            }       
        }

        public function seleccionar($query) {
            $resultado=$this->conexion->query($query);

            if (!$resultado) {
                echo 'Hubo un error en la conexión con la base de datos.';
                exit;
            }

            return $resultado;
        }

        public function insertar($query) {
            $resultado=$this->conexion->query($query);

            if (!$resultado) {
                echo "Los datos no pudieron ser enviados a la base de datos. <br>";
            } 
        }

        public function eliminar($query) {
            $resultado=$this->conexion->query($query);

            if (!$resultado) {
                echo "Los datos no pudieron ser enviados a la base de datos. <br>";
            } 
        }

        public function update($query) {
            $resultado=$this->conexion->query($query);

            if (!$resultado) {
                echo "Los datos no pudieron ser enviados a la base de datos. <br>";
            } 
        }

        function findOrCreateCesta() {
            global $bd;
    
            if (!$_SESSION['usuario']['Administrador']) {
                $resCesta = $bd->seleccionar("select * from cesta where cesta.idusuario = " . $_SESSION['usuario']['idusuario'] . " and cesta.comprado = 'N'");
                $cesta = $resCesta->fetch_assoc();
        
                if (!isset($cesta['idcesta'])) {
                    $bd->insertar("insert into cesta (idusuario, comprado) values (" . $_SESSION['usuario']['idusuario'] . ", 'N')");
                    $resCesta = $bd->seleccionar("select * from cesta where cesta.idusuario = " . $_SESSION['usuario']['idusuario'] . " and cesta.comprado = 'N'");
                    $cesta = $resCesta->fetch_assoc();
                }
            }
    
            return $cesta;
        }
    }
?>
