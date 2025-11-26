<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_types';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'user_type_id', 'id');
    }
}
