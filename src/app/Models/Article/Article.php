<?php

namespace App\Models\Article;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_body',
        'body',
        'user_id',
    ];

    public function user() :HasOne
    {
        return $this->hasOne(User::class);
    }
}
