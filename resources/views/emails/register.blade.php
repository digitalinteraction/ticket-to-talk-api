<!DOCTYPE html>
<html>
    <head>
      <title>Registration</title>
    </head>
    <body>
        <h1>Thank You For Registering!</h1>
        <p>
            Dear {{$name}},
            <br />
            <br />
            Thank you for registering to use Ticket to Talk!
            You are almost ready to use the app, simply type the code below into the
            verification screen on the app to verify your email address.
            <br />
        </p>
        <h2>{{$code}}</h2>
        <p>
            Thanks,
            <br />
            <br />
            The Ticket to Talk team.
        </p>
    </body>
</html>
