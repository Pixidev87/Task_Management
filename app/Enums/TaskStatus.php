<?php

namespace App\Enums;

# A TaskStatus enum a Status állapotát jelöli, amely lehet Pending, In Progress vagy Done. Az enum tartalmaz egy label() metódust is, amely visszaadja a státusz olvasható címkéjét.
enum TaskStatus: string
{
    case Pending = 'pending';
    case In_progress = 'in_progress';
    case Done = 'done';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::In_progress => 'In Progress',
            self::Done => 'Done',
        };
    }
}
