<?php

namespace Acme\Transformers;


class PatientDirectoryTransformer extends Transformer {
   
 /**
   * Transform an item
   *
   * @param $item
   * @return mixed
   */
  public function transform($item)
  {
      return [
          'id'                    => $item['id'],
          'name'                  => $item['name'],
          'nic'                   => $item['nic'],
          'dob'                   => $item['dob'],
          'sex'                   => $item['sex'],
          'health_care_number'    => $item['health_care_number'],
          'hospital_id'           => $item['hospital_id'],
      ];
  }

  /**
   * Transform a collection of items
   *
   * @param array $items
   * @return array
   */
  public function transformCollection(array $items) {
      return array_map([$this, 'transform'], $items);
  }
}