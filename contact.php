<?php
// PHOENIX_WEB contact form handler. Проверить работу mail() на хостинге R01 после загрузки.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method Not Allowed'); }
function clean($v){ return trim(strip_tags((string)$v)); }
$name = clean($_POST['name'] ?? '');
$phone = clean($_POST['phone'] ?? '');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$message = clean($_POST['message'] ?? '');
$agree = isset($_POST['agree']);
$honeypot = trim($_POST['website'] ?? '');
if ($honeypot !== '') { http_response_code(200); exit('OK'); }
if (!$agree || $name==='' || $phone==='' || $message==='' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400); exit('Проверьте заполнение формы.');
}
$to = 'info@fenix.moscow';
$subject = 'Заявка с сайта fenix.moscow';
$body = "Новая заявка с сайта fenix.moscow\n\nИмя: {$name}\nТелефон: {$phone}\nE-mail: {$email}\n\nСообщение:\n{$message}\n";
$headers = "From: site@fenix.moscow\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8\r\n";
$sent = mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $body, $headers);
if ($sent) { header('Location: /?sent=1#contact'); exit; }
http_response_code(500); echo 'Не удалось отправить сообщение. Попробуйте связаться по e-mail: info@fenix.moscow';
