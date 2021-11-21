<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $student = Role::where('role','Student')->first();
        $instructor = Role::where('role','Instructor')->first();
        $ta = Role::where('role','Teaching assistant')->first();

        $s1 = User::create([
            'name' => 'Test Student 1',
            'email' => 'student1@test.com',
            'password' => Hash::make('password'),
            'role_id' => $student->id,
        ]);
        $s1->role()->associate($student);

        $s2 = User::create([
            'name' => 'Test Student 2',
            'email' => 'student2@test.com',
            'password' => Hash::make('password'),
            'role_id' => $student->id,
        ]);
        $s2->role()->associate($student);

        $s3 = User::create([
            'name' => 'Test Student 3',
            'email' => 'student3@test.com',
            'password' => Hash::make('password'),
            'role_id' => $student->id,
        ]);
        $s3->role()->associate($student);

        $ta1 = User::create([
            'name' => 'Test TA 1',
            'email' => 'ta1@test.com',
            'password' => Hash::make('password'),
            'role_id' => $ta->id,
        ]);
        $ta1->role()->associate($ta);

        $ta2 = User::create([
            'name' => 'Test TA 2',
            'email' => 'ta2@test.com',
            'password' => Hash::make('password'),
            'role_id' => $ta->id,
        ]);
        $ta2->role()->associate($ta);

        $i1 = User::create([
            'name' => 'Test Instructor 1',
            'email' => 'instructor@test.com',
            'password' => Hash::make('password'),
            'role_id' => $instructor->id,
        ]);
        $i1->role()->associate($instructor);

        
    }
}
