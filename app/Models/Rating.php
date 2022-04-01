<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Rating
 *
 * @property int $id
 * @property int $student_id
 * @property int $teacher_id
 * @property int $rate
 * @property string|null $additional_info
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Rating newModelQuery()
 * @method static Builder|Rating newQuery()
 * @method static Builder|Rating query()
 * @method static Builder|Rating whereAdditionalInfo($value)
 * @method static Builder|Rating whereCreatedAt($value)
 * @method static Builder|Rating whereDeletedAt($value)
 * @method static Builder|Rating whereId($value)
 * @method static Builder|Rating whereRate($value)
 * @method static Builder|Rating whereStudentId($value)
 * @method static Builder|Rating whereTeacherId($value)
 * @method static Builder|Rating whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Rating onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Rating withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Rating withoutTrashed()
 */
class Rating extends Model
{
    use HasFactory, SoftDeletes;
}
