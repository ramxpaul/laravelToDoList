<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>


    <div class="container">
        <h2>Edit User</h2>
         {{-- error messages array loop --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Print Error Messages --}}
        @include('messages')


        <form action="<?php echo url('Users'); ?>" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="exampleInputName">User Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name"
                    placeholder="Enter Your Name" value="{{$data->name}}">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                    name="email" placeholder="example@company.com" value="{{$data->email}}">
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Image</label>
                <input type="file" name="image" id="exampleInputFile">
            </div>
            <p> <img src="{{url('images/users/'.$data->image)}}" alt="user" width="120px" height="120px"> </p>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>
