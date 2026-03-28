<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{

    # A toArray metódus a TaskResource osztályban meghatározza, hogyan kell átalakítani a Task modellt egy tömbbé, amely JSON formátumban lesz visszaadva a kliensnek.
    # Ez a metódus biztosítja, hogy csak a szükséges mezők kerüljenek visszaadásra, és lehetővé teszi a dátumformátum testreszabását.

    public function toArray(Request $request): array
    {
       return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status->value,
            'priority' => $this->priority->value,
            'due_date' => $this->due_date->format('Y-m-d H:i'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }


}
