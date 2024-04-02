<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseTestController extends Controller
{
    public function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return "Connected successfully to the database.";
        } catch (\Exception $e) {
            return "Could not connect to the database. Please check your configuration. error:" . $e;
        }
    }
}
