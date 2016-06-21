<?php
/**
 * @package     com_hqcblistmailer
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Magnus Hasselquist <magnus.hasselquist@gmail.com> - https://github.com/magnushasselquist
 */
// No direct access
defined('_JEXEC') or die;

function db_field_replace($before_str, $user_id) {
	$db =& JFactory::getDBO();
	// $query = "SELECT * FROM #__comprofiler WHERE id =".$user_id;
	$query = "SELECT * FROM #__users INNER JOIN #__comprofiler ON #__users.id = #__comprofiler.user_id WHERE #__users.id =".$user_id;
	// echo $query;
	$db->setQuery($query);
	$person = $db->loadAssoc();
	$query = "SELECT name FROM #__comprofiler_fields";
	$db->setQuery($query);
	$fields = $db->loadAssocList();
	$after_str = $before_str;
	// echo $before_str;
	if (!empty($fields)){
		foreach ($fields as $field) { //for every field that may be in the before_str
			$paramtofind = "[".$field['name']."]";
			$fieldtouse = $field['name'];
			$datatoinsert = $person[$fieldtouse];
		 	$after_str = str_ireplace($paramtofind, $datatoinsert, $after_str);
			};
		}
	return $after_str;
}

require '../libraries/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

$db =& JFactory::getDBO();
$user = JFactory::getUser();
$template_id = $_GET["template_id"];
$action = $_GET["action"];
echo "<h1>Email sender</h1>";

$query = "select * from #__hqcblistmailer_emails WHERE state = 1";
$db->setQuery($query);
$templates = $db->loadAssocList();
if (!empty($templates)){
	echo "<h2>1. Select template</h2>";
	foreach ($templates as $template) { //for every email that is ready to be sent..
      		$email_id = $template['id'];
      		$email_subject = $template['emailsubject'];
      		echo "<a href='index.php?option=com_hqcblistmailer&view=emailsenders&template_id=".$email_id."'>".$email_subject."</a><br/>";
      	}
}

if ($template_id <>"") {
	$query = "select * from #__hqcblistmailer_emails WHERE state = 1 AND id = ".$template_id;
	// echo $query;
	$db->setQuery($query);
	$template = $db->loadAssoc();
	if (!empty($template)){
		echo "<h2>2. Preview</h2>";
		$email_id = $template['id'];
		$email_subject = $template['emailsubject'];
		$email_to_field = $template['emailtofield'];
		$email_to_name_field = $template['emailtonamefield'];
		$email_cc1 = $template['emailccfield1'];
		$email_cc2 = $template['emailccfield2'];
		$email_cc3 = $template['emailccfield3'];
		$email_body = $template['emailbody'];
		$email_sendername = $template['emailsendername'];
		$email_sender = $template['emailsender'];
		$email_cb_list_id = $template['emailcblist'];


		$query = "select params from #__comprofiler_lists WHERE listid = ".$email_cb_list_id;
		// echo $query;
		$db->setQuery($query);
		// rensa upp urlencodningen och trimma bort a och paranteser
		//$select_sql = '';
		//$select_sql = substr(urldecode($db->loadResult()), 2, -1);
		$select_sql = $db->loadResult();

		$json_a=json_decode($select_sql,true);
		$select_sql = ""; //reset before re-creating it
		
    		$filters_basic = $json_a['filter_basic'];
    		$filter_advanced = $json_a['filter_advanced'];
    		if ($filters_basic <>'') {
       		      foreach($filters_basic as $filter) {
              		       $select_sql .= $filter['column'] . " " . $filter['operator']. " '" . $filter['value'] ."' OR ";
            		 }
           		  $select_sql = substr($select_sql, 0, -4); //rensa bort den sista OR
     		}
    		  if ($filter_advanced <> '') {
       			$select_sql = $filter_advanced;
    		}

		$userlistorder = $json_a['sort_basic'][0]['column'] . " " . $json_a['sort_basic'][0]['direction'];
		//echo "<br/><br/>ORDER: " . $userlistorder .".";
		//echo "<br/><br/>DEC :".$select_sql .":";


		// satt bas-sql for att koppla samman anvandare falt och listor
		$fetch_sql = "select * from #__users inner join #__comprofiler on #__users.id = #__comprofiler.user_id where #__users.block = 0 ";
		// lagg till having endast om det finns ett filter for att hantera standardlistan som inte har ngt filter
		if ($select_sql <>'') $fetch_sql = $fetch_sql . "having " . $select_sql;
		// skriv ut kompilerad sql for debug
		// echo $fetch_sql . "<br>";
		// echo "Email recievers sql: ".$email_recievers_sql; //debug only

		echo "<b>Subject: </b>".$email_subject."<br /><br/>";
		echo "<b>Body: </b><br/><div style='border: 2px black solid; padding: 10px; background-color:white; width:500px;'>".$email_body."</div><br />";

		$query = $fetch_sql;
		$db->setQuery($query);
		$persons = $db->loadAssocList();
		if (!empty($persons)){
			echo "<b>Recievers: </b>".count($persons)."<br/>";

			echo "<h2>3. Skicka</h2>";
			echo "<a href='index.php?option=com_hqcblistmailer&view=emailsenders&template_id=".$email_id."&action=send_own'>Send test email to yourself</a><br/><br/>";
			echo "<a href='index.php?option=com_hqcblistmailer&view=emailsenders&template_id=".$email_id."&action=send'>Send email to all reciepents</a><br/>";


			if ($action == "send_own") { //send a test email to the user henself
				$mail = new PHPMailer;
				$mail->CharSet = 'UTF-8';
				$mail->From = $email_sender;
				$mail->FromName = $email_sendername;
				$mail->isHTML(true);

				$mail->Subject = db_field_replace($email_subject, $user->id);
				$mail->Body = db_field_replace($email_body, $user->id);

				$mail->addAddress($user->email);

				if ($mail->send()) {
				 echo('OK till dig själv');
				 } else {
				 echo('ERROR: '. $mail->ErrorInfo);
				 }
			}
			if ($action == "send") { //ok, send all emails

				foreach ($persons as $person) { //for every person that is a reciever, lets do an email.
				 	$mail = new PHPMailer;
				 	$mail->CharSet = 'UTF-8';
					$mail->From = $email_sender;
					$mail->FromName = $email_sendername;
					$mail->isHTML(true);

				 	$mail->addAddress ($person[$email_to_field], $person[$email_to_name_field]);

					if (! empty($person[$email_cc1])) {
						$mail->addCC($person[$email_cc1]);
					}
					if (! empty($person[$email_cc2])) {
						$mail->addCC($person[$email_cc2]);
					}
					if (! empty($person[$email_cc3])) {
						$mail->addCC($person[$email_cc3]);
					}

				    $mail->Subject = db_field_replace($email_subject, $person['id']);
					$mail->Body = db_field_replace($email_body, $person['id']);

					if ($mail->send()) {
					 echo('OK<br/>');
					 } else {
				 	 echo('ERROR: '. $mail->ErrorInfo);
					 }
				}
			}
		}
	}
}
?>
