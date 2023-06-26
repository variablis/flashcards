<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'is_public'];


    public function decks(){
        return $this->hasMany(Deck::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function flashcards(){
        return $this->hasManyThrough(Flashcard::class, Deck::class);
    }

    // public function scopeFilterByTitle($query, $title){
    //     return $query->where('title', 'like', '%' . $title . '%');
    // }

    
    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%'.request('search').'%');
        }
    }

    // public function scopePublicTopics($query, $ids){
    //     return $query->where('is_public', true);
    // }

}
