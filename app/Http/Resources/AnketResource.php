<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (isset($this->relation->name)) {
            $relation_name = $this->relation->name;
        } else {
            $relation_name = null;
        }
        return [
                'name' => $this->name,
                'desccription' => $this->description,
                'sex_id' => $this->sex_id,
                'unique_id' => $this->unique_id,
                'photo_url' => $this->photo_url,
                'relation_id' => $this->relation_id,
                'relation' => $relation_name,
                'targets'=>$this->target
        ];
    }
}
