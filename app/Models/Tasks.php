<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title','description','duedate','task_status_id'];

    public function status():hasOne
    {
        return $this->hasOne(TaskStatus::class,'id','task_status_id');
    }

    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments():hasMany
    {
        return $this->hasMany(Comments::class);
    }
}
