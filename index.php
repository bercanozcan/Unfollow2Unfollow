<?php 
/**
 * Unfollow2Unfollow
 * Bercan Özcan
 * bercanozcan.com
 * bercanozcan@gmail.com
 */
 
include "twitteroauth/twitteroauth.php";
 
$consumer_key = "...";
$consumer_secret = "...";
$access_token = "...";
$access_token_secret = "...";
 
$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
 
$unfollowusers = $twitter->get('https://api.twitter.com/1.1/friendships/outgoing.json');
$users = array();
foreach ($unfollowusers->ids as $key => $uID) {
	$whois = $twitter->get('https://api.twitter.com/1.1/users/show.json?user_id='.$uID);
	$twitter->post('https://api.twitter.com/1.1/friendships/destroy.json?user_id='.$uID);
	array_push($users,$whois);
}
 
foreach ($users as $ky => $u) {
	echo 'User Name: <strong>'.$u->name.'</strong> Profile Image: <strong>'.$u->profile_image_url.'</strong><br />';
} 

?>
