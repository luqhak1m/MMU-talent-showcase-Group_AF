
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
    <script src="/talent-portal/public/js/profile.js"></script>   
    <title>Profile</title>
</head>
<body>

    <div class="container">

        <div id="profile-banner-div"></div>

        
        <div id="profile-field-div">
            <form action="/talent-portal/public/index.php?page=profile" method="POST" enctype="multipart/form-data">

                <!-- pfp that takes a bit of the banner -->

                <div id="profilepicture-div">
                    <label for="profilepicture-input">
                        <img id="profilepicture-preview-img" 
                            src="<?php 
                            
                            $profilePicturePath='images/profile.png'; // default image
                            if (!empty($fetched_profile['ProfilePicture'])){
                                $profilePicturePath='uploads/'.htmlspecialchars($fetched_profile['ProfilePicture']);
                            }    
                            
                            echo $profilePicturePath;
                            ?>"
                            alt="Click to upload">
                    </label>
                    <input type="file" id="profilepicture-input" name="profilepicture-input" accept="image/*" disabled>
                </div>

                <!-- first name and last name side by side -->

                <div id="name-row-div">
                    <div class="grouped-form-div">
                        <label for="fullname-input">First Name</label>
                        <input type="text" name="firstname-input" id="fullname-input" readonly 
                            value="<?php  
                            
                                $first_name = '';
                                if (isset($fetched_profile['FirstName'])) {
                                    $first_name = htmlspecialchars($fetched_profile['FirstName']);
                                }
                                echo $first_name;
                                
                            ?>">
                    </div>
                    <div class="grouped-form-div">                    
                        <label for="lastname-input">Last Name</label>
                        <input type="text" name="lastname-input" id="lastname-input" readonly 
                            value="<?php  
                                
                                $last_name = '';
                                if (isset($fetched_profile['LastName'])) {
                                    $last_name = htmlspecialchars($fetched_profile['LastName']);
                                }
                                echo $last_name;
                                
                            ?>">
                    </div>


                </div>

                <label for="address-input">Address</label>
                <input type="text" name="address-input" id="address-input" readonly 
                    value="<?php  
                            
                            $address = '';
                            if (isset($fetched_profile['Address'])) {
                                $address = htmlspecialchars($fetched_profile['Address']);
                            }
                            echo $address;
                            
                        ?>">

                <label for="gender-input">Gender</label>
                <select name="gender-input" id="gender-input" disabled>
                    <option value="">Select Gender</option>
                    <option 
                        value="M"
                        <?php
                            if (isset($fetched_profile['Gender'])) {
                                if ($fetched_profile['Gender'] === 'M') {
                                    echo 'selected';
                                }
                            }
                        ?>>
                    Human Male</option>

                    <option 
                        value="F"
                        <?php
                            if (isset($fetched_profile['Gender'])) {
                                if ($fetched_profile['Gender'] === 'F') {
                                    echo 'selected';
                                }
                            }
                        ?>> 
                    Human Female</option>
                </select>

                <label for="dob-input">Date of Birth</label>
                <input type="date" name="dob-input" id="dob-input" readonly 
                    value="<?php  
                                
                            $dob = '';
                            if (isset($fetched_profile['DOB'])) {
                                $dob = htmlspecialchars($fetched_profile['DOB']);
                            }
                            echo $dob;
                            
                        ?>">
                
                <label for="phonenumber-input">Phone Number</label>
                <input type="tel" name="phonenumber-input" id="phonenumber-input" readonly 
                    value="<?php  
                                
                            $tel = '';
                            if (isset($fetched_profile['PhoneNum'])) {
                                $tel = htmlspecialchars($fetched_profile['PhoneNum']);
                            }
                            echo $tel;
                            
                        ?>">

                <label for="bio-input">Bio</label>
                <textarea name="bio-input" id="bio-input" rows=3 readonly><?php  
                                
                            $bio = 'No bio set';
                            if (isset($fetched_profile['Bio'])) {
                                $bio = htmlspecialchars($fetched_profile['Bio']);
                            }
                            echo $bio;
                            
                        ?></textarea>                

                <button type="submit" disabled>Save</button>
                <button type="button" onclick="enableEditing()">Edit</button>

            </form>
        </div>

    </div>
    
</body>
</html>

<?php

require_once __DIR__ . '/../../public/footer.php';


?>