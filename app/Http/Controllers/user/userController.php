<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    ##### Auth Check ######
    function __construct()
    {
        $this->middleware('loginCheck', ['except' => ['create', 'store']]);
    }
    #######################################

    public function index()
    {
        // Select query
        $data = DB::table('users')->get();
        return view('users.index', ['title' => "List Users.",'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validating Data
        $data = $this->validate($request, [
            'name' => 'required|max:60',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'image' => 'required|image|mimes:png,jpg,jpeg,gift,svg,wepb|max:2048',
        ]);

        ### Hashing The Password
        $data['password'] = bcrypt($data['password']);

        ### Uploading Image
        $imageName = time() . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('images/users'), $imageName);
        $data['image'] = $imageName;

        ### Insert Operation
        $operation = DB::table('users')->insert($data);

        if ($operation) {
            $message = "User Created Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Error : error occurred while creating new user";
            session()->flash('Message-error', $message);
        }
        return redirect(url('Users'));
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
        $data =   DB::table('users')->find($id);
        return view('users.edit', ['data' => $data]);
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
        // Validating Data
        // dd($request);
        $data = $this->validate($request, [
            'name' => 'required|max:60',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gift,svg,wepb|max:2048',
        ]);

        #### Fetching Old Image ####
        $getUser = DB::table('users')->find($id);
        ########################################
        // Image Update
        if ($request->has('image')) {
            $imageName = time() . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images/users'), $imageName);
            $data['image'] = $imageName;


            // Deleting Old Image
            if (file_exists(public_path('images/users/' . $getUser->image))) {
                unlink(public_path('images/users/' . $getUser->image));
            }
        } else {
            $data['image'] = $getUser->image;
        }

        #### Changing Password #####

        #########################################
        // Update Operation
        $op = DB::table('users')->where('id', $id)->update($data);

        if ($op) {
            $message = "User Updated Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Error : error occurred while Updating user";
            session()->flash('Message-error', $message);
        }
        return redirect(url('Users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ### Fetch Row Data
        $data = DB::table('users')->find($id);
        ### Delete Operation
        $operation = DB::table('users')->where('id', $id)->delete();

        if ($operation) {
            ### Removing Image from Server
            unlink(public_path('images/users/' . $data->image));

            $message = "User Deleted Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Error : Error occurred while Deleting User";
            session()->flash('Message-error', $message);
        }
        return redirect(url('Users'));
    }
}
