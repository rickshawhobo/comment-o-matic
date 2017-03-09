<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $guarded = ['id'];
    public $timestamps = false;

    public function taggable()
    {
        return $this->morphTo();
    }
}