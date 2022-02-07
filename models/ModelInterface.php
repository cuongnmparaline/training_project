<?php
// interface Move
interface ModelInterface
{
    public function get($fields, $condition);

    public function create($data);

    public function delete($id);

    public function update($data, $id);

    public function getById($fields, $id);

}