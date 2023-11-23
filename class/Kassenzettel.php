<?php

class Kassenzettel extends DbConn
{
    private string $id;
    private string $datumUhr;
    public static string $tblname = 'kassenzettel';
    public function __construct(string $datumUhr)
    {
        $this->datumUhr = $datumUhr;

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getDatumUhr(): string
    {
        return $this->datumUhr;
    }

    public function setDatumUhr(string $datumUhr): void
    {
        $this->datumUhr = $datumUhr;
    }
    public static function create(string $datumUhr): DbConn
    {
        $conn = self::getConn();
        $sql = "INSERT INTO kassenzettel (datumUhr) VALUES (:datumUhr)";
        //$format = $datumUhr->format('Y-m-d H:i:s');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':datumUhr', $datumUhr);
        $stmt->execute();
        return self::findbyID($conn->lastInsertId());
    }
    public static function read($id):static
    {
        $sql = "SELECT * FROM kassenzettel WHERE id = :id";
        $conn = self::getConn();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id );
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $teil = new Kassenzettel($result['datumUhr']);
        $teil->setId($result['id']);
        return $teil;
    }
    public static function update(int $id, string $datumUhr): void
    {
        $conn = self::getConn();
        $sql = "UPDATE kassenzettel 
                SET datumUhr = :datumUhr
                WHERE id = :id";

        //$format = $datumUhr->format('Y-m-d H:i:s');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':datumUhr', $datumUhr);
        $stmt->execute();
    }
    public static function delete(int $id): void
    {
        $conn = self::getConn();
        $sql = "DELETE FROM kassenzettel 
                WHERE id = :id";

        //$format = $datumUhr->format('Y-m-d H:i:s');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}