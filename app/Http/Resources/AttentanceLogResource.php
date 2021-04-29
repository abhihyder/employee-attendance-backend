<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttentanceLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->employee->user->name,
            'email' => $this->employee->user->email,
            'phone' => $this->employee->user->phone,
            'role' => $this->employee->role->name,
            'branch' => $this->branch->branch_name,
            'attendance_type' => $this->attendance_type,
            'attendance_date' => $this->attendance_date,
            'attendance_time' => $this->attendance_time,
        ];
    }
}
