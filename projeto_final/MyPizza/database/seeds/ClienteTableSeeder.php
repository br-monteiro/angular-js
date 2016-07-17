
<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{

    public function run()
    {
        factory(\App\Entities\Cliente::class, 15)->create();
    }
}
