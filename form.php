<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="functions.js"></script>
</head>

<body>

    <div class="container">
        <div class="profile-image">
            <img src="profile.jpg" alt="Profile Picture">
        </div>
        <div class="form-section">
            <form method="post" enctype="multipart/form-data" onsubmit="submitForm(event)">
                <div class="form-label">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br><br>
                </div>


                <div class="form-label">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                </div>


                <div class="form-label">
                    <label for="image">Upload Image:</label>
                    <input type="file" id="image" name="image" required><br><br>
                </div>


                <div class="">
                    <label for="terms">I agree to the <a target="_blank">Terms and Conditions</a></label>
                    <input type="checkbox" id="terms" name="terms" required><br><br>
                </div>


                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>

</html>