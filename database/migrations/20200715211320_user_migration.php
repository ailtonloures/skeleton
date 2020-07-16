<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

use function PHPSTORM_META\type;

final class UserMigration extends AbstractMigration
{
    public function up()
    {
        $user = $this->table('user');

        $user->addColumn("username", "string", ["limit" => 40]);
        $user->addColumn("password", "string");
        $user->addTimestamps();

        $user->save();
    }

    public function down()
    {
        $this->table('user')->drop()->save();
    }
}
