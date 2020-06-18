<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
    </head>
    <body>
        <form action="/user/store" method="post">
            {{csrf_field()}}
            <!--<input type="hidden" name="_token" value="{{csrf_token()}}">-->
            nickname:<input type="text" name="nickname"><br>
            email:<input type="text" name="email"><br>
            password:<input type="password" name="password"><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>