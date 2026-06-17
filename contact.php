<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method Not Allowed'); }
if (!empty($_POST['website'])) { http_response_code(200); exit('OK'); }
$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$agree = isset($_POST['agree']);
if (!$name || !$phone || !$email || !$message || !$agree || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400); exit('Заполните форму корректно.');
}
$to = 'info@fenix.moscow';
$subject = 'Заявка с сайта fenix.moscow';
$body = "Новая заявка с сайта fenix.moscow\n\nИмя: {$name}\nТелефон: {$phone}\nE-mail: {$email}\n\nСообщение:\n{$message}\n";
$headers = "From: no-reply@fenix.moscow\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8\r\n";
$ok = mail($to, $subject, $body, $headers);
if ($ok) { echo 'Спасибо. Заявка отправлена.'; } else { http_response_code(500); echo 'Ошибка отправки. Пожалуйста, напишите на info@fenix.moscow'; }
?>
