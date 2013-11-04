<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css" />
        <title>Onixia</title>
    </head>
    <body>
        <div id="header">
            <div class="logo"></div>
        </div>
        <div id="content">
            <form action="login.php" method="post">
                <input type="text" name="user"/>
                <input type="password" name="pass"/>
                <input type="submit" value="LogIn"/>
                <input type="hidden" name="login" value="1"/>
            </form><br/>
            <form action="register.php" method="post">
                nick: <input type="text" name="user"/><br/>
                pass: <input type="password" name="pass"/><br/>
                email: <input type="text" name="email"/><br/>
                <input type="hidden" name="register" value="1">
                <input type="submit" value="register">
            </form>
        </div>
        <div id="footer">
            
        </div>
    </body>
</html>