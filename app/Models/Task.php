<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    # kitölthetővé teszi a mezőket
    protected $fillable = [
        "title",
        "description",
        "status",
        "priority",
        "due_date"
    ];

    # a mezőket castolja a megfelelő típusra
    protected function casts(): array
    {
        return [
            'status' => 'string',
            'priority' => 'string',
            'due_date' => 'datetime',
        ];
    }

    # a Task modell kapcsolata a User modellel, egy Task egy User-hez tartozik
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
