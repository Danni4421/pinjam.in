<?php

class Peminjam extends User
{
    private ?string $instansi;
    private ?string $logoInstansi;

    public function __construct($id, $username=null, $email=null, $password=null, $role=null, $userDetails=null, $instansi=null, $logoInstansi=null)
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
