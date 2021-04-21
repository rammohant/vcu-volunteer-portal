<!-- will allow ALL users to see volunteer opportunities and sign up if wanted -->
<?php
require_once ('connection.php');

class VolunteerOpportunities
{
    public function listVolunteerOpportunities()
    {
        global $conn;
        
        $sqlQuery = "SELECT v.eventID as `ID`,
                            v.Title as `Title`,
                            v.description as `Description`,
                            v.link as 'Link',
                            v.type as 'Type',
                            v.DateRange as `Date`,
                            v.available_spots as 'Available Spots',
                            v.needed_skills as 'Skills Needed',
                            v.age_minimum as 'Age Minimum'   
                     FROM v_volunteer_ops v";
       
        // Search by title, description, or type 
        if (! empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE (e.title LIKE "%' . $_POST["search"]["value"] . '%" OR e.description LIKE "%' . $_POST["search"]["value"] . '%" or j.type LIKE "%' . $_POST["search"]["value"] . '%") ';
        }
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
        
        $numberRows = $stmt->rowCount();
        
        $dataTable = array();
        
        while ($sqlRow = $stmt->fetch()) {
            $dataRow = array();
            
            $dataRow[] = $sqlRow['ID'];
            $dataRow[] = $sqlRow['Title'];
            $dataRow[] = $sqlRow['Description'];
            $dataRow[] = $sqlRow['Link'];
            $dataRow[] = $sqlRow['Type'];
            $dataRow[] = $sqlRow['Date'];
            $dataRow[] = $sqlRow['Available Spots'];
            $dataRow[] = $sqlRow['Skills Needed'];
            $dataRow[] = $sqlRow['Age Minimum'];
            

            $dataTable[] = $dataRow;
        }
        
        $output = array(
            "recordsTotal" => $numberRows,
            "recordsFiltered" => $numberRows,
            "data" => $dataTable
        );
        
        echo json_encode($output);
    }


public function signUp()
{
    global $conn;
    
    $sqlQuery = "INSERT INTO employees
                     (first_name, last_name, manager_ID, department_ID, email, job_ID, salary, hire_date)
                     VALUES
                     (:first_name, :last_name, :manager_ID, :department_ID, :email, :job_ID, :salary, CURDATE())";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':first_name', $_POST["firstname"]);
    $stmt->bindValue(':last_name', $_POST["lastname"]);
    $stmt->bindValue(':manager_ID', $_POST["manager"]);
    $stmt->bindValue(':department_ID', $_POST["department"]);
    $stmt->bindValue(':email', $_POST["email"]);
    $stmt->bindValue(':job_ID', $_POST["job"]);
    $stmt->bindValue(':salary', $_POST["salary"]);
    $stmt->execute();
}
}

$volunteeropportunities = new VolunteerOpportunities();

if(!empty($_POST['action']) && $_POST['action'] == 'listVolunteerOpportunities') {
    $volunteeropportunities->listVolunteerOpportunities();
}

if(!empty($_POST['action']) && $_POST['action'] == 'signUp') {
    $volunteeropportunities->signUp();
}



?>