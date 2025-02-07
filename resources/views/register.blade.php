<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error {
            color: red;
        }
    </style>

</head>

<body>


    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
                <h4 id="login"><span class="glyphicon glyphicon-lock"></span> Register</h4>
            </div>

            <x-alert type="danger" message="error" />
            <x-alert type="danger" message="verifyfail" />



            <div class="modal-body" style="padding:40px 50px;">
                <form method="POST" action="{{route('registersave')}}" role="form">
                    @csrf
                    {{-- <input type="hidden" name="id"> --}}
                    <div class="form-group">
                        <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ old('username') }}" placeholder="Enter username">
                        @error('username')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Email"><span class="glyphicon glyphicon-user"></span> Email</label>
                        <input type="text" class="form-control" id="Email" name="email"
                            value="{{ old('email') }}" placeholder="Enter email">
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password"><span class="glyphicon glyphicon-eye-open"></span>Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            value="{{ old('password') }}" placeholder="Enter password">
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm"><span class="glyphicon glyphicon-eye-open"></span>Confirm Password</label>
                        <input type="password-confirm" class="form-control" id="password-confirm" name="password_confirmation"
                            value="{{ old('password-confirm') }}" placeholder="Enter password">
                        @error('password-confirm')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-block"><span class="glyphicon glyphicon-off"></span>
                        Register</button>
                </form>
            </div>
            <div class="modal-footer">
                <a href="{{ route('Dashboard') }}"> <button type="submit" class="btn btn-danger btn-default m-3"
                        data-dismiss="modal"><span class="glyphicon glyphicon-remove "></span>Cancel</button></a>
                <p>Already a member? <a href="{{route('login')}}">Log in </a></p>
                {{-- <p>Forgot <a href="#">Password?</a></p> --}}
            </div>
        </div>
    </div>
    </div>

</body>

</html>
