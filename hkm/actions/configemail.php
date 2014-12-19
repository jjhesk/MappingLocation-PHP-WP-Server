<?php
/**
 * Configuration of Email
 * Created by PhpStorm.
 * User: Hesk
 * Date: 14年5月15日
 * Time: 上午11:23
 */
// Prevent loading this file directly
defined('ABSPATH') || exit ;

add_action('phpmailer_init', 'wpse8170_phpmailer_init');
function wpse8170_phpmailer_init(PHPMailer $phpmailer)
{
   // $phpmailer->FromName = 'OneCall'; //string
   // $phpmailer->Sender = 'admin@onecallapp.com'; //reply to -email Sets the Sender email (Return-Path) of the message
    $phpmailer->From = 'cs@imusictech.com'; //email
  //  $phpmailer->Hostname = 'onecall.com'; //domain


    $phpmailer->Host = 'smtp.imusictech.com';
    $phpmailer->Port = 25; // could be different
    $phpmailer->Username = 'cs@imusictech.com'; // if required
    $phpmailer->Password = 'cs12345!'; // if required
    $phpmailer->SMTPAuth = true; // if required
   // $phpmailer->SMTPSecure = ''; // enable if required, 'tls' is another possible value
  //  $phpmailer->Debugoutput = 'error_log';
    $phpmailer->IsSMTP();
}

?>