<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group("auth", ["filter" => "noauth"], static function ($routes) {
    $routes->get("register", "Auth\RegisterController::index");
    $routes->post("register", "Auth\RegisterController::store");

    $routes->get("login", "Auth\LoginController::index");
    $routes->post("login", "Auth\LoginController::login");

    $routes->get("verify-otp", "Auth\VerifyController::verifyOTP");
    $routes->post("verify-otp", "Auth\VerifyController::checkVerifyOTP");

    $routes->get("forgot-password", "Auth\ForgotPasswordController::index");
    $routes->post("send-reset-link", "Auth\ForgotPasswordController::sendResetPasswordLink");
    $routes->get("forgot-password-sent", "Auth\ForgotPasswordController::resetLinkSent");
    $routes->get("reset-password", "Auth\ForgotPasswordController::resetPassword");
    $routes->post("reset-password", "Auth\ForgotPasswordController::updateResetPassword");
});

$routes->group("mypanel", ["filter" => "auth"], static function ($routes) {
    $routes->get("logout", "Auth\LoginController::logout");
    $routes->get("dashboard", "DashboardController::index");

    // Routes Profile
    $routes->group("profile", static function ($routes) {
        $routes->get("/", "ProfileController::index");
        $routes->post("update", "ProfileController::update");

        $routes->put("update-password", "Auth\UpdatePasswordController::updatePassword");
    });

    // Routes Transaction
    $routes->group("transaction", static function ($routes) {
        $routes->get("/", "TransactionController::index");
        $routes->get("payment-method", "TransactionController::getPaymentMethods");
        $routes->post("topup", "TransactionController::createTopup");
        $routes->get("topup-instruction", "TransactionController::topupInstruction");
        $routes->get('check-topup', 'TransactionController::checkTopupStatus');
    });

    // Routes user
    $routes->get('check-user-phone', 'UserController::checkUserPhone');

    // Routes Send
    $routes->group("send", static function ($routes) {
        $routes->get("/", "SendController::index");
        $routes->post("add-recipient", "SendController::addRecipient");
        $routes->post("send-money", "SendController::sendMoney");
    });

    // Routes Receive
    $routes->group("receive", static function ($routes) {
        $routes->get("/", "ReceiveController::index");
    });
    
    $routes->group("settings", static function ($routes) {
        $routes->get("/", "SettingsController::index");
        $routes->post("update-bank", "SettingsController::updateBank");
        $routes->post("add-category", "SettingsController::addCategory");
    });

    $routes->get('csrf-token', 'Auth\CsrfController::getToken');

});

$routes->post('/callback-tokopay', 'TokopayCallbackController::handle');
$routes->get("/", "Home::index");
    