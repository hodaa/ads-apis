<?php

namespace App\Http\Resources;

use App\Enums\TypeEnum;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type'=> TypeEnum::getName($this->type),
            'title'=> $this->title,
            'description'=> $this->description,
            'start_date'=> Carbon::parse($this->start_at)->toDateString(),
            'tags' => TagResource::collection($this->tags),
            'category' =>  $this->category->name,
        ];
    }
}
