<?php

namespace App\Http\Resources;
use Illuminate\Support\Carbon;

use Illuminate\Http\Resources\Json\JsonResource;

class TemperatureResource extends JsonResource
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
            'id' => $this->id,
            'temperature_celsius' => $this->temperature_celsius,
            'temperature_fahrenheit' => $this->temperature_fahrenheit,
            'created_at' => Carbon::parse($this->created_at)->format('D, d F Y h:i A'),
        ];
    }
}
