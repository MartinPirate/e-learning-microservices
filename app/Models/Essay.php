<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Essay
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Essay newModelQuery()
 * @method static Builder|Essay newQuery()
 * @method static Builder|Essay query()
 * @method static Builder|Essay whereCreatedAt($value)
 * @method static Builder|Essay whereDeletedAt($value)
 * @method static Builder|Essay whereId($value)
 * @method static Builder|Essay whereTitle($value)
 * @method static Builder|Essay whereType($value)
 * @method static Builder|Essay whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Essay onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Essay withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Essay withoutTrashed()
 */
class Essay extends Model
{
    use HasFactory, SoftDeletes;
}
