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
            'hospital'      => [
                'id'        => $user->hospital->id, 
                'name'      => $user->hospital->name
            ],
            'lastLoginAt'   => $user->updated_at->format('Y-m-d H:i:s')
        ];
    }
}