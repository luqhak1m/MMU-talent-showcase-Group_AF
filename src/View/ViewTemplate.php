
<?php 

# Include the header and footer files for the login page
include '../../public/header.php'; 

?>

<!-- Content here -->
<h2>Login</h2>
<form method="POST" action="/login">
	<label>Username: <input type="text" name="username"></label><br>
	<label>Password: <input type="password" name="password"></label><br>
	<button type="submit">Login</button>
</form>
<!-- End of content here -->


<?php 

# Include the header and footer files for the login page
include '../../public/footer.php'; 

?>