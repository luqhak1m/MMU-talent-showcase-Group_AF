
<!-- 
 
Author(s): 
 
    1) Luqman

-->

<?php

require_once __DIR__ . '/../../public/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="/talent-portal/public/css/profile.css">
    <title>Profile</title>
</head>
<body>

    <div class="container">

        <div id="profile-banner-div">
        
        </div>
            
        <div id="profile-field-div">
            <form action="/talent-portal/public/index.php?page=upload" method="POST" enctype="multipart/form-data">
                <label for="profilepicture-input">
                    <img id="profilepicture-preview-img" src="images/profile.png" alt="Click to upload">
                </label>
                <input type="file" id="profilepicture-input" name="profilepicture-input" accept="image/*">
        
                <input type="text" name="firstname-input" id="fullname-input">
                <label for="fullname-input">First Name</label>
                
                <input type="text" name="lastname-input" id="lastname-input">
                <label for="lastname-input">Last Name</label>

                <input type="text" name="address-input" id="address-input">
                <label for="address-input">Address</label>


                <select name="gender-input" id="gender-input">
                    <option value="">Select Gender</option>
                    <option value="Male">Human Male</option>
                    <option value="Female">Human Female</option>
                </select>
                <label for="gender-input">Gender</label>

                <input type="date" name="dob-input" id="dob-input">
                <label for="dob-input">Date of Birth</label>
                
                <input type="tel" name="phonenumber-input" id="phonenumber-input">
                <label for="phonenumber-input">Phone Number</label>

                <textarea name="bio-input" id="bio-input" rows=3></textarea>                
                <label for="bio-input">Bio</label>

                <button type="submit">Save</button>

            </form>
        </div>

    </div>

    
</body>
</html>

<?php

require_once __DIR__ . '/../../public/footer.php';

?>