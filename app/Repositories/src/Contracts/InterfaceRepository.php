<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 20/10/2016
 * Time: 13:02
 */

namespace App\Repositories\Contracts;


interface InterfaceRepository
{

    // Get All Register
    public function getAll();

    // Find Register by Id
    public function getById( $id );

    // Create Register
    public function create( array $attribute);

    // Update Register by Id
    public function update( $id, array $attribute);

    // Delete Register by Id
    public function delete( $id );


}