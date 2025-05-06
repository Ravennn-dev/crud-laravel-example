<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRUD sample -raven</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .form-container {
            border: 2px solid;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            text-align: center;
        }

        input {
            display: block;
            width: 100%;
            margin: 5px 0;
            padding: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 4px;
        }

        h2 {
            margin-bottom: 20px;
        }
    </style>

</head>

<body style="display: flex; flex-direction: column; ">
    <div class="form-container">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="Name">
            <input name="username" type="text" placeholder="Username">
            <input name="password" type="password" placeholder="Password">
            <button type="submit">Register</button>
        </form>
    </div>
    
    <div style="text-align: center;">
        @auth
        <p>Congrats you are registered.</p>

        <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form>

        @endauth
    </div>

</body>

</html>