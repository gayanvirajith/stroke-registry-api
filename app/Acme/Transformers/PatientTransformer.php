<?php


namespace Acme\Transformers;


class PatientTransformer extends Transformer {

    /**
     * Transform an item
     *
     * @param $item
     * @return mixed
     */
    public function transform($item)
    {
        return [
            'id'                    => $item->id,
            'name'                  => $item->name,
            'nic'                   => $item->nic,
            'address_1'             => $item->address_1,
            'contact_no_1'          => $item->contact_no_1,
            'contact_no_2'          => $item->contact_no_2,
            'contact_no_2'          => $item->contact_no_2,
            'guardian_name'         => $item->guardian_name,
            'guardian_contact_no_1' => $item->guardian_contact_no_1,
            'guardian_contact_no_1' => $item->guardian_contact_no_1,
            'guardian_contact_no_2' => $item->guardian_contact_no_2,
            'dob'                   => $item->dob,
            'sex'                   => $item->sex,
            'age'                   => $item->age,
            'health_care_number'    => $item->health_care_number,
            'province'              => $item->province,
            'hospital_id'           => $item->hospital_id,
            'admitted_to'           => $item->admitted_to,
            'hospital'              => [
                'id' => $item->hospital->id, 
                'name' => $item->hospital->name
            ],
            'createdAt'             => $item->created_at->format('Y-m-d H:i:s'),
            'updatedAt'             => $item->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}