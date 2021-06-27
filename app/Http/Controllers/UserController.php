<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all users
        $user = User::paginate(5);

        return view('users.index', [
            'users' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //load the create form in view
        return View::make('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
        
                'name' => 'required',
                'email' => 'required | email',
                'password' => 'required | confirmed',
                'phone' => 'required |numeric| max: 14',
                'address' => 'required',
                'passport' => 'required',
                'id_card' => 'required',
                'role_id' => 'requred',

        ]);
        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
            'phone'=> $request->phone,
            'address'=>$request->address,
            'passport'=>$request->passport,
            'id_card'=>$request->id_card,
            'role_id'=>$request->role_id

        ]);

        
            return Redirect::to('users');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // get the user
        $user= User::find($id);

        // show the view and pass the user to it
        return View::make('users.show')
            ->with('users', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
         // get the user
         $user = User::find($id);

         // show the edit form and pass the user
         return View::make('users.edit')
             ->with('users', $user);
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
        
        // get all the data for our user
        $user = User::find($id);

        $userData = array_filter($request->all());
        if (isset($userData['password']))
            $userData['password'] = Hash::make($request->password);
           


        // update that user
        $user->fill($userData);
        $user->save();

        // redirect back to the users list
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
           // delete
           $users= User:find($id);
           $users>delete();
   
           // redirect
           return Redirect::to('user');
    }
}
