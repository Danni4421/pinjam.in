<?php

interface IPeminjamanService extends Repository
{
    /**
     * @param string $user_id
     * @return array
     */
    public function getByUser($user_id);
}