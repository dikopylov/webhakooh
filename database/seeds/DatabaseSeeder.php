<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PlatensTableSeeder::class);
        $this->call(ReservationsStatusesTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(SchemesTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
    }
}
