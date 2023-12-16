<?php
require "config.php";

if (empty($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION["email"];


$checkCompanyQuery = "SELECT c.*, s.Student_ID 
                      FROM company_registration c
                      INNER JOIN student_registration s ON c.Student_ID = s.Student_ID
                      WHERE s.Student_email = '$userEmail'";

$resultCompany = mysqli_query($conn, $checkCompanyQuery);

$hasCompany = mysqli_num_rows($resultCompany) > 0;
$companyName = "";
$companyLogo = "";

if ($hasCompany) {
    $row = mysqli_fetch_assoc($resultCompany);
    $companyName = $row["Company_name"];
    $companyLogo = $row["Company_logo"]; 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temp</title>
		<link rel="icon" href="/launchpad/images/favicon.svg" />
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>

<aside class="sidebar">
            <header class="sidebar-header">
                <img src="\launchpad\images\logo-text.svg" class="logo-img">
            </header>

            <nav>
                <a href="index.php" >
                <button>
                    <span>
                        <i ><img src="\launchpad\images\home-icon.png" alt="home-logo" class="logo-ic"></i>
                        <span>Home</span>
                    </span>
                </button>
            </a>
            <a href="project-idea-checker.php">
                <button>
                    <span>
                        <i ><img src="\launchpad\images\project-checker-icon.png" alt="home-logo" class="logo-ic"></i>
                        <span>Project Idea Checker</span>
                    </span>
                </button>
    </a>
    <a href="invitations.php">
                <button>
                    <span>
                        <i ><img src="\launchpad\images\invitation-icon.png" alt="home-logo" class="logo-ic"></i>
                        <span>Invitations</span>
                    </span>
                </button>
    </a>
                <p class="divider-company">YOUR COMPANY</p>
               
                
                <a href="<?php echo $hasCompany ? 'company.php' : 'create-company.php'; ?>" class="active">
        <button>
            <span class="<?php echo $hasCompany ? 'btn-company-created' : 'btn-create-company'; ?>">
                <div class="circle-avatar">
                    <?php if ($hasCompany && !empty($companyLogo)): ?>
                        <img src="\launchpad\<?php echo $companyLogo; ?>" alt="Company Logo" class="img-company">
                    <?php else: ?>
                        <img src="\launchpad\images\join-company-icon.png" alt="Join Company Icon">
                    <?php endif; ?>
                </div>
                <span class="create-company-text">
                    <?php echo $hasCompany ? $companyName : 'Create your company'; ?>
                </span>
            </span>
        </button>
    </a>


                <p class="divider-company">COMPANIES YOU'VE JOINED</p>
                <a href="#">
                <button>
                    <span  class="btn-join-company">
                        <i > <div class="circle-avatar">
                            <img src="\launchpad\images\join-company-icon.png" alt="">
                        </div></i>
                        <span class="join-company-text">Join companies</span>
                    </span>
                </button>
                </a>
<a href="profile.php">
                <button>
                    <span>
                        <!-- <img src="logo.png" alt=""> -->
                        <span>Profile</span>
                    </span>
                </button>
</a>
               
            </nav>


        </aside>
<div class="content">
<?php
    
    $company_name = $_POST['company_name'];
    $company_description = $_POST['company_description'];


    if (isset($_FILES["company_logo"])) {
        $file = $_FILES["company_logo"];
        $file_name = $file["name"];
        $file_tmp_name = $file["tmp_name"];
        $file_error = $file["error"];
        $email = $_SESSION["email"];

        $select = "SELECT * FROM student_registration where Student_email='$email'";
        $result = mysqli_query($conn, $select);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $student_ID = $row['Student_ID'];
            }
        }
        
        if ($file_error === 0) {
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_extensions = array("jpg", "jpeg", "png");
            
            if (in_array($file_ext, $allowed_extensions)) {
                $picture_path = "images/".uniqid() . "." . $file_ext;
            
                move_uploaded_file($file_tmp_name, $picture_path);
                
                $sql = "INSERT INTO company_registration (Student_ID, Company_name, Company_description, Company_logo, Registration_date) VALUES ('$student_ID', '$company_name', '$company_description', '$picture_path', NOW())";
                
                if (mysqli_query($conn, $sql)) {
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Only JPEG, JPG, and PNG files are allowed.";
            }
             $display = "SELECT * FROM company_registration INNER JOIN student_registration ON company_registration.Student_ID=student_registration.Student_ID WHERE company_registration.Student_ID = '$student_ID'";
        $resultDisplay = mysqli_query($conn, $display);
        if ($resultDisplay) {
            if (mysqli_num_rows($resultDisplay) > 0) {
                $row = mysqli_fetch_assoc($resultDisplay);
                echo "Company name: " . $row['Company_name'] . "<br>";
                echo "Company description: " . $row['Company_description'] . "<br>";
                echo "<td><img src='/launchpad/".$row["Company_logo"]."' alt='Candidate Picture' width='100'></td>";
            }
            echo "<script>alert('Your company has been created successfully')</script>";
            header("Refresh: 1 url=company.php");
        }
        } else {
            echo "Error uploading the file.";
        }
       
    } else {
        echo "No file uploaded.";
    }


    
?>
</div>
</body>
</html>


