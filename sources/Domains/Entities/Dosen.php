<?php

class Dosen extends User
{
    private Ruang $ruang;

    /**
     * @param int $id,
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $role
     * @param UserDetails $userDetails
     * @param Ruang $ruang
     */
    public function __construct($id, $username, $email, $password, $role, $userDetails, $ruang)
    {
        parent::__construct(
            id: $id,
            username: $username,
            email: $email,
            password: $password,
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
