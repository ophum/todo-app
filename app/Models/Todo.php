<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $parent_todo_id
 * @property string $title
 * @property string $content
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_todo_id',
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentTodo()
    {
        return $this->belongsTo(self::class, 'parent_todo_id');
    }

    public function subTodos()
    {
        return $this->hasMany(self::class, 'parent_todo_id', 'id');
    }

    public function deadlines()
    {
        return $this->hasMany(Deadline::class);
    }

    public function dones()
    {
        return $this->hasMany(Done::class);
    }
}
