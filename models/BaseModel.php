<?php

abstract class BaseModel{

    abstract public function get($condition);

    abstract public function add($data);

    abstract public function delete($id);

    abstract public function update($data);
}