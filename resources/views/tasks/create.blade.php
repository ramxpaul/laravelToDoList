
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Task Creating</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>


    <div class="container">
        <h2>Add Task</h2>
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




        <form action="<?php echo url('Tasks'); ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


            <div class="form-group">
                <label for="exampleInputTitle">Title</label>
                <input type="text" class="form-control" id="exampleInputTitle" aria-describedby="" name="title"
                    placeholder="Enter Your Title" value="<?php echo old('title'); ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <textarea  class="form-control" id="exampleInputContent"  name="content"
                    placeholder="Enter Content"> {{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputStart">Start Date</label>
                <input type="date" class="form-control" id="exampleInputStart" name="sdate">
            </div>

            <div class="form-group">
                <label for="exampleInputEnd">End Date</label>
                <input type="date" class="form-control" id="exampleInputEnd" name="edate">
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Image</label>
                <input type="file" name="image" id="exampleInputFile">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>
