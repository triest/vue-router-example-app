<?php

namespace App\Http\Resources;

use App\Models\Relations;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $profile=parent::toArray($request);

        return ['profile'=>$profile,
                'relations'=>Relations::all()];
    }
}
