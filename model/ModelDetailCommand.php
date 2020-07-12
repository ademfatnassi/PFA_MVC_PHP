<?php
require_once("Model.php");
class ModelDetailCommand extends Model
{
    private $idCommand;
    private $idProduct;
    private $Quantity;
    // private $Remise;

    protected static $table = 'detailcommand';
    protected static $primary = 'idCommand';
    protected static $primary2 = 'idProduct';

    public function __construct($idCommand = NULL, $idProduct = NULL, $Quantity = NULL) //, $Remise = NULL)
    {
        $this->idCommand = $idCommand;
        $this->idProduct = $idProduct;
        $this->Quantity = $Quantity;
        // $this->Remise = $Remise;
    }

    public function deleteBy($command, $product)
    {
        // DELETE FROM `detailcommand` WHERE `detailcommand`.`idCommand` = 10 AND `detailcommand`.`idProduct` = 2
        $sql = "DELETE FROM " . static::$table . " WHERE `detailcommand`.`idCommand` =:column1_value AND `detailcommand`.`idProduct` =:column2_value";
        $req_prep = self::$pdo->prepare($sql);
        $req_prep->bindParam(":column1_value", $command);
        $req_prep->bindParam(":column2_value", $product);
        $req_prep->execute();
    }

    /**
     * Get the value of idCommand
     */
    public function getIdCommand()
    {
        return $this->idCommand;
    }

    /**
     * Get the value of idProduct
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * Get the value of Quantity
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * Get the value of Remise
     
    public function getRemise()
    {
        return $this->Remise;
    }*/
}
