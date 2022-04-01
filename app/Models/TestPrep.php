<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\TestPrep
 *
 * @property int $id
 * @property string $name
 * @property int $subject_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|TestPrep newModelQuery()
 * @method static Builder|TestPrep newQuery()
 * @method static Builder|TestPrep query()
 * @method static Builder|TestPrep whereCreatedAt($value)
 * @method static Builder|TestPrep whereDeletedAt($value)
 * @method static Builder|TestPrep whereId($value)
 * @method static Builder|TestPrep whereName($value)
 * @method static Builder|TestPrep whereSubjectId($value)
 * @method static Builder|TestPrep whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|TestPrep onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|TestPrep withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TestPrep withoutTrashed()
 */
class TestPrep extends Model
{
    use HasFactory,SoftDeletes;
}
