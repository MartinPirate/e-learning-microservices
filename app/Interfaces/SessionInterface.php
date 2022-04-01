<?php

namespace App\Interfaces;

use App\Http\Requests\AddSessionRequest;
use App\Http\Requests\UpdateSessionRequest;

interface SessionInterface
{

    public function getAllSessions();

    public function getActiveSessions();

    public function getupComingSessions();

    public function getCancelledSessions();

    public function getSessionById($id);

    public function addSession(AddSessionRequest $request);

    public function updateSession(UpdateSessionRequest $request);

    public function deleteSession($id);

    public function getStudents();

    public function getTeacher();

}
