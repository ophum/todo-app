<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $todo_id
 * @property bool $is_done
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Done extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_id',
        'is_done',
    ];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
