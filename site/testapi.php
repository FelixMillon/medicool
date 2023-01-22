<?php
require "vendor/autoload.php";
$client = new Google\Client();
$client->setAuthConfig('json\client_secret.json');
$client->addScope(Google\Service\Drive::DRIVE_METADATA_READONLY);
$client->setRedirectUri('http://localhost/oauth2callback.php');
// offline access will give you both an access and refresh token so that
// your app can refresh the access token without user interaction.
$client->setAccessType('offline');
// Using "consent" ensures that your application always receives a refresh token.
// If you are not using offline access, you can omit this.
//$client->setApprovalPrompt('consent');
$client->setIncludeGrantedScopes(true);   // incremental auth

$auth_url = $client->createAuthUrl();

header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));


?>