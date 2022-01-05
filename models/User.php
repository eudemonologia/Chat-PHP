<?php
require 'conexion.php';

class User
{
    private $id;
    private $name;
    private $email;
    private $image;
    private $last_activity;
    private $last_msg;

    public function create($id, $name, $email, $image, $last_activity, $last_msg)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->image = $image;
        $this->last_activity = new DateTime($last_activity);
        $this->last_msg = $last_msg;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getLastActivity()
    {
        return $this->last_activity;
    }

    public function getLastMsg()
    {
        return $this->last_msg;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setLastActivity($last_activity)
    {
        $this->last_activity = $last_activity;
    }

    public function setLastMsg($last_msg)
    {
        $this->last_msg = $last_msg;
    }

    public function get()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "SELECT * FROM usuario WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $this->id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $this->id = $result['id'];
        $this->name = $result['name'];
        $this->email = $result['email'];
        $this->image = $result['image'];
        $this->last_activity = new DateTime($result['last_activity']);
        $this->last_msg = $result['last_msg'];

        return $this;
    }

    public function getByID($id)
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "SELECT * FROM usuario WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $this->id = $result['id'];
        $this->name = $result['name'];
        $this->email = $result['email'];
        $this->image = $result['image'];
        $this->last_activity = new DateTime($result['last_activity']);
        $this->last_msg = $result['last_msg'];

        return $this;
    }

    public function save()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "INSERT INTO usuario (name, email, image, last_activity) VALUES (:name, :email, :image, :last_activity)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':image', $this->image);
        $statement->bindParam(':last_activity', $this->last_activity);
        $statement->execute();

        return $this;
    }

    public function update()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "UPDATE usuario SET name = :name, email = :email, image = :image, last_activity = :last_activity WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':image', $this->image);
        $statement->bindParam(':last_activity', $this->last_activity);
        $statement->execute();

        return $this;
    }

    public function delete()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "DELETE FROM usuario WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $this->id);
        $statement->execute();
    }
}
