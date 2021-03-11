<?php

require_once 'dboperations.php';

function isTheseParametersAvailable($params) { 
    $available = true;
    $missingparams = "";

    foreach ($params as $param) {
        if (!isset($_POST[$param]) || strlen($_POST[$param]) <= 0) {
            $available = false;
            $missingparams = $missingparams . ", " . $param;
        }
    }
    if (!$available) {
        $response = array();
        $response['error'] = true;
        $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
        echo json_encode($response);
        die();
    }
}

$response = array();

if (isset($_GET['api_humedity'])) 
{
    switch ($_GET['api_humedity']) 
    {
        case 'register_humedity':
            isTheseParametersAvailable(array('plant','rango', 'percentage'));
            $db = new DbOperation();
            
            $result = $db->registerhumedity($_POST['plant'], $_POST['rango'], $_POST['percentage']);
       
            if ($result) {
                $response['error'] = false;
                $response['message'] = 'Humedad registrada exitosamente';
                //$response['humedity'] = $db->getHumedity();
            } else {
                $response['error'] = true;
                $response['message'] = 'Ocurrio un error en el registro';
            }

            break;

        case 'get_humedity':
            $db = new DbOperation();
            $response['error'] = false;
            $response['message'] = 'Solicitud completada exitosamente';
            $response['humedad'] = $db->getHumedity();
            break;
        
        case 'get_current_humedity':
            $db = new DbOperation();
            $response['error'] = false;
            $response['message'] = 'Solicitud completada exitosamente';
            $response['current'] = $db->getCurrentHumedity();
            break;

        case 'get_humedity_dates':
            $db = new DbOperation();
            $response['error'] = false;
            $response['message'] = 'Solicitud completada exitosamente';
            $response['humedadates'] = $db->getHumedityDates($_GET['startDate'], $_GET['endDate']);
            break;

        //the UPDATE operation
        case 'updatehero':
            isTheseParametersAvailable(array('id', 'name', 'realname', 'rating', 'teamaffiliation'));
            $db = new DbOperation();
            $result = $db->updateHero(
                    $_POST['id'], $_POST['name'], $_POST['realname'], $_POST['rating'], $_POST['teamaffiliation']
            );

            if ($result) {
                $response['error'] = false;
                $response['message'] = 'Hero updated successfully';
                $response['heroes'] = $db->getHeroes();
            } else {
                $response['error'] = true;
                $response['message'] = 'Some error occurred please try again';
            }
            break;

        //the delete operation
        case 'deletehero':

            //for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
            if (isset($_GET['id'])) {
                $db = new DbOperation();
                if ($db->deleteHero($_GET['id'])) {
                    $response['error'] = false;
                    $response['message'] = 'Hero deleted successfully';
                    $response['heroes'] = $db->getHeroes();
                } else {
                    $response['error'] = true;
                    $response['message'] = 'Some error occurred please try again';
                }
            } else {
                $response['error'] = true;
                $response['message'] = 'Nothing to delete, provide an id please';
            }
            break;
    }
} 
else 
{
    $response['error'] = true;
    $response['message'] = 'Invalido al llamar API';
}
echo json_encode($response);
