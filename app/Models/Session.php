<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use function Symfony\Component\Translation\t;

/**
 * App\Models\Session
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $schedule_date
 * @property int $teacher_id
 * @property int $subject_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Session newModelQuery()
 * @method static Builder|Session newQuery()
 * @method static Builder|Session query()
 * @method static Builder|Session whereCreatedAt($value)
 * @method static Builder|Session whereDeletedAt($value)
 * @method static Builder|Session whereId($value)
 * @method static Builder|Session whereScheduleDate($value)
 * @method static Builder|Session whereSubjectId($value)
 * @method static Builder|Session whereTeacherId($value)
 * @method static Builder|Session whereTitle($value)
 * @method static Builder|Session whereType($value)
 * @method static Builder|Session whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Session onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Session withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Session withoutTrashed()
 * @property string $start_time
 * @property string $end_time
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $teacher
 * @method static Builder|Session whereEndTime($value)
 * @method static Builder|Session whereStartTime($value)
 * @property string $status
 * @method static Builder|Session whereStatus($value)
 */
class Session extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['title', 'teacher_id', 'schedule_date', 'subject_id', 'type', 'start_time', 'end_time'];

    /**
     * Session students
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'session_student', 'session_id', 'id');
    }

    /**
     * Teacher for the subject
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Session subject
     * @return BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);

    }
}
