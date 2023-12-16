<?php
require "config.php";


if (isset($_SESSION["email"])) {
    $userEmail = $_SESSION["email"];

    $checkCompanyQuery = "SELECT c.Company_ID
                          FROM company_registration c
                          INNER JOIN student_registration s ON c.Student_ID = s.Student_ID
                          WHERE s.Student_email = '$userEmail'";

    $resultCompany = mysqli_query($conn, $checkCompanyQuery);

    if (mysqli_num_rows($resultCompany) > 0) {
        $row = mysqli_fetch_assoc($resultCompany);
        $companyID = $row["Company_ID"];
    } else {
        // Handle the case where the user doesn't have a company
        echo "No company found for the user.";
        exit();
    }
} else {
    // Handle the case where the user is not logged in
    echo "User not logged in.";
    exit();
}

if (isset($_POST["searchTerm"])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST["searchTerm"]);

    // Assuming you have a 'project' table with a 'Project_title' column
    $searchQuery = "SELECT * FROM project WHERE Company_ID = '$companyID' AND Project_title LIKE '%$searchTerm%' ORDER BY Project_date DESC";
    $resultSearch = mysqli_query($conn, $searchQuery);

    while ($row = mysqli_fetch_assoc($resultSearch)) {
        echo '<a href="project.php?project_id=' . $row['Project_ID'] . '" class="project-card">';
        echo '<div>';
        echo '<div class="project-title">' . $row['Project_title'] . '</div>';
        echo '<div class="project-date">Date created: ' . date('m-d-y g:i A', strtotime($row['Project_date'])) . '</div>';
        echo '</div>';
        echo '</a>';
    }
} else {
    // Handle the case where no search term is provided
    echo "No search term provided.";
}
?>
