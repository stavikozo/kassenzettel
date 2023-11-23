<?php

class Proctukt extends DbConn
{
    private string $id;
    private string $name;
    private float $preis;
    private float $MwSt;
    public static string $tblname = 'produkte';
    public function __construct(string $name, float $preis, float $MwSt)
    {
        $this->name = $name;
        $this->preis = $preis;
        $this->MwSt = $MwSt;

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPreis(): float
    {
        return $this->preis;
    }

    public function setPreis(float $preis): void
    {
        $this->preis = $preis;
    }

    public function getMwSt(): int
    {
        return $this->MwSt;
    }

    public function setMwSt(int $MwSt): void
    {
        $this->MwSt = $MwSt;
    }


    public static function create(string $name, float $preis, float $MwSt): DbConn
    {
        $conn = self::getConn();
        $sql = "INSERT INTO produkte (name, preis, MwSt) VALUES (:name, :preis, :MwSt)";
        //$format = $datumUhr->format('Y-m-d H:i:s');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':preis', $preis);
        $stmt->bindParam(':MwSt', $MwSt);
        $stmt->execute();
        return self::findbyID($conn->lastInsertId());
    }
    public static function read($id):static
    {
        $sql = "SELECT * FROM produkte WHERE id = :id";
        $conn = self::getConn();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id );
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $teil = new Proctukt($result['name'], $result['preis'], $result['MwSt']);
        $teil->setId($result['id']);
        return $teil;
    }
    public static function update(int $id, string $name, float $preis, float $MwSt): void
    {
        $conn = self::getConn();
        $sql = "UPDATE produkte 
                SET name = :name, preis = :preis, MwSt = :MwSt
                WHERE id = :id";

        //$format = $datumUhr->format('Y-m-d H:i:s');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':preis', $preis);
        $stmt->bindParam(':MwSt', $MwSt);
        $stmt->execute();
    }
    public static function delete(int $id): void
    {
        $conn = self::getConn();
        $sql = "DELETE FROM produkte 
                WHERE id = :id";

        //$format = $datumUhr->format('Y-m-d H:i:s');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}