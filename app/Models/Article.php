<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'author_id',
        'slug',
        'catelogue_id'
    ];

    protected $casts = [
        'is_trending' => 'boolean',
        'is_editor' => 'boolean'
    ];

    public function tags()
    {
      return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }

    public function catelogue()
    {
      return $this->belongsTo(Catelogue::class);
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }
    public function editor()
    {
        return $this->belongsTo('App\Models\User', 'editor_id');
    }

}
