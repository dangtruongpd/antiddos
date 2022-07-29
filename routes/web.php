<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'HomeController@home')->name('home');

Route::post('/update-config', 'HomeController@updateConfig')->name('update-config');

Route::get('/captcha', 'ReCaptchaController@showCaptcha')->name('captcha.show');

Route::post('/captcha', 'ReCaptchaController@captcha')->name('captcha.check');

Route::prefix('/bot')->group(function () {

    Route::get('cache-bot-ip-list', 'GetBotIpController@index');
    Route::get('get-bot-ip-list', 'GetBotIpController@getBotIpList');
    Route::get('delete-bot-ip-list', 'GetBotIpController@deleteBotIpList');

});

Route::get('/login', 'LoginController@login')->name('login');
Route::get('/cb', function () {
    $fb = new Facebook\Facebook([
        'app_id' => '{app-id}',
        'app_secret' => '{app-secret}',
        'default_graph_version' => 'v2.9',
    ]);
    $helper = $fb->getRedirectLoginHelper();
    try {
        $accessToken = $helper->getAccessToken();
        $response = $fb->get('/me?fields=id,name,email', $accessToken);
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    if (!isset($accessToken)) {
        if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
        } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
        }
        exit;
    }
// Logged in
    $me = $response->getGraphUser();
    echo 'Logged in as: ' . $me->getName();
    echo 'ID:' . $me->getId();
    echo 'Email:' . $me->getEmail();
    $_SESSION['fb_access_token'] = (string) $accessToken;
// Từ đây bạn xử lý kiểm tra thông tin user trong database sau đó xử lý.
});
