<?php
/**
 * Created by PhpStorm.
 * User: gayanvirajith
 * Date: 4/12/15
 * Time: 11:59 PM
 */

namespace Acme\Transformers;


class RiskFactorTransformer extends Transformer{

    /**
     * Transform an item
     *
     * @param $item
     * @return mixed
     */
    public function transform($item)
    {
        return [
            'id'                                        => $item->id,
            'antiplatelet_drug_at_the_time_of_stroke'   => $item->antiplatelet_drug_at_the_time_of_stroke,
            'warfarin_at_the_time_of_stroke'            => $item->warfarin_at_the_time_of_stroke,
            'past_history_of_stroke'                    => $item->past_history_of_stroke,
            'hypertension'                              => $item->hypertension,
            'diabetes_mellitus'                         => $item->diabetes_mellitus,
            'ischaemic_heart_disease'                   => $item->ischaemic_heart_disease,
            'current_smoker'                            => $item->current_smoker,
            'unsafe_alcohol_intake'                     => $item->unsafe_alcohol_intake,
            'patient_id'                                => $item->patient_id,
            'otherHeartDisease'                         => array_map(function($i){
                return [
                    'id' => $i['id'],
                    'name' => $i['name']
                ];
            }, $item->otherHeartDiseases->toArray())
        ];
    }
}