<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Test
 *
 * @property int $id
 * @property string $name
 * @property int $subject_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Test newModelQuery()
 * @method static Builder|Test newQuery()
 * @method static Builder|Test query()
 * @method static Builder|Test whereCreatedAt($value)
 * @method static Builder|Test whereDeletedAt($value)
 * @method static Builder|Test whereId($value)
 * @method static Builder|Test whereName($value)
 * @method static Builder|Test whereSubjectId($value)
 * @method static Builder|Test whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Test onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Test withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Test withoutTrashed()
 */
class Test extends Model
{
    use HasFactory, SoftDeletes;
}
