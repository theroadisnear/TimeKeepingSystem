<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Users;
use App\Images;
use App\Shifts;
use Illuminate\Http\Request;
use Validator;

use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = Users::all();
        return view('users.students', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['usernumber' => 'required|unique:users|integer', 
            'lastname' => 'required|min:2|max:50', 
            'firstname' => 'required|min:2|max:50',
            'middleinitial' => 'required|min:1|max:1',
            'department' => 'required',
            'birthday' => 'required|date_format:"Y-m-d"|before:2010-01-01|after:1899-12-31',
            //'idpicture' => 'required|image'

            ], ['unique' => 'May nagmamayari na po', 
            'required' => 'Kailangan mo ako',
            'integer' => 'It must be an integer', 
            'min' => 'Kulang pa',
            'max' => 'Sobra ka na',
            'before' => 'Ang bata mo pa',
            'after' => 'Buhay ka pa']);

        $users = new Users;

        $users->usernumber = $request->usernumber;
        $users->lastname = $request->lastname;
        $users->firstname = $request->firstname;
        $users->middleinitial = $request->middleinitial;
        $users->birthday = $request->birthday;
        $users->department = $request->department;

        $users->save();

        $imageName = $users->id.'.'.$request->file('idpicture')->getClientOriginalExtension();
        $path = base_path().'/public/images/idpictures/';
        $request->file('idpicture')->move(base_path().'/public/images/idpictures/', $imageName);

        $images = new Images;
        $images->idpicture = '/images/idpictures/'.$users->id.'.'.$request->file('idpicture')->getClientOriginalExtension();
        $images->user_id = $users->id;
        $images->save();

        $image = Image::make(base_path().'/public/images/idpictures/'.$imageName)->resize(350, 350);
        $image->save(base_path().'/public/images/idpictures/'.$imageName);
        if (($request->official_time_in != null) && ($request->official_time_in != null))
        {
            $shifts = new Shifts;
            $shifts->user_id = $users->id;
            $shifts->official_time_in = $request->official_time_in;
            $shifts->official_time_out = $request->official_time_out;

            $shifts->save();
        }
        
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Users::findOrFail($id);
        $image = Images::findOrFail($id);
        $shift = Shifts::where('user_id', $id)->first();


        return view('users.edit', compact('user'))->with(compact('image'))->with(compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, ['usernumber' => 'required|integer|unique:users,usernumber,'.$request->id, 
            'lastname' => 'required|min:2|max:50', 
            'firstname' => 'required|min:2|max:50',
            'middleinitial' => 'required|min:1|max:1',
            'department' => 'required',
            'birthday' => 'required|date_format:"Y-m-d"|before:2010-01-01|after:1899-12-31',
            'idpicture' => 'image|unique:images,idpicture,$request->id',

            ], ['unique' => 'May nagmamayari na po', 
            'required' => 'Kailangan mo ako',
            'integer' => 'It must be an integer', 
            'min' => 'Kulang pa',
            'max' => 'Sobra ka na',
            'before' => 'Ang bata mo pa',
            'after' => 'Buhay ka pa']);


        $user = Users::findOrFail($request->id);
        $shift = Shifts::where('user_id', $request->id)->first();
        $image = Images::findOrFail($request->id);

        $user->usernumber = $request->usernumber;
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->middleinitial = $request->middleinitial;
        $user->birthday = $request->birthday;
        $user->department = $request->department;
        $shift->official_time_in = $request->official_time_in;
        $shift->official_time_out = $request->official_time_out;

        if($request->hasFile('idpicture'))
        {
            $imageName = $user->id.'.'.$request->file('idpicture')->getClientOriginalExtension();
            $path = base_path().'/public/images/idpictures/';
            $request->file('idpicture')->move(base_path().'/public/images/idpictures/', $imageName);

            
            $image->idpicture = '/images/idpictures/'.$user->id.'.'.$request->file('idpicture')->getClientOriginalExtension();
            $image->user_id = $user->id;
            $image->save();

            $image = Image::make(base_path().'/public/images/idpictures/'.$imageName)->resize(350, 350);
            $image->save(base_path().'/public/images/idpictures/'.$imageName);

        }
        
        

        $shift->save();
        $user->save();



        return redirect('users');
    }   

    public function delete(Request $request)
    {
        $user = Users::findOrFail($request->id);

        $user->delete();

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
