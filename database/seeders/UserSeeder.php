<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $chunkSize = 500; // Number of records to insert per chunk
        $totalRecords = env('MAX_DATA', 10000000); // Default to 10 million if not set in env

        for ($i = 0; $i < $totalRecords; $i += $chunkSize) {
            $usersData = [];
            $userDetailsData = [];

            for ($j = 0; $j < $chunkSize; $j++) {
                // Create a unique user ID
                $userId = str()->uuid();
                $email = "test@email.com";
                $usersData[] = [
                    'id' => $userId,
                    'name' => $faker->name,
                    'email' => $i.$j.$email,
                    'email2' => $i.$i.$j.$email,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $phone = rand(1111111111,9999999999);
                $userDetailsData[] = [
                    'id' => str()->uuid(),
                    'user_id' => $userId,
                    'address' => $faker->address,
                    'phone' => $i.$j.$phone,
                    'phone2' => $i.$j.$phone,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert users data
            User::insert($usersData);

            // Insert user details data
            UserDetails::insert($userDetailsData);

            // Output progress to console
            $inserted = $i + $chunkSize;
            echo "Inserted $inserted / $totalRecords records.\n";
        }
    }
}
