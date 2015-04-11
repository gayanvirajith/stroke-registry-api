<?php


namespace Acme\Transformers;


class EventOnsetTransformer extends Transformer{

    /**
     * Transform an item
     *
     * @param $item
     * @return mixed
     */
    public function transform($item)
    {
        return [
            'id'                        => $item->id,
            'episode_id'                => $item->episode_id,
            'onset_of_stroke_at'        => $item->onset_of_stroke_at,
            'onset_of_stroke_at'        => $item->onset_of_stroke_at,
            'admission_time'            => $item->admission_time,
            'onset_to_admission_time'   => $item->onset_to_admission_time,
            'modified_rankin_scale'     => $item->modified_rankin_scale,
            'patient_id'                => $item->patient_id,
            'symptoms'                  => array_map(function($i){
              return [
                  'id' => $i['id'],
                  'name' => $i['name']
              ];
            }, $item->symptoms->toArray())
        ];
    }
}