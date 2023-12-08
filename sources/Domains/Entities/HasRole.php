<?php

interface HasRole
{
    /**
     * @return string
     */
    public function getRole();

    /**
     * @return void
     */
    public function verifyRoleGoesOn();
}
