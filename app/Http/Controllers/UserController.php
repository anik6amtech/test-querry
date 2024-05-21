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

        // Execute the query to join the users and user_details tables
        $users = User::join('user_details', 'users.id', '=', 'user_details.user_id')
                    ->where(function($query) use ($search) {
                        $query->where('user_details.phone', 'like', '%' . $search . '%')
                              ->orWhere('users.email', 'like', '%' . $search . '%');
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
