<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'unit_of_measurement','description'];

    public function rates()
{
    return $this->hasMany(Rate::class);
}
}
