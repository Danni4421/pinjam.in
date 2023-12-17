<?php

interface IPeminjamanRepository extends Repository
{
    /**
     * @param string $userId
     * @return array
     */
    public function getByUser($userId);

    /**
     * @param string $status
     * @return array
     */
    public function getPeminjamanByStatus($status);
}
