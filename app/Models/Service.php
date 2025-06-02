<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'category_id', 'fees'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}