<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'originalLink',
        'shortLink'
    ];

    public function getOriginalLink()
    {
        return $this->originalLink;
    }

    public function getShortLink()
    {
        return $this->shortLink;
    }
}
