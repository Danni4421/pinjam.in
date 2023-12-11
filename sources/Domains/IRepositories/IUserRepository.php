<?php

interface IUserRepository extends Repository
{
    /**
     * @param User $user
     * @param UserDetails $userDetails
     * @return void
     */
    public function addDetails($user, $userDetails);

    /**
     * @param string $email
     * @return bool
     */
    public function verifyAvailableEmail($email);

    /**
     * @param int $userId
     * @return bool
     */
    public function verifyUserDetailsIsExists($userId);
}
