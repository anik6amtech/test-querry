<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
    dd($users->count());
    }


    public function getUserByPhone($phone)
    {

        // Enable query logging
        DB::enableQueryLog();
        // Use Eloquent to join the users and userdetails tables
        $user = User::join('user_details', 'users.id', '=', 'user_details.user_id')
                    ->whereIn('user_details.phone', $phone)
                    ->select('users.*', 'user_details.address', 'user_details.phone')
                    ->get();

       // Get the query log
       $queries = DB::getQueryLog();

       // Calculate the execution time of the query
       $executionTime = $queries[0]['time'];

       // Prepare the results
       $result = [
           'user' => $user,
           'execution_time' => $executionTime . ' ms',
           'query' => $queries[0]['query']
       ];

       // Return the result as JSON
       dd($result);
    }

    public function searchUserByPhoneOrAddress($search)
    {
        // Enable query logging
        DB::enableQueryLog();

        // Define the chunk size
        $chunkSize = 1000;

        // Initialize an empty collection to hold the results
        $usersCollection = collect();

        // Chunk the query results
        User::join('user_details', 'users.id', '=', 'user_details.user_id')
            ->where(function($query) use ($search) {
                $query->where('user_details.phone', 'like', '%' . $search . '%')
                      ->orWhere('users.email', 'like', '%' . $search . '%');
            })
            ->select('users.id', 'users.name', 'users.email', 'user_details.phone')
            ->chunk($chunkSize, function ($users) use (&$usersCollection) {
                // Merge each chunk into the main collection
                $usersCollection = $usersCollection->merge($users);
            });

        // Get the query log
        $queries = DB::getQueryLog();

        // Calculate the execution time of the query (in milliseconds)
        $executionTime = $queries[0]['time'];

        // Prepare the results
        $result = [
            'users' => $usersCollection,
            'execution_time' => $executionTime . ' ms',
            'query' => $queries[0]['query']
        ];

        // Return the result as JSON
        dd($result);
    }
    public function searchUserByPhoneOrAddress2($search)
{
    // Enable query logging
    DB::enableQueryLog();

    // Execute the query to join the users and user_details tables
    $users = User::join('user_details', 'users.id', '=', 'user_details.user_id')
                ->where(function($query) use ($search) {
                    $query->where('user_details.phone2', 'like', '%' . $search . '%')
                          ->orWhere('users.email2', 'like', '%' . $search . '%');
                })
                ->get();

    // Get the query log
    $queries = DB::getQueryLog();

    // Calculate the execution time of the query (in milliseconds)
    $executionTime = $queries[0]['time'];

    // Prepare the results
    $result = [
        'users' => $users,
        'execution_time' => $executionTime . ' ms',
        'query' => $queries[0]['query']
    ];

    // Return the result as JSON
    dd($result);
}

}
