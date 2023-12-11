<?php

abstract class Request
{
    public abstract function request(array $payload);
    public function run(array $payload)
    {
        return $this->request($payload);
    }
}
