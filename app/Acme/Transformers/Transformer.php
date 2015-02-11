<?php

namespace Acme\Transformers;

/**
 * Class Transformer
 *
 * @package Acme\Transformers
 */

abstract class Transformer {

    /**
     * Transform an item
     *
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);


    /**
     * Transform a collection of items
     *
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items) {
        return array_map([$this, 'transform'], $items->toArray());
    }
}