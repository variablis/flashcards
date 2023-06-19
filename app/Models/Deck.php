<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deck extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'progress', 'count'];
    

    public function flashcards(){
        return $this->hasMany(Flashcard::class);
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}