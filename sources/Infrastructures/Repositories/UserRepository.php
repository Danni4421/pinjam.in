<?php

class UserRepository implements IUserRepository
{
    private Database $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param User $user
     * @return void
     */
    public function add($user)
    {
    }

    /**
     * @param User $user
     * @param UserDetails $userDetails
     * @return void
     */
    public function addDetails($user, $userDetails)
    {
    }

    /**
     * @return User[]
     */
    public function get()
    {
        return [];
    }

    /**
     * @param string $userId
     * @return User
     */
    public function getById($userId)
    {
        return new User(
            id: 1,
            username: "mockUsername",
            email: 'mock@mail.com',
            password: 'mockPassword',
            role: 'user',
            userDetails: new UserDetails(
                nomorInduk: "1901901901",
                namaLengkap: "mockNamaLengkap",
                alamat: "mockAlamat",
                noTelp: "mockNoTelp",
                fotoProfil: "mockFotoProfil"
            )
        );
    }

    /**
     * @param User $user
     * @return void
     */
    public function update($user)
    {
    }

    /**
     * @param string $userId
     * @return void
     */
    public function delete($userId)
    {
    }
}
