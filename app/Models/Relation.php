<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    protected $table = "relations";

    protected $fillable = [
        'code_occupation',
        'code_occupation_relation'
    ];

<<<<<<< HEAD
    public function occupation(){
        return $this->belongsTo(Occupation::class, 'code_occupation');
=======
    public function code_occupation_relation(){
        return $this->belongsTo(Occupation::class, 'code_occupation_relation');
>>>>>>> origin/main
    }
}
