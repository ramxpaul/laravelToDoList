<?php

namespace App\Http\Controllers\task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class taskController extends Controller
{

    function __construct()
    {
        $this->middleware('loginCheck');
        // $this->middleware('dateCheck', ['except' => ['create', 'store','index','show','edit','update']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id =  auth()->user()->id;
        $data = DB::table('task')
            ->join('users', 'task.user_id', '=', 'users.id')
            ->select('task.*', 'users.name', 'users.image as userImage')
            ->where('task.user_id',$id)
            ->get();

        return view('tasks.index', ['title' => "List Tasks.", 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tasks.create');
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
        $data =   $this->validate($request, [
            "title"    => "required | min:10 | max : 150",
            "content"  => "required|min:30 | max:15000",
            "sdate"     => "required|date",
            "edate"     => "required|date",
            "image"    => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        #### Convert Date To time Stamp ####
        $data['sdate']=strtotime($data['sdate']);
        $data['edate']=strtotime($data['edate']);

        #### Uploading Image ####
        $imageName = time().uniqid().'.'.$request->image->extension();
        $request->image->move(public_path('images/tasks'),$imageName);
        $data['image'] = $imageName;
        $data['user_id'] = auth()->user()->id;

        ##### Insert Operation #####
        $op = DB::table('task')->insert($data);
        if ($op) {
            $message = "Task Created Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Error : error occurred while creating the task";
            session()->flash('Message-error', $message);
        }

        return redirect(url('Tasks'));
       ############################
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
        $data = DB::table('task')
            ->join('users', 'task.user_id', '=', 'users.id')
            ->select('task.*', 'users.name', 'users.image as userImage')
            ->where('task.id', $id)
            ->get();

        return view('tasks.details', ['title' => "Task Details.", 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        #### Fetching Tasks Data ####
        $data =   DB :: table('task')->find($id);
        #############################
        #### Fetching Users Data####
        $users = DB::table('users')->get();
        ############################
        return view('tasks.edit',["title" => "Edit Task", 'data' => $data,'user'=>$users]);
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
        // dd($request);
            $data = $this->validate($request, [
            'title' => 'required|max:60',
            'content' => 'required|min:30 | max:15000',
            'sdate' => 'required|date',
            'edate' => 'required|date',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gift,svg,wepb|max:2048',
        ]);

        #### Fetching Old Image ####
        $getTask = DB::table('task')->find($id);
        ########################################
        $data['sdate']=strtotime($data['sdate']);
        $data['edate']=strtotime($data['edate']);
        // Image Update
        if ($request->has('image')) {
            $imageName = time() . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images/tasks'), $imageName);
            $data['image'] = $imageName;


            // Deleting Old Image
            if (file_exists(public_path('images/tasks/' . $getTask->image))) {
                unlink(public_path('images/tasks/' . $getTask->image));
            }
        } else {
            $data['image'] = $getTask->image;
        }
        $op = DB :: table('task')->where('id',$id)->update($data);
        if ($op) {
            $message = "Task Updated Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Error : error occurred while updateing";
            session()->flash('Message-error', $message);
        }

        return redirect(url('Tasks'));
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
        $data = DB::table('task')->find($id);
        ### Delete Operation
        $operation = DB::table('task')->where('id', $id)->delete();

        if ($operation) {
            ### Removing Image from Server
            unlink(public_path('images/tasks/' . $data->image));

            $message = "Task Deleted Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Error : Error occurred while Deleting Task";
            session()->flash('Message-error', $message);
        }
        return redirect(url('Tasks'));
    }
}
