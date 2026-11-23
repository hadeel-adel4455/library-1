<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Borrowing;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $isAvailable = !Borrowing::where('book_id', $this->id)
            ->where('is_returned', false)
            ->exists();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'author' => $this->author,
            'ISBN' => $this->ISBN,
            'category_id' => $this->category_id,
            'is_available' => $isAvailable,
        ];
    }
}
