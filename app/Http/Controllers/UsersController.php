<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfilePicUploadRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UploadDocRequest;
use App\Interfaces\UserInterface;
use App\Models\User;


class UsersController extends Controller
{


    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }


    /**
     * Get a list of users
     * @return mixed
     */
    public function getAllUsers()
    {
        return $this->userInterface->getAllUsers();
    }

    /**
     * Login User
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        return $this->userInterface->loginUser($request);

    }

    /**
     * Register User
     * @param RegisterRequest $request
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        return $this->userInterface->registerUser($request);

    }

    /**
     * Update User
     * @param User $user
     * @return mixed
     */
    public function profile(User $user)
    {
        return $this->userInterface->getUserById($user);
    }

    /**
     * @param UpdateProfileRequest $request
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        return $this->userInterface->updateUser($request);
    }


    /**
     * Change password
     * @param ChangePasswordRequest $request
     * @return mixed
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        return $this->userInterface->changePassword($request);
    }

    /**
     * Update password
     * @param ResetPasswordRequest $request
     * @return mixed
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->userInterface->resetPassword($request);
    }

    /**
     * Upload User profile pic
     * @param ProfilePicUploadRequest $request
     * @return mixed
     */
    public function uploadProfilePic(ProfilePicUploadRequest $request)
    {
        return $this->userInterface->uploadProfilePic($request);
    }

    /**
     * Upload User docs
     * @param UploadDocRequest $request
     * @return mixed
     */
    public function uploadDocs(UploadDocRequest $request)
    {
        return $this->userInterface->uploadDocs($request);
    }


    /**
     * Get a list of all Students
     * @return mixed
     */
    public function getStudents()
    {
        return $this->userInterface->getAllStudents();
    }


    /**
     * Get a list of all Teacher
     * @return mixed
     */
    public function getTeachers()
    {
        return $this->userInterface->getAllTeachers();
    }

    /**
     * Get a list of all Admins
     * @return mixed
     */
    public function getAdmins()
    {
        return $this->userInterface->getAllAdmins();
    }

    /**
     * Get a list of all Organizations
     * @return mixed
     */
    public function getOrganizations()
    {
        return $this->userInterface->getAllOrganizations();
    }


    /**
     * Get a list of all counsellors
     * @return mixed
     */
    public function getCounsellors()
    {
        return $this->userInterface->getAllCounsellors();
    }

    /**
     * Get a list of all Essay Writers
     * @return mixed
     */
    public function getEssayWriters()
    {
        return $this->userInterface->getAllEasyWriters();
    }


    /**
     * Get a list of all Gift Managers
     * @return mixed
     */
    public function getGiftManagers()
    {
        return $this->userInterface->getAllGiftManagers();
    }


    /**
     * Get a list of all Gift Aspiring Students
     * @return mixed
     */
    public function getAspiringStudents()
    {
        return $this->userInterface->getAllAspiringStudents();
    }


}
