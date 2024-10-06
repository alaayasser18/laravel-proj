<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'picture',
        'manager_id', 
    ];

    //  (many-to-one)
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
}
