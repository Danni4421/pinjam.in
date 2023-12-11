<?php

class AuthenticationRepository
{
    private MySQL $database;

    public function __construct(MySQL $database)
    {
        $this->database = $database;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function verifyEmailIsExists(string $email): bool
    {
        $this->database->query(
            sql: "SELECT email FROM users WHERE email = ?",
            params: [
                $email
            ]
        );

        return $this->database->result()->num_rows > 0;
    }

    /**
     * @param string $email
     * @param string $password
     * @return int
     */
    public function verifyPassword(string $email, string $password): int
    {
        $this->database->query(
            sql: 'SELECT id user_id, password hashed_password, salt FROM users WHERE email = ?',
            params: [
                $email
            ]
        );

        $user = $this->database->result()->fetch_assoc();

        $combined_password = $password . $user["salt"];
        if (Password::compare(password: $combined_password, hashed_password: $user["hashed_password"])) {
            return (int) $user["user_id"];
        }

        return 0;
    }
}
