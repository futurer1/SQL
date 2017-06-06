<?php
/**
* Шаблон Data Mapper
* Управление передачей данных от БД к объекту
*/
namespace woo\mapper;

abstract class Mapper
{
    protected $PDO; 
  
    public function __construct(\PDO $pdo)
    {
        $this->PDO = $pdo;
    }

    public function find($id)
    {
        $this->selectstmt()->execute( array( $id ) );
        $array = $this->selectstmt()->fetch( ); 
        $this->selectstmt()->closeCursor( ); 
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->createObject( $array );
        return $object;
    }

    public function createObject($array)
    {
        $obj = $this->doCreateObject($array);
        return $obj;
    }
    
    public function insert(\woo\domain\DomainObject $obj)      //делегирование полномочий методу doInsert()
                                                               //чтобы астрагироваться от реализации
    {
        $this->doInsert($obj);
    }

    abstract function update( \woo\domain\DomainObject $object );
    protected abstract function doCreateObject( array $array );
    protected abstract function doInsert( \woo\domain\DomainObject $object );
    protected abstract function selectStmt();
}
