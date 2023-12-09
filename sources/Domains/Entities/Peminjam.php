<?php

class Peminjam extends User
{
    private string $instansi;
    private string $logoInstansi;

    public function __construct($id, $username, $email, $password, $role, $userDetails, $instansi, $logoInstansi)
    {
        parent::__construct(
            id: $id,
            username: $username,
            email: $email,
            password: $password,
            role: $role,
            userDetails: $userDetails,
        );

        $this->instansi = $instansi;
        $this->logoInstansi = $logoInstansi;
    }

    public function getInstansi()
    {
        return $this->instansi;
    }

    public function getLogoInstansi()
    {
        return $this->logoInstansi;
    }
}
