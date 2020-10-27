<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $users = [
            [
                "username" => "jhon.doe",
                "password" => password_hash("123", PASSWORD_DEFAULT)
            ],
        ];

        $user = $this->table("user");
        $user->insert($users)
            ->saveData();
    }
}
