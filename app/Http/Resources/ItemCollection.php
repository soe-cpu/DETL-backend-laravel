<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'items' => ItemResource::collection($this->collection),
            'pagination' => [
                "current_page" => $this->currentPage(),
                "first_page_url" => $this->getOptions()['path'] . '?' . $this->getOptions()['pageName'] . '=1',
                "last_page" => $this->lastPage(),
                "last_page_url" => $this->getOptions()['path'] . '?' . $this->getOptions()['pageName'] . '=' . $this->lastPage(),
                "next_page_url" => $this->nextPageUrl(),
                "path" => $this->getOptions()['path'],
                "per_page" => $this->perPage(),
                "prev_page_url" => $this->previousPageUrl(),
                "total" => $this->total(),
            ],
        ];
    }
}
