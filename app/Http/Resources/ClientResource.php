<?php

namespace App\Http\Resources;

use App\Http\Resources\SimplyBooksResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'books' => SimplyBooksResource::collection($this->whenLoaded('books')),
        ];       
    }
}
