<?php

abstract class Database
{
    protected string $hostname, $username, $password, $database;
    protected mixed $connection, $result;
    private string $error;
    public function __construct(
        string $hostname,
        string $username,
        string $password,
        string $database
    ) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public abstract function connect(): void;
    public abstract function query(string $sql, array $params = []): void;
    public abstract function result(): mixed;
    public function setResult(mixed $result): void
    {
        $this->result = $result;
    }
    public function setError(string $error): void
    {
        $this->error = $error;
    }
    public function getError(): string
    {
        return $this->error;
    }
}
