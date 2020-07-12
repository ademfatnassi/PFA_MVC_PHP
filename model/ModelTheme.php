<?php
require_once("Model.php");
class ModelTheme extends Model
{
    private $idTheme;
    private $tName;

    protected static $table = 'themes';
    protected static $primary = 'idTheme';
    public function __construct($idTheme = NULL, $tName = NULL)
    {
        $this->idTheme = $idTheme;
        $this->tName = $tName;
    }

    /**
     * Get the value of idTheme
     */
    public function getIdTheme()
    {
        return $this->idTheme;
    }

    /**
     * Get the value of tName
     */
    public function getTName()
    {
        return $this->tName;
    }

    public function __toString()
    {
        return $this->idTheme . " " . $this->tName;
    }
}
