<?php

namespace Database\Seeders;

use App\Jobs\GenerateAccountNoJob;
use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create a sample  of all users

        $superUser = Role::whereName('super_administrator')->first();
        $adminRole = Role::whereName('administrator')->first();
        $studentRole = Role::whereName('student')->first();
        $teacherRole = Role::whereName('teacher')->first();
        $counselors = Role::whereName('counselors')->first();
        $organizationRole = Role::whereName('organization')->first();
        $parentRole = Role::whereName('parent')->first();
        $awardManagerRole = Role::whereName('award_manager')->first();
        $prospectiveStudentRole = Role::whereName('prospective_student')->first();
        $prospectiveParentRole = Role::whereName('prospective_parent')->first();

        $user = new User();
        $user->first_name = "super";
        $user->last_name = "user";
        $user->email = "superuser@couch.tutors";
        $user->phone_number = "123456789";
        $user->password = bcrypt('P@ssw0rd');
        $user->save();
        $user->attachRole($superUser);


        $admin = new User();
        $admin->first_name = "admin";
        $admin->last_name = "couch";
        $admin->email = "admin@couch.tutors";
        $admin->phone_number = "123456780";
        $admin->password = bcrypt('P@ssw0rd');
        $admin->save();
        $admin->attachRole($adminRole);

        $student = new User();
        $student->first_name = "student";
        $student->last_name = "user";
        $student->email = "student@couch.tutors";
        $student->phone_number = "123456781";
        $student->password = bcrypt('P@ssw0rd');
        $student->save();
        $student->attachRole($studentRole);

        $student = new User();
        $student->first_name = "student";
        $student->last_name = "user2";
        $student->email = "student2@couch.tutors";
        $student->phone_number = "123456782";
        $student->password = bcrypt('P@ssw0rd');
        $student->save();
        $student->attachRole($studentRole);

        $teacher = new User();
        $teacher->first_name = "couch";
        $teacher->last_name = "teacher";
        $teacher->email = "teacher@couch.tutors";
        $teacher->phone_number = "123456784";
        $teacher->password = bcrypt('P@ssw0rd');
        $teacher->save();
        $teacher->attachRole($teacherRole);

        $wallet = Wallet::updateOrCreate([
            'user_id' => $teacher->id
        ]);
        dispatch(new GenerateAccountNoJob($wallet));

        $school = new User();
        $school->first_name = "couch";
        $school->last_name = "organization2";
        $school->email = "2@couch.tutors";
        $school->phone_number = "123456785";
        $school->password = bcrypt('P@ssw0rd');
        $school->save();
        $school->attachRole($organizationRole);

        $parent = new User();
        $parent->first_name = "couch";
        $parent->last_name = "organization";
        $parent->email = "organization@couch.tutors";
        $parent->phone_number = "123456790";
        $parent->password = bcrypt('P@ssw0rd');
        $parent->save();
        $parent->attachRole($parentRole);

        $rewardsManager = new User();
        $rewardsManager->first_name = "reward";
        $rewardsManager->last_name = "manager";
        $rewardsManager->email = "reward_manager@couch.tutors";
        $rewardsManager->phone_number = "123456786";
        $rewardsManager->password = bcrypt('P@ssw0rd');
        $rewardsManager->save();
        $rewardsManager->attachRole($awardManagerRole);

        $couchCounselor = new User();
        $couchCounselor->first_name = "couch";
        $couchCounselor->last_name = "counselor";
        $couchCounselor->email = "counselor@couch.tutors";
        $couchCounselor->phone_number = "123456588";
        $couchCounselor->password = bcrypt('P@ssw0rd');
        $couchCounselor->save();
        $couchCounselor->attachRole($counselors);



        $prospectiveParent = new User();
        $prospectiveParent->first_name = "prospective";
        $prospectiveParent->last_name = "parent";
        $prospectiveParent->email = "prospect_parent@couch.tutors";
        $prospectiveParent->phone_number = "123456708";
        $prospectiveParent->password = bcrypt('P@ssw0rd');
        $prospectiveParent->save();
        $prospectiveParent->attachRole($prospectiveParentRole);

        $prospectiveStudent = new User();
        $prospectiveStudent->first_name = "prospective";
        $prospectiveStudent->last_name = "student";
        $prospectiveStudent->email = "prospect_sudent@couch.tutors";
        $prospectiveStudent->phone_number = "123456748";
        $prospectiveStudent->password = bcrypt('P@ssw0rd');
        $prospectiveStudent->save();
        $prospectiveStudent->attachRole($prospectiveStudentRole);


    }
}
