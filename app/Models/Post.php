<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;


    /** Authorize creaction of entities
     * Summary of fillable
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    /** documentation laravel eager loading
     * Relation who want to load permanantely with the relation with category
     * @var array
     */
    protected $with = ['category', 'tags'];

    /** 
     * Summary of getRouteKeyname
     * @return string 
     */
    public function getRouteKeyname(): string
    {
        return 'slug';
    }

    public static function scopeFilters(Builder $query, array $filters): void
    {
        if (isset($filters['search'])) {
            $query->where(
                fn(Builder $query) => $query
                    ->where('title', 'LIKE', '%' . $filters['search'] . '%')
                    ->orWhere('content', 'LIKE', '%' . $filters['search'] . '%')
            );

        }

        if (isset($filters['category'])) {
            $query->where(
                'category_id',
                $filters['category']->id ?? $filters['category']
            );
        }

        if (isset($filters['tag'])) {
            $query->whereRelation('tags', 'tags.id', $filters['tag']->id);
        }

    }


    /**
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Summary of tags
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Summary of comments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /** maehod of create or edit, AdminController
     * Summary of exists
     * @return bool
     */
    public function exists(): bool
    {
        return (bool) $this->id;
    }
}

