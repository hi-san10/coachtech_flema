<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionMessage;
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
        $this->call(UsersTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(ShippingAddressesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ConditionsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(CategoryItemTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(TransactionMessagesTableSeeder::class);
    }
}
