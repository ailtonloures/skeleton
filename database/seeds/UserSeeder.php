<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $users = [
            [
                "username" => "user_test",
                "password" => "123"
            ],
        ];

        $user = $this->table("user");
        $user->insert($users)
            ->saveData();
    }
}
