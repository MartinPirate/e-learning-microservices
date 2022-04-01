<?php

namespace App\Transformers;

use App\Models\Session;
use League\Fractal\TransformerAbstract;

class SessionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        /*'teacher', 'student'*/
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param Session $session
     * @return array
     */
    public function transform(Session $session): array
    {
        return [
            'id' => $session->id,
            'title' => $session->title,
            'subject' => $session->subject(),
            'scheduled_date' => $session->schedule_date,
            'start_time' => $session->start_time,
            'end_time' => $session->end_time,
            'teacher' => $session->teacher,
            'students' => $session->students,
        ];
    }
}
