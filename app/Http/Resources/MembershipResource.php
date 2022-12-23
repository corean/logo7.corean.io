<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MembershipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'no'             => $this->no,
            'id'             => $this->id,
            'grade'          => $this->member->membership_grade(),
            'confirm'        => $this->confirm,
            'charge_name'    => $this->chargename,
            'mobile'         => $this->mobile,
            'confirmed_at'   => $this->confirmed_at,
            'created_at'     => $this->created_at,
            'diffForHumans'  => $this->created_at->diffForHumans(),
            'completedCount' => $this->completedCount,
        ];
    }
}
