<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => new CategoryResource($this->category),
            'store' => new StoreResource($this->store),
            'name' => $this->name,
            'description' => $this->description,
            'translations' => $this->when(Controller::isAdmin(), $this->translations),
            'status' => (int)$this->status,
            'price' => $this->price,
            'vat_type' => (int)$this->vat_type,
            'vat_amount' => (float)($this->vat_amount * 100) . '%',
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
