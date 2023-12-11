<?php

interface Repository
{
    /**
     * @param mixed $args
     * @return void
     */
    public function add($args);

    /**
     * @return mixed
     */
    public function get();

    /**
     * @param string | int $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param mixed $args
     * @return void
     */
    public function update($args);

    /**
     * @param mixed $args
     * @return void
     */
    public function delete($args);
}
