<?php

namespace App\Contracts;

interface CrudInterface {

    function store(array $data);
    function update($id,array $data);
    function find($id);
    function destroy($id);
    function all();

}
