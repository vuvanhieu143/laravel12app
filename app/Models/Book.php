<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model {
    use HasFactory;
    protected $fillable = ['title', 'author', 'year', 'description', 'cover', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
