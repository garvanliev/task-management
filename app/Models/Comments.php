<?php

namespace App\Models;

use App\Events\CommentMade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['task_id','description','user_id'];

    public function task():belongsTo
    {
        return $this->belongsTo(Tasks::class);
    }

    public function user():belongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
