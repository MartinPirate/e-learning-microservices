<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property int $user_id
 * @property string $amount
 * @property string $withheld_amount
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Wallet newModelQuery()
 * @method static Builder|Wallet newQuery()
 * @method static Builder|Wallet query()
 * @method static Builder|Wallet whereAmount($value)
 * @method static Builder|Wallet whereCreatedAt($value)
 * @method static Builder|Wallet whereDeletedAt($value)
 * @method static Builder|Wallet whereId($value)
 * @method static Builder|Wallet whereUpdatedAt($value)
 * @method static Builder|Wallet whereUserId($value)
 * @method static Builder|Wallet whereWithheldAmount($value)
 * @mixin Eloquent
 * @property string|null $account_no
 * @method static Builder|Wallet whereAccountNo($value)
 * @method static updateOrCreate(array $array)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DocumentManager[] $docs
 * @property-read int|null $docs_count
 * @method static \Illuminate\Database\Query\Builder|Wallet onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Wallet withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Wallet withoutTrashed()
 */
class Wallet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'amount'];

    /**
     * @return BelongsTo
     * user wallet
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**User Docs and certs
     * @return HasMany
     */
    public function docs(): HasMany
    {
        return $this->hasMany(DocumentManager::class, 'user_id');
    }
}
