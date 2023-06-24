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

    public function scopeFilter($query, array $filters){
        // dd($filters);
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%'.request('search').'%')
            ->orWhere('description', 'like', '%'.request('search').'%');
            // ->orWhereHas('topic', function ($query) use ($filters) {
            //     $query->where('title', 'like', '%' . $filters['search'] . '%');
            // });
            
        }
    }

    public function scopeMyTest($query, $ids){
        return $query->where('id', $ids);
    }
    
}