<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'link', 'content', 'cover_image', 'video'];


    /**
     * Get the Type that owns the Project
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo

     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
