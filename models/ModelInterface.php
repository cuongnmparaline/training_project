<?php
// interface Move
interface ModelInterface
{
    function get($condition);

    function add($data);

    function delete($id);

    function update($data, $id);

    function getById($id);

}