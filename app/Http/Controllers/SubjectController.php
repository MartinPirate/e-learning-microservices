<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Interfaces\SubjectInterface;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    protected $subjectInterface;

    public function __construct(SubjectInterface $subjectInterface)
    {
        $this->subjectInterface = $subjectInterface;
    }


    /**
     * Get a list of Subjects
     * @return mixed
     */
    public function index()
    {

        return $this->subjectInterface->getSubjects();

    }

    /**
     * Get subject object
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->subjectInterface->getSubjectById($id);
    }

    /**
     * Update a subject
     * @param UpdateSubjectRequest $request
     * @return mixed
     */
    public function updateSubject(UpdateSubjectRequest $request)
    {
        return $this->subjectInterface->updateSubject($request);
    }

    /**
     * Delete subject
     * @param $id
     * @return mixed
     */
    public function deleteSubject($id)
    {

        return $this->subjectInterface->deleteSubject($id);

    }

    /**
     * Add a new Subject
     * @param AddSubjectRequest $request
     * @return mixed
     */
    public function addSubject(AddSubjectRequest $request)
    {
        return $this->subjectInterface->addSubject($request);
    }

    /**
     * Save a subject Array
     * @param AddSubjectRequest $request
     * @return mixed
     */
    public function addSubjects(AddSubjectRequest $request)
    {
        return $this->subjectInterface->addSubjects($request);
    }

    /**
     * Get subject's Students
     * @param $id
     * @return mixed
     */
    public function getSubjectStudents($id)
    {
        return $this->subjectInterface->getStudents($id);
    }
    /**
     * Get subject's Teachers
     * @param $id
     * @return mixed
     */
    public function getSubjectTeachers($id)
    {
        return $this->subjectInterface->getTeachers($id);
    }


}
