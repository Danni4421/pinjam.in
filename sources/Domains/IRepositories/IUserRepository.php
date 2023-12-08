<?php

interface IUserRepository extends Repository
{
    /**
     * @param User $user
     * @param UserDetails $userDetails
     * @return void
     */
    public function addDetails($user, $userDetails);
}
