<?php

interface IPeminjamanRepository extends Repository
{
    /**
     * @param string $userId
     * @return array
     */
    public function getByUser($userId);
}
