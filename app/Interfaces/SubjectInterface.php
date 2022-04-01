<?php

namespace App\Interfaces;

use App\Http\Requests\AddSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Request;

interface SubjectInterface
{

    public function getSubjects();

    public function getSubjectById($id);

    public function updateSubject(UpdateSubjectRequest $request);


    public function addSubject(AddSubjectRequest $request);

    public function addSubjects(AddSubjectRequest $request);

    public function deleteSubject($id);

    public function getTeachers($id);

    public function getStudents($id);

}
