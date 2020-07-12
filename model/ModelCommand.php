<?php
require_once("Model.php");
class ModelCommand extends Model
{
    private $idCommand; //Command.idCommand
    private $idUser; //Command.idUser
    private $CommandDate; //Command.Date_of_command
    private $LiveredDate; //Command.Date_of_shipment
    private $Status; //Command.status
    private $State; //Command.state
    private $payMethode; //Command.Methode_de_payment


    protected static $table = 'command';
    protected static $primary = 'idCommand';
    public function __construct($idCommand = NULL, $idUser = NULL, $CommandDate = NULL, $LiveredDate = NULL, $Status = NULL, $State = NULL, $payMethode = NULL)
    {
        $this->idCommand = $idCommand;
        $this->idUser = $idUser;
        $this->CommandDate = $CommandDate;
        $this->LiveredDate = $LiveredDate;
        $this->Status = $Status;
        $this->State = $State;
        $this->payMethode = $payMethode;
    }

    /**
     * Get the value of idCommand
     */
    public function getIdCommand()
    {
        return $this->idCommand;
    }

    /**
     * Get the value of idUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Get the value of CommandDate
     */
    public function getCommandDate()
    {
        return $this->CommandDate;
    }

    /**
     * Get the value of LiveredDate
     */
    public function getLiveredDate()
    {
        return $this->LiveredDate;
    }


    /**
     * Get the value of payMethode
     */
    public function getPayMethode()
    {
        return $this->payMethode;
    }

    /**
     * Get the value of Status
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Get the value of State
     */
    public function getState()
    {
        return $this->State;
    }
}
