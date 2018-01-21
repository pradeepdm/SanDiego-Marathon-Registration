<!DOCTYPE html>
<html lang="en">

<!--
     Mallikarjun, Pradeep
     Jadran Id: Jadrn033
     Project #3
     Fall 2017
     -->

<head>
    <meta charset="UTF-8">
    <title>Runner Login</title>
</head>
<style type="text/css">
    h1, h2 {
        text-align: center;
    }

    body {
        margin: 25px;
    }

    input {
        margin: 5px;
    }

    #message_line {
        color: red;
    }
</style>
</head>
<body>

<div>
    <form method="post" action="display_report.php" name="login">
        <h3>Sign in</h3>
        <p>
            Password: <input type="password" name="password" placeholder="Enter password"/><br/>
        </p>
        <p>
            <input type="reset" value="Clear"/>
            <input type="submit" value="Log In"/>
        </p>
    </form>
</div>
</body>
</html>