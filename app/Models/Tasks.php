<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

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

    public function scopeFilterByStatus($query, $status)
    {
        return $query->where('task_status_id', $status);
    }

    public function scopeFilterByDueDate($query, $duedate)
    {
        $dueDate = Carbon::parse($duedate);
        return $query->whereDate('duedate', '<', $dueDate);
    }
}
