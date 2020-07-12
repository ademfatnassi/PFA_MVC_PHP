<?php
require_once("{$ROOT}{$DS}config{$DS}Conf.php");
class Model
{
    protected static $pdo;
    /*créer une seule instance de la classe PDO*/
    public static function Init()
    {
        $host = Conf::getHostname();
        $dbname = Conf::getDatabase();
        $login = Conf::getLogin();
        $pass = Conf::getPassword();
        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    //Création d’un objet de la classe PDO
    public function getAll()
    {
        $SQL = "SELECT * FROM " . static::$table;
        $rep = self::$pdo->query($SQL);
        $rep->setFetchMode(
            PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Model' . ucfirst(static::$table)
        );
        // I added PDO::FETCH_PROPS_LATE to fix a problem occuered
        // I want constructor to be executed *before* PDO assings the object properties
        // because smthng weird happen (I guess smthng wrong happen in class mapping by PDO::FETCH_CLASS)
        //  that I can't use ModelUser's getters in viewAllUsersAdmin, 
        //  and instead of that  I'used db_column_name eg: $u->Email not $u->getEmail()

        return $rep->fetchAll();
    }

    public function select($cle_primaire)
    {
        $sql = "SELECT * from " . static::$table . " WHERE " . static::$primary . "=:cle_primaire";
        $req_prep = self::$pdo->prepare($sql);
        $req_prep->bindParam(":cle_primaire", $cle_primaire);
        $req_prep->execute();
        $req_prep->setFetchMode(
            PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Model' . ucfirst(static::$table)
        );
        if ($req_prep->rowCount() == 0) {
            return null;
        } else {
            $rslt = $req_prep->fetch();
            return $rslt;
        }
    }

    public function getAllByColumn($column, $Value)
    {
        $sql = "SELECT * from " . static::$table . " WHERE " . $column . "=:column_value";
        $req_prep = self::$pdo->prepare($sql);
        $req_prep->bindParam(":column_value", $Value);
        $req_prep->execute();
        $req_prep->setFetchMode(
            PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Model' . ucfirst(static::$table)
        );
        // if ($req_prep->rowCount() == 0) {
        //     return null;
        // } else {
        $rslt = $req_prep->fetchAll();
        return $rslt;
        // }
    }
    public function delete($cle_primaire)
    {
        $sql = "DELETE FROM " . static::$table . " WHERE " . static::$primary . "=:cle_primaire";
        $req_prep = self::$pdo->prepare($sql);
        $req_prep->bindParam(":cle_primaire", $cle_primaire);
        $req_prep->execute();
    }

    public function update($tab, $cle_primaire)
    {
        $sql = "UPDATE " . static::$table . " SET";
        foreach ($tab as $cle => $valeur) {
            $sql .= " " . $cle . "=:new" . $cle . ",";
        }
        $sql = rtrim($sql, ",");
        $sql .= " WHERE " . static::$primary . "=:oldid;";

        $req_prep = Model::$pdo->prepare($sql);
        $values = array();

        foreach ($tab as $cle => $valeur) {
            $values[":new" . $cle] = $valeur;
        }

        $values[":oldid"] = $cle_primaire;
        $req_prep->execute($values);
        echo $req_prep->rowCount();
        $obj = Model::select($tab[static::$primary]);
        return $obj;
    }
    public function insert($tab)
    {
        $sql = "INSERT INTO " . static::$table . " VALUES(";
        foreach ($tab as $cle => $valeur) {
            $sql .= " :" . $cle . ",";
        }
        $sql = rtrim($sql, ",");
        $sql .= ");";
        echo "<br>" . $sql;
        $req_prep = Model::$pdo->prepare($sql);
        $values = array();
        foreach ($tab as $cle => $valeur)
            $values[":" . $cle] = $valeur;

        try {
            Model::$pdo->beginTransaction();
            $req_prep->execute($values);
            Model::$pdo->commit();
        } catch (PDOExecption $e) {
            Model::$pdo->rollback();
        }
        // echo "<br>";
        // print_r($values);
        // echo "<br>" . $req_prep->rowcount();
    }
    public function insertAndGetLastId($tab)
    {
        $sql = "INSERT INTO " . static::$table . " VALUES(";
        foreach ($tab as $cle => $valeur) {
            $sql .= " :" . $cle . ",";
        }
        $sql = rtrim($sql, ",");
        $sql .= ");";
        echo "<br>" . $sql;
        $req_prep = Model::$pdo->prepare($sql);
        $values = array();
        foreach ($tab as $cle => $valeur)
            $values[":" . $cle] = $valeur;
        $req_prep->execute($values);
        $last_id =  Model::$pdo->lastInsertId();
        return $last_id;
    }
}
Model::Init();
