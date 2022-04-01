<?php

namespace App\Repositories;

use App\Http\Requests\AddSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Interfaces\SubjectInterface;
use App\Models\Subject;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;
use Request;

class SubjectRepository implements SubjectInterface
{

    use ResponseAPI;

    /**
     * Get a list of Subjects
     * @return JsonResponse
     */
    public function getSubjects(): JsonResponse
    {
        $subjects = Subject::all();


        return $this->success('List of subjects', $subjects);

    }

    /**
     * Get Subject by ID
     * @param $id
     * @return JsonResponse
     */
    public function getSubjectById($id): JsonResponse
    {
        $subject = Subject::whereId($id)->first();
        return $this->success('Subject Object', $subject);

    }

    /**
     * Update subject name
     * @param UpdateSubjectRequest $request
     * @return JsonResponse
     */
    public function updateSubject(UpdateSubjectRequest $request): JsonResponse
    {
        $subject = Subject::whereId($request->subject_id)->first();

        $subject->name = $request->subject_name;
        $subject->update();

        return $this->success('subject Updated Successfully', $subject);


    }

    /**
     * Delete a subject
     * @param $id
     * @return JsonResponse
     */
    public function deleteSubject($id): JsonResponse
    {
        $subject = Subject::whereId($id)->first();
        if ($subject) {
            $subject->delete();
            return $this->success('Subject Deleted Successfully', $subject);
        }

        return $this->error('Subject not found in the database', 404);

    }

    /**
     * Add a new Subject
     * @param AddSubjectRequest $request
     * @return JsonResponse
     */
    public function addSubject(AddSubjectRequest $request): JsonResponse
    {
        $subject_name = $request->name;

        $subject = handleSaveSubject($subject_name);

        return $this->success('Subject added successfully', $subject);

    }

    /**
     * Add an Array of Subjects
     * @param Request $request
     * @return JsonResponse
     */
    public function addSubjects(AddSubjectRequest $request): JsonResponse
    {

        $subjects = $request->subjects;
        foreach ($subjects as $key => $value) {
            $subject = Subject::create([
                'name' => $request->input('name')[$key],
                'description' => "no description on this one",
            ]);
        }
        return $this->success('Subjects added successfully', $subjects);
    }

    /**
     * Get students per subject
     * @param $id
     * @return JsonResponse
     */
    public function getStudents($id): JsonResponse
    {
        $subject = Subject::whereId($id)->first();
        $students = $subject->users;
        return $this->success('List of students in a subject', $students);
    }

    /**
     * Get Teachers per subject
     * @param $id
     * @return JsonResponse
     */
    public function getTeachers($id): JsonResponse
    {
        $subject = Subject::whereId($id)->first();
        $teachers = $subject->users;
        return $this->success('List of teachers in a subject', $teachers);
    }

}
