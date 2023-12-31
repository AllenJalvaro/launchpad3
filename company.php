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
$companyID = "";
$companyName = "";
$companyLogo = "";

if ($hasCompany) {
    $row = mysqli_fetch_assoc($resultCompany); 
    $companyID = $row["Company_ID"];
    $companyName = $row["Company_name"];
    $companyLogo = $row["Company_logo"]; 
}else{
    header("Location: index.php");
    exit();
}
$projectQuery = "SELECT * FROM project WHERE Company_ID = '$companyID' ORDER BY Project_date DESC";
$resultProjects = mysqli_query($conn, $projectQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $hasCompany && !empty($companyName) ? $companyName." - Launchpad" : 'Create Company - Launchpad'; ?></title> 
    <link rel="icon" href="/launchpad/images/favicon.ico" id="favicon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/company.css">
     <script>
        function changeFavicon(url) {
            const favicon = document.getElementById('favicon');
            favicon.href = url;
        }
        <?php if ($hasCompany && !empty($companyLogo)): ?>
            const companyLogoUrl = "/launchpad/<?php echo $companyLogo; ?>";
            changeFavicon(companyLogoUrl);
        <?php endif; ?>
    </script>
</head>
<body>
    
<aside class="sidebar">
            <header class="sidebar-header">
                <img src="\launchpad\images\logo-text.svg" class="logo-img">
            </header>

            <nav>
                <a href="index.php">
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
        <div class="content2">
                       
        <div class="search-bar">
    <input type="text" id="projectSearch" name="projectSearch" placeholder="Search any <?php echo $companyName ?>'s projects">
</div>
            <h1><?php echo $companyName ?>'s projects <span class="forspace"></span><span> <a href="#"><img src="images/options.png" alt="options-icon" height="30px"></a></span> </h1>
        </div>
            <div class="content">
            
        
    <a href="create-project.php" class="project-card2">
        <br><br>
        <img src="images/add-company-icon.png" alt="add-icon" width="30px">
        <h3>Create new project</h3>
    </a>

    <?php while ($row = mysqli_fetch_assoc($resultProjects)) : ?>
        <a href="project.php?project_id=<?php echo $row['Project_ID']; ?>" class="project-card">
            <div>
                <div class="project-title"><?php echo $row['Project_title']; ?></div>
                <div class="project-date">Date created: <?php echo date('m-d-y g:i A', strtotime($row['Project_date'])); ?></div>
            </div>
        </a>
    <?php endwhile; ?>
    <!-- Add this script inside the "content" div, below the existing JavaScript -->
<script>
    $(document).ready(function() {
        $("#projectSearch").on("input", function() {
            var searchTerm = $(this).val();

            if (searchTerm.length >0) { // You can adjust the minimum length
                $.ajax({
                    type: "POST",
                    url: "search-projects.php", // Create this file for handling the search
                    data: { searchTerm: searchTerm },
                    success: function(response) {
                        $(".project-card").hide(); // Hide all projects initially
                        $(".project-card2").hide();
                        // Display only the search results
                        $(response).appendTo(".content");
                    }
                });
            } else {
                $(".project-card").show();  // Hide all projects initially
                        $(".project-card2").show();
            }
        });
    });
</script>

</div>
<script type="text/javascript">
            function loadDoc() {

                setInterval(function() {
                    var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("notifNo").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "invitations-notifno.php", true);
                xhttp.send();
                }, 0);
               
            }
            loadDoc();
        </script>
</body>
</html>