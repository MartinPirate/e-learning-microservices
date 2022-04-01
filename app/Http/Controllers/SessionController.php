<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Interfaces\SessionInterface;

class SessionController extends Controller
{
    protected $sessionInterface;

    public function __construct(SessionInterface $sessionInterface)
    {
        $this->sessionInterface = $sessionInterface;
    }

    /**
     * Get a list of sessions
     * @return mixed
     */
    public function index()
    {
        return $this->sessionInterface->getAllSessions();
    }

    /**
     * List of active Sessions
     * @return mixed
     */
    public function activeSessions()
    {
        return $this->sessionInterface->getActiveSessions();
    }

    /**
     * List of upcoming Sessions
     * @return mixed
     */
    public function upcomingSessions()
    {
        return $this->sessionInterface->getupComingSessions();
    }

    /**
     * List of cancelled Sessions
     * @return mixed
     */
    public function cancelledSessions()
    {
        return $this->sessionInterface->getCancelledSessions();
    }

    /**
     * Get Session by Id
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->sessionInterface->getSessionById($id);
    }

    /**
     * Add a session
     * @param AddSessionRequest $request
     * @return mixed
     */
    public function store(AddSessionRequest $request)
    {
        return $this->sessionInterface->addSession($request);
    }

    /**
     * Update a session
     * @param UpdateSessionRequest $request
     * @return mixed
     */
    public function update(UpdateSessionRequest $request)
    {
        return $this->sessionInterface->updateSession($request);
    }

    /**
     * Delete Session
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->sessionInterface->deleteSession($id);
    }
}

