<?php
require 'conexion.php';

class User
{
    private $id;
    private $name;
    private $email;
    private $image;

    public function create($id, $name, $email, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->image = $image;
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

        return $this;
    }

    public function save()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "INSERT INTO usuario (name, email, image) VALUES (:name, :email, :image)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':image', $this->image);
        $statement->execute();

        return $this;
    }

    public function update()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "UPDATE usuario SET name = :name, email = :email, image = :image WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':image', $this->image);
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
