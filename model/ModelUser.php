<?php
require_once("Model.php");
class ModelUser extends Model
{
    private $idUser; // User.ID
    private $nom; //User.firstName
    private $prenom; //User.lastName
    private $phone; //User.phone
    private $birthDate; //User.birthDate
    private $addresse; // User.addresse
    private $zip; //User.Zip Code
    private $email; //User.Email
    private $password; //User.password
    private $gender; //User.gender
    private $idCity; //User.idCity
    private $role; //User.role
    private $uStatus; //User.status 
    private $inscritDate; //User.date_of_registration date("Y-m-d")

    protected static $table = 'user';
    protected static $primary = 'idUser';
    public function __construct($idUser = NULL,  $nom = NULL, $prenom = NULL, $phone = NULL, $birthDate = NULL, $addresse = NULL, $zip = NULL, $email = NULL, $password = NULL, $gender = NULL, $idCity = NULL,  $uStatus = NULL, $role = NULL,  $inscritDate = null)
    {

        $this->idUser = $idUser;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->phone = $phone;
        $this->birthDate = $birthDate;
        $this->addresse = $addresse;
        $this->zip = $zip;
        $this->email = $email;
        $this->password = $password;
        $this->gender = $gender;
        $this->role = $role;
        $this->uStatus = $uStatus;
        $this->idCity = $idCity;
        $this->inscritDate = $inscritDate;
    }

    public function __toString()
    {
        return $this->nom . " " . $this->prenom;
    }

    public function findUserByEmail($UniqEmail)
    {
        $sql = "SELECT * from " . static::$table . " WHERE email =:email";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":email", $UniqEmail);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model' . ucfirst(static::$table));
        if ($req_prep->rowCount() == 0) {
            return null;
            die();
        } else {
            $rslt = $req_prep->fetch();
            return $rslt;
        }
    }
    // public function fetch__phone($UniqPhone)
    // {
    //     $sql = "SELECT * from " . static::$table . " WHERE phone =:phone";
    //     $req_prep = Model::$pdo->prepare($sql);
    //     $req_prep->bindParam(":phone", $UniqPhone);
    //     $req_prep->execute();
    //     $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model' . ucfirst(static::$table));
    //     if ($req_prep->rowCount() == 0) {
    //         return null;
    //         die();
    //     } else {
    //         $rslt = $req_prep->fetch();
    //         return $rslt;
    //     }
    // }

    public function login($email, $pwd)
    {
        $sql = "SELECT * from " . static::$table . " WHERE email =:email and Password =:password";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":email", $email);
        $req_prep->bindParam(":password", $pwd);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Model' . ucfirst(static::$table));
        if ($req_prep->rowCount() == 0) {
            return null;
            die();
        } else {
            $rslt = $req_prep->fetch();
            return $rslt;
        }
    }

    /**
     * Custum Getter of fullname
     */
    public function getFullName()
    {
        return $this->prenom . " " . $this->nom;
    }

    /**
     * Get the value of idUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the value of birthDate
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Get the value of addresse
     */
    public function getAddresse()
    {
        return $this->addresse;
    }

    /**
     * Get the value of zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the value of uStatus
     */
    public function getUStatus()
    {
        return $this->uStatus;
    }

    /**
     * Get the value of cityId
     */
    public function getIdCity()
    {
        return $this->idCity;
    }

    /**
     * Get the value of inscritDate
     */
    public function getInscritDate()
    {
        return $this->inscritDate;
    }

    /**
     * Set the value of idCity
     *
     * @return  self
     */
    public function setIdCity($idCity)
    {
        $this->idCity = $idCity;

        return $this;
    }
}
