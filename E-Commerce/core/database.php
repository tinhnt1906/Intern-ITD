<?php
abstract class database
{
    abstract public function get($limit = 10);
    abstract public function getId($id);
    abstract public function create($data);
    abstract public function update($id, $data);
    abstract public function delete($id);
}