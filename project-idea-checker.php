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

require __DIR__ . '/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;
$open_ai_key = "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";
$open_ai = new OpenAi($open_ai_key);
$projectTitle;
$response;

if(isset($_POST['submitG'])){
     
   $projectTitle = $_POST['projectTitle']; 
   $projectDesc = $_POST['projectDesc'];
    $prompter = 

   $complete = $open_ai->completion([
    'model' => 'text-davinci-003',
    'prompt' => <<<EOT
    
    The only response you will always display is the PERCENTAGE ONLY, then the category, then explanation. NOTHING ELSE.
    If the same prompt provide like earlier, do not change your response especially the percentage.

    Scan and assess how unique this startup project title is among all the existing systems or startup projects on the web.
    Do not be biased, be frank. Be honest whether it is common or unique.
    Be formal in writing, do not use 'I'. 
    It's not need to be real-time web scanning or access current databases.
    Just provide a general assessment based on my training data up to January 2022.
    Do not say 'I am unable to perform real-time web scanning, but I can offer a general assessment based on my training data up to January 2022.'
    If the title or description is too vague, do not assess it and say that the user needs to add more context for clarity.
    If the same prompt provide like earlier, do not change your response especially the percentage.


    Output Format Instructions: (linebreak every after line)
    First line: Display ONLY AND STRICTLY the percentage, nothing else. then line break.
    On the next line:
        If the percentage is ranging from 0-25%: ONLY STRICTLY display the text Common Concept, nothing else.
        If the percentage is ranging from 26-50%: ONLY STRICTLY display the text Familiar Idea, nothing else.
        If the percentage is ranging from 51-75%: ONLY STRICTLY display the text Average Approach, nothing else.
        If the percentage is ranging from 76-89%: ONLY STRICTLY display the text Innovative Solution, nothing else.
        If the percentage is ranging from 90-100%: ONLY STRICTLY display the text Trailblazing Idea!, nothing else.
    And on the last line: Provide a brief explanation.

    Sample response:

    35.56%

    Familiar Idea
    
    The startup project title "PikPok," a social media platform for creating, sharing, and discovering short videos, falls within a familiar idea category. While the platform may have unique features, the concept of a social media platform for short video content is relatively common in the startup landscape.


    This is what will you assess:
    Startup Project Title: $projectTitle
    Startup Project Description: $projectDesc
    EOT,
    'temperature' => 0.9,
    'max_tokens' => 150,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);

$response = json_decode($complete, true);
$response = $response["choices"][0]["text"];
    
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Idea Checker - Launchpad</title>
    <link rel="icon" href="/launchpad/images/favicon.svg" />
    <link rel="stylesheet" href="css/navbar.css">
    <style>
        .inputTitle {
            width: 100%;
            height: 50px;
            background-color: #ffffff00;
            border: 1px solid var(--pblue-color);
            font-family: inherit;
            font-size: 15px;
            padding: 0 16px;
            border-radius: 1.25rem;
            transition: all 0.375s;
            margin: 10px;
        }

        .inputTitle:hover {
            border: 1px solid var(--pyellow-color);
        }

        .generatebtn {
            width: 100%;
            height: 50px;
            cursor: pointer;
            width: 100%;
            padding: 0 16px;
            border-radius: 1.25rem;
            background: var(--pblue-color);
            color: #f9f9f9;
            border: 0;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            letter-spacing: 2px;
            transition: all 0.375s;
            margin-top: 5px;
        }
        .output-text{
            white-space: break-spaces;
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
            <a href="#" class="active">
                <button>
                    <span>
                        <i><img src="\launchpad\images\project-checker-icon.png" alt="home-logo" class="logo-ic"></i>
                        <span>Project Idea Checker</span>
                    </span>
                </button>
            </a>
            <a href="invitations.php">
                <button>
                    <span>
                        <i><img src="\launchpad\images\invitation-icon.png" alt="home-logo" class="logo-ic"></i>
                        <span>Invitations</span>
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
        <div>
            <h1>Project Idea Checker</h1>
        </div>
        <div>
            <form action="" method="post">
                <div>
                    <label for="projectTitle" style="margin-left: 20px;">Project Title:</label><br>
                    <input class="inputTitle" type="text" name="projectTitle" id="projectTitle" placeholder="Enter your title" value="<?php if(isset($projectTitle)) echo $projectTitle;?>">
                </div><br><br>
                <div>
                    
                <label for="projectDesc" style="margin-left: 20px">Project Description:</label><br>
                <textarea  class="inputTitle" name="projectDesc" id="projectDesc" cols="30" rows="50" style="padding: 10px;" placeholder="Enter your project title's description"><?php if(isset($projectDesc)) echo $projectDesc;?></textarea>
                   
                </div><br><br>
                <div>
                    <input type="submit" value="Generate" name="submitG" class="generatebtn">
                </div>
            </form>
        </div><br>
        <div>
        <h2>Assessment:</h2>
    <div class="output-text">
    <?php if(isset($response)) echo $response;?>
    </div>
        </div>
        <br><br>
    </div>

    <script type="text/javascript">
        function loadDoc() {

            setInterval(function () {
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