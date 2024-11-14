<?php
namespace App\Interfaces;



interface CRUDinterfaces{
    public function index();
    public function create();
    public function store();
    public function show(string $id);
    public function edit(string $id);
    public function update(string $id);
    public function delete(string $id);
}