<?php

abstract class BaseModel{

    abstract public function get();

    abstract public function add($data);

    abstract public function delete();

    abstract public function update();
}