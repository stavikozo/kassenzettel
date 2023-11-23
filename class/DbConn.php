<?php

abstract class DbConn
{
    public static string $tblname = '';

    protected static  function getConn():PDO
    {
        $servername = "localhost";
        $username = "root";
        $pass = "";
        $dbname = "kassenzettel";
        return $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
    }

    public static function findbyID(int $id): self
    {
        $tblname = static::$tblname;
        $conn = self::getConn();
        $sql = "SELECT * FROM {$tblname} WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject($tblname);
    }
    public static function findAll()
    {
        $tblname = static::$tblname;
        $conn = self::getConn();
        $sql = "SELECT * FROM {$tblname}";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}