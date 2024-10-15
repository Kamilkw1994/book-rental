<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'author' => $this->author,
            'year' => $this->year,
            'publisher' => $this->publisher,
            'isRented' => (bool)$this->is_rented,
            'client' => $this->client ? [
                'firstName' => $this->client->first_name,
                'lastName' => $this->client->last_name,
            ] : null,
        ];    
    }
}
