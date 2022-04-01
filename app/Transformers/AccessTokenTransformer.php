<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AccessTokenTransformer extends TransformerAbstract
{


    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($accessToken): array
    {
        return [
            'token' => $accessToken
        ];
    }
}
