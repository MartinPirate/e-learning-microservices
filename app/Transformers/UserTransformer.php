<?php

namespace App\Transformers;

use App\Models\User;
use Exception;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'roles',
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'wallet'
    ];

    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user): array
    {

       $token =  $user->createToken('Auth Token')->accessToken;


        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone_number,
            'address' => $user->address,
            'access_token' => $token,
        ];
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function includeRoles(User $user): Collection
    {
        return $this->collection($user->roles, new RoleTransformer(), 'roles');

    }

    /**
     * @param User $user
     * @return Item
     */
    public function includeWallet(User $user): Item
    {

        return $this->item($user->wallet, new WalletTransformer(), 'wallet');
    }
}

