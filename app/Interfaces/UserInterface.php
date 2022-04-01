<?php

namespace App\Interfaces;

use App\Http\Requests\AddSubjectRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfilePicUploadRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RemoveSubjectRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UploadDocRequest;
use App\Models\Subject;
use App\Models\User;
use Request;

interface UserInterface
{


    public function registerUser(RegisterRequest $request);

    public function loginUser(LoginRequest $request);

    public function getUserById(User $user);

    public function updateUser(UpdateProfileRequest $request);

    public function changePassword(ChangePasswordRequest $request);

    public function resetPassword(ResetPasswordRequest $request);

    public function uploadProfilePic(ProfilePicUploadRequest $request);

    public function uploadDocs(UploadDocRequest $request);

    public function addSubjects(AddSubjectRequest $request);

    public function getSubjects(Request $request);

    public function removeSubject(RemoveSubjectRequest $subject);

    public function deleteUser(DeleteUserRequest $request);


    public function getAllStudents();
    public function getAllTeachers();
    public function getAllAdmins();
    public function getAllOrganizations();
    public function getAllGiftManagers();
    public function getAllEasyWriters();
    public function getAllCounsellors();
    public function getAllAspiringStudents();

    public function getAllUsers();

}
