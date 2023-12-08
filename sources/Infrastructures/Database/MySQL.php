<?php

class MySQL extends Database
{
    private ?mysqli_stmt $statement;
    public function __construct()
    {
        parent::__construct(
            hostname: "localhost",
            username: "root",
            password: "",
            database: "pinjam.in"
        );
        $this->connect();
        $this->statement = null;
    }

    public function __destruct()
    {
        if (!is_null($this->statement)) {
            $this->statement->close();
            $this->statement = null;
        }
    }

    public function connect(): void
    {
        $this->connection = new mysqli(
            hostname: $this->hostname,
            username: $this->username,
            password: $this->password,
            database: $this->database
        );

        if ($this->connection->connect_error) {
            $this->setError('Connection Failed.');
        }
    }

    public function query(string $sql, array $params = []): void
    {
        try {
            $this->statement =  $this->connection->prepare($sql);

            if (!empty($params)) {
                $type = $this->generateStringTypeFromParams($params);
                $this->statement->bind_param($type, ...$params);
            }

            $this->statement->execute();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            throw new Exception('Terjadi Masalah pada Server.');
        }
    }

    public function verifyInput(mixed $input): string
    {
        return $this->connection->real_escape_string(htmlspecialchars($input, ENT_QUOTES));
    }

    private function generateStringTypeFromParams(array $params): string
    {
        $result = "";

        foreach ($params as $param) {
            if (is_string($param)) {
                $result .= "s";
            } elseif (is_numeric($param)) {
                switch (gettype($param)) {
                    case "integer":
                        $result .= "i";
                        break;
                    case "float" || "double":
                        $result .= "d";
                        break;
                }
            }
        }
        return $result;
    }

    public function result(): mixed
    {
        return $this->statement->get_result();
    }

    public function get_last_inserted_id(): mixed
    {
        return $this->connection->insert_id;
    }
}
