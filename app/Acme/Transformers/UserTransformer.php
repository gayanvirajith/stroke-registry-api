<?php

namespace Acme\Transformers;

/**
 * Class UserTransformer
 *
 * @package Acme\Transformers
 */

class UserTransformer extends Transformer {

    /**
     * Transform a user
     *
     * @param $user
     * @return mixed
     */
    public function transform($user)
    {
        return [
            'username'      => $user->username,
            'hospital_id'   => (int) $user->hospital_id,
            'lastLoginAt'   => $user->updated_at
        ];
    }
}