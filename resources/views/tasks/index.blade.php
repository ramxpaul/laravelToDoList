<!DOCTYPE html>
<html>

<head>
    <title>Tasks List</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1> {{ $title }} </h1>
            <br>

            {{ 'Welcome , ' . auth()->user()->name }}
            <br>

            @include('messages')

        </div>
        <div>
            <a href="{{ url('Tasks/create') }}" class='btn btn-primary m-r-1em'>+ Add Task</a>
            <a href="{{ url('Users') }}" class='btn btn-primary m-r-1em'>Users List</a>
            <a href="{{ url('logout') }}" class='btn btn-primary m-r-1em'>Logout</a>
        </div>
        <br>

        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Image</th>
                <th>User Name</th>
                <th>Show Task Info</th>
                <th>Action</th>
            </tr>


            @foreach ($data as $key => $task)
                <tr>

                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ Str::limit($task->content, 30, '...') }}</td>
                    <td>{{ date('Y-m-d', $task->sdate) }}</td>
                    <td>{{ date('Y-m-d', $task->edate) }}</td>
                    <td><img src="{{ url('images/tasks/' . $task->image) }}" width="80px" height="80px"></td>
                    <td> {{ $task->name }} </td>

                    <td>
                        <a href='{{ url('Tasks/' . $task->id) }}' class='btn btn-primary m-r-1em'>Show Task Info</a>
                    </td>

                    <td>
                        <a href='' data-toggle="modal" data-target="#modal_single_del{{ $task->id }}"
                            class='btn btn-danger m-r-1em'>Remove Row</a>
                        <a href="{{ url('Tasks/' . $task->id . '/edit') }} " class='btn btn-primary m-r-1em'>Update
                            Row</a>
                    </td>
                </tr>



                <div class="modal" id="modal_single_del{{ $task->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                Are You Sure That You Want To Remove Task : {{ $task->title }} !!!!
                            </div>
                            <div class="modal-footer">
                                <form action="{{ url('Tasks/' . $task->id) }}" method="post">
                                    @csrf
                                    @method('delete')


                                    <div class="not-empty-record">
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
