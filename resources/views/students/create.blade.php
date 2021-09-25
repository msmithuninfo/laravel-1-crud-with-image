<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">

                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif



                    <div class="card-header">
                        <h4>
                            Add Student With IMAGE
                            <a href="{{ url('students') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('add-student') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="form-group mb-3">
                                <label for="">Student Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Student Course</label>
                                <input type="text" name="course" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Student Profile Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Save Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>