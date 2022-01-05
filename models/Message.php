<?php
require 'conexion.php';

class Message
{
    private $id;
    private $incoming_id;
    private $outgoing_id;
    private $created_at;
    private $text;

    public function create($id, $incoming_id, $outgoing_id, $created_at, $text)
    {
        $this->id = $id;
        $this->incoming_id = $incoming_id;
        $this->outgoing_id = $outgoing_id;
        $this->created_at = $created_at;
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIncomingId()
    {
        return $this->incoming_id;
    }

    public function getOutgoingId()
    {
        return $this->outgoing_id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIncomingId($incoming_id)
    {
        $this->incoming_id = $incoming_id;
    }

    public function setOutgoingId($outgoing_id)
    {
        $this->outgoing_id = $outgoing_id;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function get()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "SELECT * FROM message WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $this->id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $this->id = $result['id'];
        $this->incoming_id = $result['incoming_id'];
        $this->outgoing_id = $result['outgoing_id'];
        $this->created_at = $result['date'];
        $this->text = $result['msg'];

        return $this;
    }

    public function save()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "INSERT INTO message (incoming_id, outgoing_id, date, msg) VALUES (:incoming_id, :outgoing_id, :msg)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':incoming_id', $this->incoming_id);
        $statement->bindParam(':outgoing_id', $this->outgoing_id);
        $statement->bindParam(':msg', $this->text);
        $statement->execute();

        return $this;
    }

    public function update()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "UPDATE message SET incoming_id = :incoming_id, outgoing_id = :outgoing_id, date = :date, msg = :msg WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':incoming_id', $this->incoming_id);
        $statement->bindParam(':outgoing_id', $this->outgoing_id);
        $statement->bindParam(':date', $this->created_at);
        $statement->bindParam(':msg', $this->text);
        $statement->bindParam(':id', $this->id);
        $statement->execute();

        return $this;
    }

    public function delete()
    {
        $con = new Conexion();
        $pdo = $con->getPDO();

        $sql = "DELETE FROM message WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $this->id);
        $statement->execute();
    }
}
