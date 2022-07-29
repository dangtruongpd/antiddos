<?php

use Facebook\Facebook;

$fb = new Facebook([
    'app_id' => '1123723428213481', // Replace {app-id} with your app id
    'app_secret' => '470e8a382d8e23f5380da48b015fff9a',
    'default_graph_version' => 'v14.0',
]);

// $helper = $fb->getRedirectLoginHelper();

// $permissions = ['email']; // Optional permissions
// $loginUrl = $helper->getLoginUrl('http://topic2.local', $permissions);

// echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get(
      '/{person-id}/',
      '{access-token}'
    );
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $graphNode = $response->getGraphNode();
