<?php

class Dosen extends User
{
    private ?Ruang $ruang;

    /**
     * @param int $id,
     * @param ?string $username
     * @param ?string $email
     * @param ?string $password
     * @param ?string $salt
     * @param ?string $role
     * @param ?UserDetails $userDetails
     * @param ?Ruang $ruang
     */
    public function __construct($id, $username = null, $email = null, $password = null, $salt = null, $role = null, $userDetails = null, $ruang = null)
    {
        parent::__construct(
            id: $id,
            username: $username,
            email: $email,
            password: $password,
            salt: $salt,
            role: $role,
            userDetails: $userDetails,
        );

        $this->ruang = $ruang;
    }

    public function getRuang()
    {
        return $this->ruang;
    }
}
