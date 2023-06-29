<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function topics(){
        return $this->hasMany(Topic::class);
    }

    public function publicTopics(){
        return $this->hasMany(Topic::class)->where('is_public', true);
    }

    public function decks(){
        return $this->hasManyThrough(Deck::class, Topic::class);
    }
}
