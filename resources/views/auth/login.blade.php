<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Login</title>
</head>
<body>
<center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Welcome Back!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Login with your details to continue</p>
                </td>
            </tr>
            <tr>
            <form action="{{ route('login') }}" method="POST">
            @csrf
            <td class="label-td">
                <label for="pemail" class="form-label">Email: </label>
            </td>
            </tr>
            <tr>
            <td class="label-td">
                <input type="email" name="pemail" class="input-text" placeholder="Email Address" required>
            </td>
            </tr>
            <tr>
            <td class="label-td">
                <label for="ppassword" class="form-label">Password: </label>
            </td>
            </tr>

            <tr>
            <td class="label-td">
                <input type="Password" name="ppassword" class="input-text" placeholder="Password" required>
            </td>
            </tr>


            <tr>
                <td><br>
                @if($errors->any())
                    <div class="errors">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                    <a href="{{ route('signup') }}" class="hover-link1 non-style-link">Sign Up</a>
                    <br><br><br>
                </td>
            </tr>
                    </form>
        </table>

    </div>
</center>
</body>
</html>
