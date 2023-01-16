<?php

class Images
{
    private $connection;
    private $table = "images";

    public $id;
    public $name;
    public $path;
    public $location;
    public $created_at;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function list()
    {
        $query = "SELECT * FROM $this->table";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read()
    {
        $query = "SELECT * FROM $this->table WHERE id = ?";

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->path = $row['path'];
        $this->location = $row['location'];
        $this->created_at = $row['created_at'];
    }

    public function create()
    {
        $query = "INSERT INTO $this->table (name, path, location, created_at) VALUES (:name, :path, :location, :created_at)";

        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->path = htmlspecialchars(strip_tags($this->path));
        $this->created_at = date('Y-m-d H:i:s');

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':path', $this->path);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':created_at', $this->created_at);

        // echo $stmt->debugDumpParams();
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
