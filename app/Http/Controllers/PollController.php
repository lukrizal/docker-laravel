<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;

class PollController extends Controller
{
    /**
     * Returns a json response of the visitors
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return view('welcome');
    }
    
    /**
     * Saves the poll data
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poll = new Poll();
        $poll->name = $request->get('name');
        $poll->gender = $request->get('gender');
        $poll->email = $request->get('email');
        $poll->age = $request->get('age');
        $poll->city = $request->get('city');
        $poll->save();

        return redirect()->back();
    }

    /**
     * Returns the number of users that answered the poll
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGender()
    {
        $male = Poll::where('gender', true)->count();
        $female = Poll::where('gender', false)->count();
        $age = Poll::avg('age');

        return response()->json([
            'male' => $male,
            'female' => $female,
            'age' => $age,
        ]);
    }
}
