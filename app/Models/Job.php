<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable  = ['company', 'title', 'location', 'email', 'website', 'tags', 'description'];

    public function scopeFilter($query, array $filters)
    {
        // ! filter by tags
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        };
        // ! filter by search
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        };
    }

    // ! Relationship with users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
