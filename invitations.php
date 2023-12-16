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
    <title>Invitations - Launchpad</title>
    <link rel="icon" href="/launchpad/images/favicon.svg" />
    <link rel="stylesheet" href="css/navbar.css">
    <style>
        .containerin {
            width: 100%;
            padding: 15px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: left;
        }

        table tbody td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .notifNo {
            text-decoration: none;
            font-size: 14px;
            margin-left: 70px;
        }
    </style>
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
                        <i><img src="\launchpad\images\home-icon.png" alt="home-logo" class="logo-ic"></i>
                        <span>Home</span>
                    </span>
                </button>
            </a>
            <a href="project-idea-checker.php">
                <button>
                    <span>
                        <i><img src="\launchpad\images\project-checker-icon.png" alt="home-logo" class="logo-ic"></i>
                        <span>Project Idea Checker</span>
                    </span>
                </button>
            </a>
            <a href="#" class="active">
                <button>
                    <span>
                        <i><img src="\launchpad\images\invitation-icon.png" alt="home-logo" class="logo-ic"></i>
                        <span>Invitations</span>
                        <div class="notifNo" id="notifNo" aria-hidden="true"></div>
                    </span>
                </button>
            </a>
            <p class="divider-company">YOUR COMPANY</p>



            <a href="<?php echo $hasCompany ? 'company.php' : 'create-company.php'; ?>">
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
                    <span class="btn-join-company">
                        <i>
                            <div class="circle-avatar">
                                <img src="\launchpad\images\join-company-icon.png" alt="">
                            </div>
                        </i>
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
        <div class="containerin">
            <h2>Startup Project Invitations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Created By</th>
                        <th>Sort By</th>
                        <th>Confirm</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT 
            project.Project_title, 
            CONCAT(owner.Student_fname, ' ', owner.Student_lname) AS owner_name,
            project.Project_date,
            invitation.invitationID,
            invitation.invitationDate 
          FROM invitation
          INNER JOIN project ON invitation.projectID = project.Project_ID 
          INNER JOIN student_registration ON invitation.invitee_studentID = student_registration.Student_ID 
          INNER JOIN company_registration ON project.Company_ID = company_registration.Company_ID
          INNER JOIN student_registration AS owner ON company_registration.Student_ID = owner.Student_ID where student_registration.student_email = '$userEmail'
          ORDER BY invitation.invitationDate DESC";

                    $result = mysqli_query($conn, $query);

                    if (!$result) {
                        die("Error in the SQL query: " . mysqli_error($conn));
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['Project_title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['owner_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Project_date']) . "</td>";
                        echo "<td><button onclick='confirm(" . $row['invitationID'] . ")'>Confirm</button></td>";
                        echo "<td><button onclick='deleteInvitation(" . $row['invitationID'] . ")'>Delete</button></td>";
                        echo "</tr>";
                    }
                    ?>



                </tbody>
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