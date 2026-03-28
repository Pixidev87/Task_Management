<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    # Ez a gyűjtemény lehetővé teszi, hogy több Task erőforrást egyszerre visszaadjunk egy API válaszban.
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
