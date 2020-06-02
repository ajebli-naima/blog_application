<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Charts;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
   
        $chart = Charts::database($user->posts, 'bar', 'highcharts')
			      ->title("Post Details")
			      ->elementLabel("Total Post")
			      ->dimensions(1000, 500)
			      ->responsive(true)
                  ->groupByMonth(date('Y'), true);

         $data = array (
            'posts' => $user->posts,
            'chart'=>  $chart,
        
        );   


            return view('dashboard')->with( $data);
    }

    
}
