<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['type','title','category_id','advertiser_id','description','start_date'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function advertiser()
    {
        return $this->belongsTo(User::class);
    }
}
