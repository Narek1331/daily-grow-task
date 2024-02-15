<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = ['name', 'text', 'type']; 
    
    /**
     * Define a many-to-many relationship with users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'newsletter_users');
    }
}
