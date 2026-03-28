<?php

namespace App\Enums;

# A TaskPriority enum a Task prioritását jelöli, amely lehet Low, Medium vagy High. Csak a prioritás értékét tárolja string formában.
enum TaskPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
}
