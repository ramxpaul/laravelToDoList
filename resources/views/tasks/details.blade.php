<!DOCTYPE html>
<html>

<head>
    <title>Task Info</title>

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

        <a href="{{ url('Tasks') }}" class='btn btn-primary m-r-1em'>List Tasks</a>       <a href="{{ url('Tasks/create') }}" class='btn btn-primary m-r-1em'>+ Add Task</a> <a href="{{ url('logout') }}"
            class='btn btn-primary m-r-1em'>Logout</a>

        <br>

        <h2>{{ $data[0]->title }}</h2>
        <p>{{ $data[0]->content }}</p>
        <p>{{ date('Y-F-d', $data[0]->sdate) }}</p>
        <p>{{ date('Y-F-d', $data[0]->edate) }}</p>
        <p><img src="{{ url('images/tasks/' . $data[0]->image) }}" width="350px" height="350px"> </p>
        <p>

            {{ 'Took By , ' . $data[0]->name }}
            <br>
            <img src="{{ url('images/users/' . $data[0]->userImage) }}" width="80px" height="80px">

        </p>





    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
