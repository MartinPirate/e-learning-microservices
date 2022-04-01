<?php

namespace App\Transformers;

use App\Models\Wallet;
use League\Fractal\TransformerAbstract;

class WalletTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @param Wallet $wallet
     * @return array
     */
    public function transform(Wallet $wallet): array
    {
        return [
            'id' => $wallet->id,
            'account_no' => $wallet->account_no,
            'balance' => $wallet->amount,
            'withheld_amount' => $wallet->withheld_amount,
        ];
    }
}
