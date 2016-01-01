{if isset($error)}
Sorry, that username already exists. <a href="register.php">Try again!</a>

{else if isset($id)}
You have successfully created a new user.
<br />
Your username is "{$user}" and your password is "pass".
<br />
You can log in <a href="index.php">here</a>.

{else}
Register a new user!
<br />
<hr>
<br />
<form action="register.php" method="post">
Username: <input name="username" type="text"><br />
<input type="submit" value="Submit">
</form>

{/if}




