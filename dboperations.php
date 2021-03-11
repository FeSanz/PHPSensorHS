<?php
 
class DbOperation
{
    private $con;
 
    function __construct()
    {
        require_once dirname(__FILE__) . '/dbconexion.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }
 
 function registerHumedity($plant, $rango, $percentage)
{
    date_default_timezone_set('America/Monterrey');
    $timestamp = date('Y-m-d H:i:s');
    $stmt = $this->con->prepare("INSERT INTO humedad (plant, date_time, rango, percentage) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $plant, $timestamp, $rango, $percentage);
    if($stmt->execute())
    {
        return true; 
    }
    else
    {
        return false; 
    }
 }
 
 function getHumedity()
 {
    $stmt = $this->con->prepare("SELECT id, plant, date_time, rango, percentage FROM humedad ORDER BY id DESC");
    $stmt->execute();
    $stmt->bind_result($id, $plant, $date_time, $rango, $percentage);

    $humedity_json = array(); 

    while($stmt->fetch())
    {
       $humedity_array  = array();
       $humedity_array['id'] = $id; 
       $humedity_array['plant'] = $plant; 
       $humedity_array['date_time'] = $date_time; 
       $humedity_array['rango'] = $rango; 
       $humedity_array['percentage'] = $percentage; 

       array_push($humedity_json, $humedity_array); 
    }

    return $humedity_json; 
 }
 
  function getCurrentHumedity()
 {
    $stmt = $this->con->prepare("SELECT * FROM humedad WHERE id= (SELECT MAX(id) AS id FROM humedad)");
    $stmt->execute();
    $stmt->bind_result($id, $plant, $date_time, $rango, $percentage);

    $humedity_json = array(); 

    while($stmt->fetch())
    {
       $humedity_array  = array();
       $humedity_array['id'] = $id; 
       $humedity_array['plant'] = $plant; 
       $humedity_array['date_time'] = $date_time; 
       $humedity_array['rango'] = $rango; 
       $humedity_array['percentage'] = $percentage; 

       array_push($humedity_json, $humedity_array); 
    }

    return $humedity_json; 
 }
 
 
 function getHumedityDates($startDate, $endDate)
 {
    //$stmt = $this->con->prepare("SELECT * FROM humedad WHERE DATE_SUB(CURDATE(),INTERVAL " .$days. " DAY) <= date_time");
    $stmt = $this->con->prepare("SELECT * FROM humedad WHERE  date_time BETWEEN '".$startDate." 00:00:01' AND '". $endDate." 23:59:59'");
    $stmt->execute();
    $stmt->bind_result($id, $plant, $date_time, $rango, $percentage);

    $humedity_json = array(); 

    while($stmt->fetch())
    {
       $humedity_array  = array();
       $humedity_array['id'] = $id; 
       $humedity_array['plant'] = $plant; 
       $humedity_array['date_time'] = $date_time; 
       $humedity_array['rango'] = $rango; 
       $humedity_array['percentage'] = $percentage; 

       array_push($humedity_json, $humedity_array); 
    }

    return $humedity_json; 
 }
 
 
 function updateHero($id, $name, $realname, $rating, $teamaffiliation){
 $stmt = $this->con->prepare("UPDATE heroes SET name = ?, realname = ?, rating = ?, teamaffiliation = ? WHERE id = ?");
 $stmt->bind_param("ssisi", $name, $realname, $rating, $teamaffiliation, $id);
 if($stmt->execute())
 return true; 
 return false; 
 }
 
 function deleteHero($id){
 $stmt = $this->con->prepare("DELETE FROM heroes WHERE id = ? ");
 $stmt->bind_param("i", $id);
 if($stmt->execute())
 return true; 
 
 return false; 
 }
}