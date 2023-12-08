<?php

class User implements HasRole
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $role;
    private UserDetails $userDetails;

    /**
     * @param int $id,
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $role
     * @param UserDetails $userDetails
     */
    public function __construct($id, $username, $email, $password, $role, $userDetails)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->userDetails = $userDetails;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function verifyRoleGoesOn()
    {
        switch ($this->role) {
            case "admin" || "superadmin":
                header("Location: /admin");
                break;
            default:
                header("Location: /");
                break;
        }
    }

    public function getUserDetails()
    {
        return $this->userDetails;
    }
}
