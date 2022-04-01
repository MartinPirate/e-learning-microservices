<?php

namespace App\Repositories;

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
use App\Interfaces\UserInterface;
use App\Jobs\GenerateAccountNoJob;
use App\Models\DocumentManager;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\HighHouryRate;
use App\Notifications\HighHouryRateNotification;
use App\Notifications\WelcomeNotification;
use App\Traits\ResponseAPI;
use App\Transformers\DocumentTransformer;
use App\Transformers\StudentTransformer;
use App\Transformers\TeacherTransformer;
use App\Transformers\UsersTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Request;

class UserRepository implements UserInterface
{

    use ResponseAPI;


    /**
     * Login a User
     * @param LoginRequest $request
     * @return JsonResponse
     */

    public function loginUser(LoginRequest $request): JsonResponse
    {

        try {
            $data = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (Auth::attempt($data)) {
                $user = $request->user();

                $response = transformUser($user);

                return $this->success('User LoggedIn Successfully', $response);
            }
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
        return $this->error('Invalid email and password combination', 400);
    }


    /**
     * Register a  new User
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function registerUser(RegisterRequest $request): JsonResponse
    {

        $role = Role::whereName($request->role)->first();

        Log::info($role->name);

        $phone = $request->phone_number ?? null;
        $address = $request->address ?? null;
        $date_of_birth = $request->date_of_birth ?? null;
        $grade = $request->grade ?? null;
        $country = $request->state ?? null;
        $city = $request->state ?? null;
        $state = $request->state ?? null;

        //additional rules
        $rules = additionalRules($role->name);
        $messages = additionalRulesMessages();
        //validate the additional roles

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()->first(),
            ]);
        }


        $data = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "phone_number" => $phone,
            "address" => $address,
            "grade" => $grade,
            "country_id" => $country,
            "state_id" => $state,
            "city_id" => $city,
            "date_of_birth" => $date_of_birth,
            "password" => bcrypt($request->password)
        ];


        $user = User::create($data);

        $user->attachRole($role);
        if ($role->name === Role::TEACHER) {
            $wallet = Wallet::updateOrCreate(['user_id' => $user->id]);
            dispatch(new GenerateAccountNoJob($wallet));
            /* if ($user->hourly_rate > 14.00)
             {
                 //todo Send High Rate email
                // $user->notify(new HighHouryRateNotification());
             }*/
        }
        //todo Send welcome email
        // $user->notify(new WelcomeNotification());

        handleManyToManySubjectsRelationship($user, $request->subject);

        $response = transformUser($user);

