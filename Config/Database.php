<?php

/**
 * Database
 * 
 * Esta clase implementa el patrón singleton para poder proporcionar una unica misma conexión a la petición o proceso activo
 */
class Database {
    private static $instance = null;
    private $pdo;
    
    /**
     * Método contructor para generar la instancia de la clase que se encarga
     * de gestionar la conexión a la base de datos.
     * El método es privado para poder implementar el patron singleton.
     * @return void
     */
    private function __construct()
    {
        try {
            $host = "host=".DB_CONFIG['HOST'];
            $port = "port=";
            $port.= (isset(DB_CONFIG['PORT']) && strlen(DB_CONFIG['PORT'])>0) ? DB_CONFIG['PORT'] : '3306';
            $dbname = "dbname=".DB_CONFIG['DBNAME'];
            $cset = "charset=".DB_CONFIG['CHARSET'];
            $username = DB_CONFIG['USER'];
            $password = DB_CONFIG['PASS'];
            $connectionString = "mysql:{$host};{$port};{$dbname};{$cset}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true
            ];
            $this->pdo = new PDO($connectionString, $username, $password, $options);
        } catch (\Throwable $th) {
            $messageError = "Error en la conexión a la base de datos";
            if(DEBUG) {
                $messageError.= ": ".$th->getMessage();
            }
            die($messageError);
        }
    }
    
    /**
     * Método estático auxilar que permitirá generar la instancia de la clase.
     *
     * @return void
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    /**
     * Método que devuelve la conneción para poder realizar operaciones en la base de datos.
     *
     * @return void
     */
    public function getConnection() {
        return $this->pdo;
    }
}