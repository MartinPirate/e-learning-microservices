<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Grade
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Grade newModelQuery()
 * @method static Builder|Grade newQuery()
 * @method static Builder|Grade query()
 * @method static Builder|Grade whereCreatedAt($value)
 * @method static Builder|Grade whereDeletedAt($value)
 * @method static Builder|Grade whereId($value)
 * @method static Builder|Grade whereName($value)
 * @method static Builder|Grade whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Grade onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Grade withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Grade withoutTrashed()
 * @property-read \App\Models\User|null $student
 */
class Grade extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'grade_id');
    }
}
