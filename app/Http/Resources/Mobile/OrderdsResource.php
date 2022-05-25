<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->active == 0){
            $status =  'pending';
        }
        elseif($this->active == 1)
        {
            $status =  'approved';
        }
        else {
            $status = 'refused';
        }
        return [
                'id'=>$this->id,
                'service_name'=>$this->service['name_'.app()->getLocale()],
                'total_price'=>$this->total_price,
                'status'=> $status,
                'user_name'=>$this->user['name'],
                'phone'=>$this->user['phone'],
                'reservation_date'=>$this->reservation_date,
                'reservation_time'=>$this->reservation_time,
                'address'=>$this->address,
                'zone'=>$this->zone['name_'.app()->getLocale()]


        ];
    }
}
