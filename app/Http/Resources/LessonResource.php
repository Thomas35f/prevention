<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'grid_name' => $this->grid->name,
            'learner_lastname' => $this->learner->user->lastname,
            'learner_firstname' => $this->learner->user->firstname,
            'learner_subclient' => $this->learner->subclient->company->name,
            'vehicle_name' => optional($this->learner->vehicle)->name,
            'center_name' => $this->training->center->name,
            'center_address' => $this->training->center->address,
            'trainer_name' => optional($this->training->trainer->user)->firstname . ' ' . optional($this->training->trainer->user)->lastname,
            'criteria' => $this->grid->criteria->map(function ($criteria) {
                return [
                    'label' => $criteria->label,
                    'themes' => $criteria->themes->map(function ($theme) {
                        return [
                            'label' => $theme->label,
                        ];
                    })
                ];
            }),
        ];
    }
}
