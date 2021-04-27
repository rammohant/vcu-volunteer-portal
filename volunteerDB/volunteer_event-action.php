<!-- will allow ALL users to see volunteer opportunities and sign up if wanted -->
<?php
require_once ('connection.php');

class VolunteerEvent
{
    public function listVolunteerEvent()
    {
        global $conn;
        
//         $sqlQuery = "SELECT v.eventID as `ID`,
//                             v.Title as `Title`,
//                             v.description as `Description`,
//                             v.link as 'Link',
//                             v.type as 'Type',
//                             v.DateRange as `Date`,
//                             v.available_spots as 'Available Spots',
//                             v.needed_skills as 'Skills Needed',
//                             v.age_minimum as 'Age Minimum'   
//                      FROM volunteer_events v";
        
        $sqlQuery = "SELECT v.eventID as `eventID`,
                            v.Title as `Title`,
                            v.description as `Description`,
                            v.link as 'Link',
                            v.type as 'Type',
                            v.startdate as 'startdate',
                            v.available_spots as 'available_spots',
                            v.needed_skills as 'needed_skills',
                            v.age_minimum as 'age_minimum'   
                     FROM volunteer_events v";

        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
        
        $numberRows = $stmt->rowCount();
        
        $dataTable = array();
        
        while ($sqlRow = $stmt->fetch()) {
            $dataRow = array();
            
            $dataRow[] = $sqlRow['eventID'];
            $dataRow[] = $sqlRow['title'];
            $dataRow[] = $sqlRow['description'];
            $dataRow[] = $sqlRow['link'];
            $dataRow[] = $sqlRow['type'];
            $dataRow[] = $sqlRow['startdate'];
            $dataRow[] = $sqlRow['available_spots'];
            $dataRow[] = $sqlRow['needed_skills'];
            $dataRow[] = $sqlRow['age_minimum'];
            
//             $dataRow[] = $sqlRow['ID'];
//             $dataRow[] = $sqlRow['Title'];
//             $dataRow[] = $sqlRow['Description'];
//             $dataRow[] = $sqlRow['Link'];
//             $dataRow[] = $sqlRow['Type'];
//             $dataRow[] = $sqlRow['StartDate'];
//             $dataRow[] = $sqlRow['Available Spots'];
//             $dataRow[] = $sqlRow['Skills Needed'];
//             $dataRow[] = $sqlRow['Age Minimum'];

            $dataTable[] = $dataRow;
        }
        
        $output = array(
            "recordsTotal" => $numberRows,
            "recordsFiltered" => $numberRows,
            "data" => $dataTable
        );
        
        echo json_encode($output);
    }
}

$volunteerevent = new VolunteerEvent();

if(!empty($_POST['action']) && $_POST['action'] == 'listVolunteerEvent') {
    $volunteerevent->listVolunteerEvent();
}

?>