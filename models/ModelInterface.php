<?php
// interface Move
interface ModelInterface
{
    function get($fields, $condition);

    function add($data);

    function delete($id);

    function update($data, $id);

    function getById($fields, $id);

}