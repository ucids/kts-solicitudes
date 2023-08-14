<?php 
// Database configuration 
$dbHost     = '192.168.0.194:5100';
$dbUsername = "ucid"; 
$dbPassword = "1974"; 
$dbName     = "ktz"; 
 

// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
} 
 
// Get search term 
$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = $db->query("SELECT * FROM proveedores WHERE proveedor LIKE '".$searchTerm."%' LIMIT 10");
 
// Generate array with skills data 
$skillData = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $data['id'] = $row['id']; 
        $data['value'] = $row['proveedor']; 
        array_push($skillData, $data); 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($skillData); 
?>