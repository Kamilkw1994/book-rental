<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'isRented' => (bool)$this->is_rented,
            'client' => $this->client ? [
                'firstName' => $this->client->first_name,
                'lastName' => $this->client->last_name,
            ] : null,
        ];        
    }
}
