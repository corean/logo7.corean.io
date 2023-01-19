<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = Member::orderBy('no')->get();
        foreach ($members as $member) {
            User::create([
                'member_id' => $member->no,
                'username'  => $member->id,
                'name'      => $member->name,
                'real_name' => $member->real_name,
                'email'     => $member->email,
                'password'  => $member->password,
            ]);
        }
    }
}
