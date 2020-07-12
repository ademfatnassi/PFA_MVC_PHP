<?php
require_once("Model.php");
class ModelCity extends Model
{
    private $idCity;
    private $nameCity;

    protected static $table = 'city';
    protected static $primary = 'idCity';
    public function __construct($idCity = NULL, $name = NULL)
    {
        if (!is_null($idCity) && !is_null($name)) {
            $this->idCity = $idCity;
            $this->name = $name;
        }
    }

    /**
     * Get the value of idCity
     */
    public function getIdCity()
    {
        return $this->idCity;
    }

    /**
     * Get the value of name
     */
    public function getNameCity()
    {
        return $this->nameCity;
    }
}
