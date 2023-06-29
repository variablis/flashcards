<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'is_public', 'category_id'];

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

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%'.request('search').'%')
            ->orWhere('description', 'like', '%'.request('search').'%');
        }
    }

    // public function scopeFilterByUser($query, User $user){
    //     $query->where('user_id', $user->id);
    // }
    

    // public function scopeFilterByTitle($query, $title){
    //     return $query->where('title', 'like', '%' . $title . '%');
    // }


    // public function scopePublicTopics($query, $ids){
    //     return $query->where('is_public', true);
    // }

}
