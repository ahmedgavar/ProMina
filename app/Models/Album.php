<?php

namespace App\Models;

use App\Http\Traits\PhotosTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Album extends Model
{
    use HasFactory, PhotosTrait;
    protected $fillable = ['name'];
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
        static::updating(function ($model) {
            $model->user_id = Auth::id();
        });
    }
}
