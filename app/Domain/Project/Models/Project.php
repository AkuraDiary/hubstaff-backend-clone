<?php

namespace App\Domain\Project\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ProjectFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'timespan',
        'organization_id'
    ];

    public function organization () {
        return $this->belongsTo(Organization::class);
    }

    public function tasks () {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }
}
