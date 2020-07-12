<?php

use App\User;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Database\Seeder;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('superadmin')->everything();

        Bouncer::allow('contributor')->everything();
        Bouncer::forbid('contributor')->toManage(User::class);

    }
}
