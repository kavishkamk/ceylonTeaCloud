<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logging</title>
        <link rel="stylesheet" type="text/css" href="../css/adminLogin.css">

        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <style>
        body {
            font-family: 'Roboto';
        }
        </style>
    </head>
    <body>
        <header>
            <div class="header-bar">
                <div class="liitem" id="proName" style="float:left"><img src="" height="10"></img></div>
                <div class="liitem"><a href="">Cylone Tea Cloud</a></div>
                <div class="liitem"><a href="" class="active">About</a></div>
            </div>
        </header>
        <main>
            <div class="container">
                <div id="logcont">
                <p>Log-In</p>
                    <form action="" class="logform" method="post">
                        <label for="unameormail">User Name or Email*</label><br>
                        <input type="text" name="unameormail" placeholder="enter your email / username" size="30" class="flog">
                        <br>
                        <label for="pwd">Password*</label><br>
                        <input type="password" name="pwd" placeholder="enter your password" size="30" class="flog"><br>
                        <button type="submit" name="log-submit" class="logbutn">Login</button>
                    </form>
                    <br>
                </div>
            </div>
        </main>
    </body>
</html>