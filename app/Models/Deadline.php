<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $todo_id
 * @property DateTime $deadline
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Deadline extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_id',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function todo()
    {
        return $this->belongsTo(Todo::class, 'todo_id');
    }
}
