<?php

namespace App\Repositories;

use App\Http\Requests\AddSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Interfaces\SessionInterface;
use App\Models\Session;
use App\Traits\ResponseAPI;
use App\Transformers\SessionTransformer;
use Illuminate\Http\JsonResponse;

class SessionRepository implements SessionInterface
{

    use ResponseAPI;

    /**
     * List af all Sessions
     * @return JsonResponse
     */
    public function getAllSessions(): JsonResponse
    {
        $sessions = Session::all();

        $sessionsCollection = fractal($sessions, new SessionTransformer());

        return $this->success('List of sessions', $sessionsCollection);

    }

    /**
     * list of Active Sessions
     * @return JsonResponse
     */
    public function getActiveSessions(): JsonResponse
    {
        $activeSessions = Session::whereStatus('active')->get();
        $activeSessionCollection = fractal($activeSessions, new SessionTransformer());

        return $this->success('List of Active sessions', $activeSessionCollection);

    }

    /**
     * Get A list of upcoming Sessions
     * @return JsonResponse
     */
    public function getupComingSessions(): JsonResponse
    {
        $upcomingSessions = Session::whereStatus('upcoming')->get();
        $upcomingSessionCollection = fractal($upcomingSessions, new SessionTransformer());

        return $this->success('List of Upcoming sessions', $upcomingSessionCollection);
    }

    /**
     *Get A list of Cancelled Sessions
     * @return JsonResponse
     */
    public function getCancelledSessions(): JsonResponse
    {
        $cancelledSessions = Session::whereStatus('cancelled')->get();
        $cancelledSessionCollection = fractal($cancelledSessions, new SessionTransformer());

        return $this->success('List of Cancelled sessions', $cancelledSessionCollection);
    }

    /**
     * Get Session
     * @param $id
     * @return JsonResponse
     */
    public function getSessionById($id): JsonResponse
    {
        $session = Session::whereId($id)->first();
        if ($session) {
            return $this->success('Session Object', $session);
        }

        return $this->error("Session not found in the database", 404);
    }

    /**
     * Store session
     * @param AddSessionRequest $request
     * @return JsonResponse
     */
    public function addSession(AddSessionRequest $request): JsonResponse
    {
        $session = new Session();
        $session->title = $request->title;
        $session->schedule_date = $request->schedule_date;
        $session->start_time = $request->start_time;
        $session->end_time = $request->end_time;
        $session->subject_id = $request->subject_id;
        $session->teacher_id = $request->teacher_id;
        $session->status = "upcoming";
        $session->save();

        return $this->success('Session Added Successfully', $session);

    }

    /**
     * Update Session
     * @param UpdateSessionRequest $request
     * @return JsonResponse
     */
    public function updateSession(UpdateSessionRequest $request): JsonResponse
    {

        $session = Session::whereId($request->session_id)->first();

        $data = [
            'title' => $request->title,
            'schedule_date' => $request->schedule_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
        ];
        if ($session) {
            $session->update($data);

            return $this->success('Session Updated Successfully', $session);
        }
        return $this->error("Session not found in the database", 404);

    }

    /**
     * Delete a session
     * @param $id
     * @return JsonResponse
     */
    public function deleteSession($id): JsonResponse
    {
        $session = Session::whereId($id)->first();
        if ($session) {
            $session->delete();
            return $this->success('Session deleted Successfully', $session);
        }

        return $this->error("Session not found in the database", 404);
    }


    public function getStudents()
    {
        // TODO: Implement getStudents() method.
    }

    public function getTeacher()
    {
        // TODO: Implement getTeacher() method.
    }
}
