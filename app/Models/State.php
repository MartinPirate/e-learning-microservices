<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\State
 *
 * @property int $id
 * @property string $state_name
 * @property int $country_id
 * @property string $slug
 * @property int $state_code
 * @property int $status
 * @property int $is_default
 * @property int $show_home
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Query\Builder|State onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereShowHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereStateCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereStateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|State withTrashed()
 * @method static \Illuminate\Database\Query\Builder|State withoutTrashed()
 * @mixin \Eloquent
 */
class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['state_name', 'country_id', 'slug', 'state_code', 'status', 'show_home', 'created_at', 'updated_at'];

    /**
     *  User Country
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
