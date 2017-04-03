<?php include('../functions.php');?>
<?php include('../login/auth.php');?>
<?php

/********************************/
$api_key = 'Your ZipCodeAPI.com API Key Here';

$userID = get_app_info('main_userID');
$new_list_name = mysqli_real_escape_string($mysqli, $_POST['list_name']);
$app = mysqli_real_escape_string($mysqli, $_POST['app']);
$parent_list = mysqli_real_escape_string($mysqli, $_POST['parent_list_id']);
$zip_code = mysqli_real_escape_string($mysqli, $_POST['zip_code']);
$radius = mysqli_real_escape_string($mysqli, $_POST['distance']);


$time = time();
/********************************/

//add new list
$q = 'INSERT INTO lists (app, userID, name) VALUES ('.$app.', '.$userID.', "'.$new_list_name.'")';
$r = mysqli_query($mysqli, $q);
if ($r)
{
    $listID = mysqli_insert_id($mysqli);
}



// Call upon zipcodeapi.com to get all the lists in that zip code
    $api_call = file_get_contents("https://www.zipcodeapi.com/rest/$api_key/radius.json/$zip_code/$radius/miles?minimal");
			  	    $result = json_decode($api_call,true);
			  	   

// Grab all the users from the parent subscriber list and check the API results against the custom field 
$q = 'SELECT * FROM subscribers WHERE list = '.$parent_list.'';
$r = mysqli_query($mysqli,$q);

if ($r && mysqli_num_rows($r) > 0)
			  	{
			  	    while($row = mysqli_fetch_array($r))
			  	    {
			  	    $name = stripslashes($row['name']);
			  	    $email = stripslashes($row['email']);
			  	    $zip = stripslashes($row['custom_fields']);
                                    //If a zip code from array matches the zip code radius, add user  to the new list.
			  	    if(in_array($zip,$result['zip_codes'])){
			  	    $q3 = 'INSERT INTO subscribers (userID, name, email, list, timestamp) values('.$userID.', "'.$name.'", "'.$email.'", '.$listID.', '.$time.'")';
				$r3 = mysqli_query($mysqli, $q3);
			  	    
			  	    }
			  	
			  	    
			  	    }
			  	    }

//return
header("Location: ".get_app_info('path').'/subscribers?i='.$app.'&l='.$listID); 

?>
