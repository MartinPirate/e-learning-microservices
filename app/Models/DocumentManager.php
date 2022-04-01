<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\DocumentManager
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $file_path
 * @property int $is_verified
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager newQuery()
 * @method static Builder|DocumentManager onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentManager whereUserId($value)
 * @method static Builder|DocumentManager withTrashed()
 * @method static Builder|DocumentManager withoutTrashed()
 * @mixin Eloquent
 */
class DocumentManager extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'bool', 'is_verified'];

    /**User who owns the doc
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
