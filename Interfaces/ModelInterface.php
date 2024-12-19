<?php

namespace Interfaces;

interface ModelInterface
{
    public function getAll();
    public function find($id);
    public function save(array $data);
    public function update($id, array $data);
    public function delete($id);
}