        return $this->success('User Registered Successfully', $response);

    }


    /**
     * Get user by id
     * @param User $user
     * @return JsonResponse
     */
    public function getUserById(User $user): JsonResponse
    {
        $response = transformUser($user);

        return $this->success('user profile', $response);

    }


    /**
     * Update User profile
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     */
    public function updateUser(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();

        $user->update($request->all());

        $response = transformUser($user);

        return $this->success('user profile Updated Successfully', $response);

    }

    /**
     * Update password
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $request->user();
        $for_real = Auth::guard('web')->attempt(['password' => $request->old_password, 'email' => $user->email]);
        if (!$for_real) {
            return response()->json(['error' => true, 'message' => 'Old password invalid']);
        }
        $user->password = bcrypt($request->new_password);
        $user->save();
        return response()->json(['error' => false, 'message' => 'Password was updated successfully']);

    }


    /**
     * Reset password
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {

        $user = $request->user();

        $credential = [
            'email' => $user->email,
            'password' => $request->get('old_password')
        ];

        if (Auth::guard('web')->attempt($credential)) {
            $user->password = bcrypt($request->get('new_password'));
            $user->token()->revoke();
            $user->save();

            // $user->notify(new PasswordResetMail($user));
            //todo Create PasswordReset Mail

            $response = transformUser($user);
            return $this->success('Password Reset Successfully', $response);

        }

        return $this->error('Invalid email and password combination', 401);

    }


    /**
     * Get all users
     * @return JsonResponse
     */
    public function getAllUsers(): JsonResponse
    {

        $users = User::all();
        $userCollection = fractal($users, new UsersTransformer());

        return $this->success('List of users', $userCollection);

    }


    /**
     * List of Students
     * @return JsonResponse
     */
    public function getAllStudents(): JsonResponse
    {
        $students = User::students()->get();
       $studentsCollection = fractal($students, new StudentTransformer());

        return $this->success('List of Students', $studentsCollection);

    }

    /**
     * List of Teachers
     * @return JsonResponse
     */
    public function getAllTeachers(): JsonResponse
    {
        $teachers = User::teachers()->get();
        $teachersCollection = fractal($teachers, new TeacherTransformer());

        return $this->success('List of teachers', $teachersCollection);
    }

    /**
     * List of Admins
     * @return JsonResponse
     */
    public function getAllAdmins(): JsonResponse
    {
        $admins = User::admins()->get();
        $adminCollection = fractal($admins, new UsersTransformer());

        return $this->success('List of Admins', $adminCollection);
    }

    /**
     * List of Organizations
     * @return JsonResponse
     */
    public function getAllOrganizations(): JsonResponse
    {
        $organizations = User::organizations()->get();
        $organizationsCollection = fractal($organizations, new UsersTransformer());

        return $this->success('List of Organizations', $organizationsCollection);
    }

    /**
     * List of Gift Managers
     * @return JsonResponse
     */
    public function getAllGiftManagers(): JsonResponse
    {
        $giftManagers = User::gitfManagers()->get();
        $giftManagersCollection = fractal($giftManagers, new UsersTransformer());

        return $this->success('List of Gift Manager', $giftManagersCollection);
    }

    /**
     * List of essy Writers
     * @return JsonResponse
     */
    public function getAllEasyWriters(): JsonResponse
    {
        $essayWriters = User::essayWriters()->get();
        $essayWritersCollection = fractal($essayWriters, new UsersTransformer());

        return $this->success('List of Essay Writers', $essayWritersCollection);
    }

    /**
     * List of Counsellors
     * @return JsonResponse
     */
    public function getAllCounsellors(): JsonResponse
    {
        $counsellors = User::counsellors()->get();
        $counsellorsCollection = fractal($counsellors, new UsersTransformer());

        return $this->success('List of Counsellors', $counsellorsCollection);
    }

    /**
     * List of AspiringStudents
     * @return JsonResponse
     */
    public function getAllAspiringStudents(): JsonResponse
    {
        $aspiringStudents = User::prospectiveStudents()->get();
        $aspiringStudentsCollection = fractal($aspiringStudents, new UsersTransformer());

        return $this->success('List of Counsellors', $aspiringStudentsCollection);
    }


    /**
     * Upload profile  pic
     * @param ProfilePicUploadRequest $request
     * @return JsonResponse
     */
    public function uploadProfilePic(ProfilePicUploadRequest $request): JsonResponse
    {

        $user = $request->user();

        $avatar = $request->file('photo');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $request->file('photo')->move(storage_path('uploads/avatars'), $filename);

        //todo Save the file name only

        $user->photo = storage_path('uploads/avatars/' . $filename);
        $user->save();

        return $this->success('Photo saved successfully', $user->photo);

    }


    /**
     * Upload user Docs
     * @param UploadDocRequest $request
     * @return JsonResponse
     */
    public function uploadDocs(UploadDocRequest $request): JsonResponse
    {

        $user = $request->user();

        $document = $request->file('document');


        $filename = time() . '.' . $document->getClientOriginalExtension();
        $request->file('document')->move(storage_path('uploads/certs'), $filename);

        $doc = new DocumentManager();
        $doc->name = $request->document_name;
        //todo Save the file name only
        $doc->file_path = storage_path('uploads/certs/' . $filename);
        $doc->user_id = $user->id;
        $doc->save();

        $file = fractal($doc, new  DocumentTransformer());

        return $this->success('Document saved successfully', $file);


    }

    /**
     * Add multiple Subject to a User
     * @param AddSubjectRequest $request
     * @return JsonResponse
     */
    public function addSubjects(AddSubjectRequest $request): JsonResponse
    {

        $user = $request->user();
        $subjects = $request->subjects;
        foreach ($subjects as $key => $value) {
            $subject = Subject::create([
                'name' => $request->input('name')[$key],
                'description' => "no description on this one",
            ]);

            $user->subjects()->attach($subject);
        }

        return $this->success('Subjects Added Successfully', $user->subjects);
    }

    /**
     * Remove a Subject from User Profile
     * @param RemoveSubjectRequest $request
     * @return JsonResponse
     */
    public function removeSubject(RemoveSubjectRequest $request): JsonResponse
    {
        $user = $request->user();
        $subject = Subject::whereId($request->subject_id)->first();

        if ($subject) {
            $user->subjects()->detach($subject);
            return $this->success('Subjects Removed Successfully', $user->subjects);
        }

        return $this->error('Something went wrong while trying to remove the subject, Please try again  later', 400);

    }

    /**
     * Get a list of all users subjects
     * @param Request $request
     * @return JsonResponse
     */
    public function getSubjects(Request $request): JsonResponse
    {

        $user = $request->user();

        $subjects = $user->subjects;

        return $this->success('Subjects Removed Successfully', $subjects);
    }


    /**
     * Delete User
     * @param DeleteUserRequest $request
     * @return JsonResponse
     */
    public function deleteUser(DeleteUserRequest $request): JsonResponse
    {

        $userId = $request->user_id;
        $user = User::whereId($userId)->first();
        if ($user) {
            $user->delete();
            return $this->success('User Deleted Successfully', $user);

        }
        return $this->error('User Not Found', 400);

    }


}


