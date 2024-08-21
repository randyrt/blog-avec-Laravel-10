<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /** Authorize creaction of entities
     * activation of masse assignement
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];

    /* inverse de $fillable, les champs qu'on veut garder 
    protected $guarded = ['id', 'created_at', 'updated_at'];
    */

    /**
     * Relation who load permanantely with comment
     * @var array
     */
    protected $with = ['user'];

    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
