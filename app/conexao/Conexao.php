<?php
class Conexao {
   
   public static $instance;

   private function __construct() {
       //
   }

   public static function getConexao() {


        $host = 'localhost;port=5432';
        $dbname = 'github';
        $user = 'postgres';
        $pass = 'aldo1020';


        try {
      
            if (!isset(self::$instance)) {
                self::$instance = new \PDO('pgsql:host='.$host.';dbname=' . $dbname . ';options=\'--client_encoding=UTF8\'', $user, $pass);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(\PDO::ATTR_ORACLE_NULLS, \PDO::NULL_EMPTY_STRING);
            }

            return self::$instance;
        
        } catch (Exception $ex) {
            echo $ex.'<br>';
        }
        
   }

}