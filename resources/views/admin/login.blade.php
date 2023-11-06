<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<title>Đăng nhập</title>
</head>
<style>

@charset "utf-8";
@import url(http://weloveiconfonts.com/api/?family=fontawesome);

@import url(http://meyerweb.com/eric/tools/css/reset/reset.css);

[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}

body {
	background-color: #C0C0C0;
	color: #000;
	font-family: "Varela Round", Arial, Helvetica, sans-serif;
	font-size: 16px;
	line-height: 1.5em;
	height: 60%;
}

input {
	border: none;
	font-family: inherit;
	font-size: inherit;
	font-weight: inherit;
	line-height: inherit;
	-webkit-appearance: none;
}

/* ---------- LOGIN ---------- */

#login {
	position: absolute;
	top: 50%;
	left:50%;
	transform: translate(-50%,-50%);
	width: 400px;
}

#login h2 {

    background-color: #4682B4;
	-webkit-border-radius: 20px 20px 0 0;
	-moz-border-radius: 20px 20px 0 0;
	border-radius: 20px 20px 0 0;
	color: #fff;
	font-size: 28px;
	padding: 20px 26px;
}

#login h2 span[class*="fontawesome-"] {
	margin-right: 14px;
}

#login div {
	background-color: white;
	-webkit-border-radius: 0 0 20px 20px;
	-moz-border-radius: 0 0 20px 20px;
	border-radius: 0 0 20px 20px;
	padding: 20px 26px;
}

#login div p {
	color: #777;
	margin-bottom: 14px;
}

#login div p:last-child {
	margin-bottom: 0;
}

#login div input {
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}

#login div input[type="text"], #login div input[type="password"] {
	background-color: #eee;
	color: #777;
	padding: 4px 10px;
	width: 328px;
    height: 30px;
}

#login div input[type="submit"] {
	background-color: #4682B4;
	color: #fff;
	display: block;
	margin: 0 auto;
	padding: 4px 0;
	width: 100px;
}

#login div input[type="submit"]:hover {
	background-color: #4682B4;
}
.err{
	border-color: red;
	/*border-width: 5px;*/
}
.success{
	border-color: green;
	/*border-width: 5px;*/
}

.show{
	color: red;
	font-style: italic;
	font-size: 14px;
}

</style>
<body>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong>{{ Session::get('success') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
	<div id="login">

		<h2><span class="fontawesome-lock"></span>Đăng nhập</h2>

		<form action="{{ route('check.login') }}" method="POST">
            @csrf
			<div>
				<p><label for="email">E-mail:</label></p>
				<p><input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="username@gmail.com"></p>
                <span class="alert text-danger pl-0">{{ $errors->first('email') }}</span>
				<p><label for="password">Mật khẩu:</label></p>
				<p><input type="password" id="password" name="password" placeholder="******"></p>
                <span class="alert text-danger pl-0">{{ $errors->first('password') }}</span>
                <br>
                    {{-- <input class="form-check-input mb-3" type="checkbox" name="remember" id="remember">
                    <label for="remember" class="mb-3">Ghi nhớ tôi</label> --}}
				<input type="submit" name="login" value="Đăng nhập">
			</div>
		</form>
	</div>
    @if (Session::get('fail'))
    <div class="alert alert-danger text-center">
        {{ Session::get('fail') }}
    </div>
    @endif
</body>

</html>
