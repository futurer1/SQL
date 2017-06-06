<?php
/**
* Шаблон Data Mapper
* Управление передачей данных от БД к объекту
*/
namespace woo\mapper;

abstract class Mapper
{
    protected static $PDO; 
  
    public function __construct()
    {
        if ( ! isset(self::$PDO) ) { 
            $dsn = \woo\base\ApplicationRegistry::getDSN( );
            if ( is_null( $dsn ) ) {
                throw new \woo\base\AppException( "DNS не определен" );
            }
            self::$PDO = new \PDO( $dsn );
            self::$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    public function find($id)
    {
    }

    public function createObject( $array )
    {
    }

    
}
