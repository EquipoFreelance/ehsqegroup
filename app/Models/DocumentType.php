<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = 'document_type';

    protected $fillable = [
        'id',
        'document_type_name',
        'active'
    ];

    protected $visible = [
        'id',
        'document_type_name',
        'name',
    ];

    public function person(){
        return $this->hasMany('App\Models\Persona', 'cod_doc_tip', 'id');
    }
}
