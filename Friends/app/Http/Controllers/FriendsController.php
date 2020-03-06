<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Friends;
use App\Models\User;
use Redirect;
use Session;

class FriendsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$friends = Friends::all();
        $friends = Friends::whereNotNull('accept_request_at')->get();

        return view('friends.index',['friends'=> $friends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('friends.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email'      => 'required|email',
        ]);
        $friend = new Friends;
        $friend->user_id = auth()->user()->id;
        $friend->email = $request->get('email');
        // if ($friend->save()) {
        //     Session::flash('message', 'Successfully created friend!');
        //     return Redirect::to('friends');
        // } else {
        //     Session::flash('error', 'Fail to created friend. Please try again');
        // }
        try {
        // store
            $friend = new Friends;
            $friend->user_id = auth()->user()->id;
            $friend->email = $request->get('email');
            $friend->save();
            $data = [
                'email' =>$request->get('email'),
                'type' => "invite"
            ];

            //Mail::to($request->get('email'))->send(new SendMail($data));
            Session::flash('message', 'Successfully created friend!');
            
            return Redirect::to('friends');

        } catch (\Exception $e) {
            Session::flash('error', 'Fail to created friend. Please try again'); 
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('friends');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $friend = Friends::find($id);
        $friend->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the friend!');
        return Redirect::to('friends');
    }
}
