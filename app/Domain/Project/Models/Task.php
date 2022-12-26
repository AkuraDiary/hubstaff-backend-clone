<?php

namespace App\Domain\Project\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return TaskFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'time_needed',
        'done_date',
        'assigner_id',
        'assignee_id',
        'project_id'
    ];

    public function assigner () {
        return $this->belongsTo(User::class, 'assigner_id', 'id');
    }

    public function assignee () {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function project () {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
