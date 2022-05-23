<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'author',
        'title',  
        'content',
        'url',
        'category',
        'image'
    ];

    protected $guarded = [
        'author',
    ];

    protected $casts = [
        'category' => 'array',
    ];

    // public function getCreatedAtAttribute()
    // {
    //     return Carbon::createFromFormat('Y-m-d H:s:i', $this->attributes['created_at'])->format('d/m/Y');
    // }
    
    public function setCreatedAtAttribute($value) 
    {
        $this->attributes['created_at'] = Carbon::createFromFormat('Y-m-d H:s:i', $value)->toDateString();
    }
}
