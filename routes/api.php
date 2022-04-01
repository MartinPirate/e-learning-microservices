<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

//auth
Route::post('login', [UsersController::class, 'login'])->name('auth.login');
Route::post('register', [UsersController::class, 'register'])->name('auth.register');

//profile
Route::middleware('auth:api')->group(function () {
    //todo extract these to prefix
    Route::get('profile/{user}', [UsersController::class, 'profile'])->name('user.profile');
    Route::post('profile/update', [UsersController::class, 'update'])->name('profile.update');
    Route::post('password/reset', [UsersController::class, 'resetPassword'])->name('password.reset');
    Route::post('password/change', [UsersController::class, 'changePassword'])->name('password.change');
    Route::post('profile/upload', [UsersController::class, 'uploadProfilePic'])->name('profile.upload');
    Route::post('documents/upload', [UsersController::class, 'uploadDocs'])->name('profile.upload');

    //get all users
    //todo add middleware to be admin Only
    Route::get('users', [UsersController::class, 'getAllUsers'])->name('users-all-get');
    Route::get('students', [UsersController::class, 'getStudents'])->name('students-get');
    Route::get('teachers', [UsersController::class, 'getTeachers'])->name('teacher-get');
    Route::get('admins', [UsersController::class, 'getAdmins'])->name('admins-get');
    Route::get('gift-managers', [UsersController::class, 'getGiftManagers'])->name('get-gift-managers-get');
    Route::get('organizations', [UsersController::class, 'getOrganizations'])->name('organizations-get');
    Route::get('aspiring-students', [UsersController::class, 'getAspiringStudents'])->name('aspiring-students-get');
    Route::get('essay-writers', [UsersController::class, 'getEssayWriters'])->name('essay-writers-get');
    Route::get('counsellors', [UsersController::class, 'getCounsellors'])->name('counsellors-get');

    Route::get('subjects', [SubjectController::class, 'index'])->name('subjects-get');
    Route::get('subject/{subject}', [SubjectController::class, 'show'])->name('subject-get');
    Route::get('subject/students/{subject}', [SubjectController::class, 'getSubjectStudents'])->name('subject.students-get');
    Route::get('subject/teachers/{subject}', [SubjectController::class, 'getSubjectTeachers'])->name('subject.teachers-get');
    Route::post('subject', [SubjectController::class, 'updateSubject'])->name('subject-update');
    Route::post('subjects', [SubjectController::class, 'addSubject'])->name('subject-add');
    Route::post('subjects/batch', [SubjectController::class, 'addSubjects'])->name('subjects-add');
    Route::post('delete-subject/{subject}', [SubjectController::class, 'deleteSubject'])->name('subject-delete');

    Route::get('sessions', [SessionController::class, 'index'])->name('sessions');
    Route::get('sessions/active', [SessionController::class, 'activeSessions'])->name('session-active');
    Route::get('sessions/upcoming', [SessionController::class, 'upcomingSessions'])->name('sessions-upcoming');
    Route::get('sessions/cancelled', [SessionController::class, 'cancelledSessions'])->name('sessions-cancelled');
    Route::get('sessions/{session}', [SessionController::class, 'show'])->name('session.show');

});
