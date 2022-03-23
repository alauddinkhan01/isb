<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <p>hello world</p> --}}
        <div class="container" style="padding-top: 60px">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#usermodel">Add User</button>
            <!-- Button trigger modal -->
        
        
        <!-- Modal -->
        <div class="modal fade" id="usermodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="section">
                        <form action="" method="post" id="adduser">
                            @csrf
                            <label for="firstname">First Name</label>
                            <input type="text"  id="firstname" class="form-control">
                            <label for="lastname">Last Name</label>
                            <input type="text"  id="lastname" class="form-control">
                            <label for="email">Email</label>
                            <input type="Email"  id="email" class="form-control">
                            <label for="phone">Phone</label>
                            <input type="text"  id="phone" class="form-control">
                            <div class="modal-footer">
                                <button type="submit" id="btn-submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
        <table id="usertable" class="table">
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $user)
                    <tr>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn-submit").click(function(e){
  
            e.preventDefault();

            var firstname = $("input[firstname=firstname]").val();
            var lastname = $("input[lastname=lastname]").val();
            var email = $("input[email=email]").val();
            var phone = $("input[phone=phone]").val();

            $.ajax({
                type:'POST',
                url:"{{ route('newuser') }}",
                data:{firstname:firstname, lastname:lastname, email:email, phone:phone},
                success:function(data){
                    alert(data.success);
                }
            });

        });

    </script> --}}
    <script>
        $('document').ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#adduser').submit(function(e){
                
                e.preventDefault();

                let firstname = $('#firstname').val();
                let lastname = $('#lastname').val();
                let phone = $('#phone').val();
                let email = $('#email').val();
                let _token = $('name_token').val();

                $.ajax({
                    url:"{{ route('newuser') }}",
                    type:"post",
                    data:{
                        firstname : firstname,
                        lastname : lastname,
                        email : email,
                        phone : phone,
                        _token : _token,
                    },
                    success:function(response)
                    {
                        if (response) 
                        {
                            $('#usertable tbody').prepend('<tr>'+response.firstname+'</tr><tr>'+response.lastname+'</tr><tr>'+response.email+'</tr><tr>'+response.phone+'</tr>');
                            $('#adduser').reset();
                            $('#usermodel').reset();
                        }
                    }
                });
            });
        });
    </script>
    {{-- <form action="{{ route('testnow') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control" name="name" id="">
        @error('name')
        <span class="alert-danger">

            {{ $message }}
        </span>
        @enderror
        <input type="email" class="form-control" name="email" id="">
        <input type="text" class="form-control" name="phone" id="">
        <button type="submit" class="btn btn-primary">submit</button>
    </form> --}}
    </body>
</html>