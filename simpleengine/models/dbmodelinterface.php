<?php


namespace simpleengine\models;


interface DbModelInterface
{
    public function find($id);
    public function save();
}
