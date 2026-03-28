<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;


class Task extends Model
{
    protected $fillable = [
        "title",
        "description",
        "status",
        "priority",
        "dueDate"
    ];

    # a mezőket castolja a megfelelő típusra
    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class,
            'priority' => TaskPriority::class,
            'dueDate' => 'datetime',
        ];
    }

    # a Task modell kapcsolata a User modellel, egy Task egy User-hez tartozik
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    # visszaadja a Task-okat a státusz alapján szűrve, ha a státusz meg van adva, egyébként visszaadja az összes Task-ot
    public function scopeFilterByStatus(Builder $query, ?string $status): Builder
    {
        # $query tartalmazza a lekérdezést, $status pedig a szűrési feltétel, ha meg van adva. Ha $status nem null, akkor a lekérdezéshez hozzáadunk egy where feltételt, amely csak azokat a Task-okat adja vissza, amelyeknek a státusza megegyezik a megadott $status értékkel.
        return $query->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        });
    }

    # visszaadja a Task-okat a prioritás alapján szűrve, ha a prioritás meg van adva, egyébként visszaadja az összes Task-ot
    public function scopeFilterByPriority(Builder $query, ?string $priority): Builder
    {
        return $query->when($priority, function ($query) use ($priority) {
            $query->where('priority', $priority);
        });
    }


    # visszaadja a Task-okat a határidő alapján szűrve, ha a határidő meg van adva, egyébként visszaadja az összes Task-ot
    public function scopeFilterByDueDate(Builder $query, ?string $dueDate): Builder
    {
        return $query->when($dueDate, function ($query) use ($dueDate) {
            $query->where('dueDate', $dueDate);
        });
    }
}
