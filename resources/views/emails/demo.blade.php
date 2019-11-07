<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the Laravel site</h2>
<br/>
   Hello <strong>{{ $userName }}</strong><br/>
   Set your password for email - <strong>{{ $userEmail }}</strong><br/>
   Your token is - <strong>{{ $token }}</strong>
   In future take this token I'll generate a link which will allow user to reset password 
</body>

</html>