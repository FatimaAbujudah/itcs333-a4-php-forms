<?php
declare(strict_types=1);

/**
 * ITCS333 A4 starter — contact form.
 * Requirements (see README rubric):
 *   - GET: render the form
 *   - POST: validate name (required, 2-60 chars), email (valid), message (required, 10-1000 chars)
 *   - invalid POST: re-render with inline errors + repopulated fields (200)
 *   - valid POST: redirect (302/303) to a success page (PRG)
 *   - escape all output with htmlspecialchars
 */

require_once __DIR__ . '/../src/validate.php';

// TODO: implement the form handling here.

$name= '' ;
$email='';
$message='';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $flag = true;
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  if (!validate_required($name) || !validate_length($name, 2, 60)){
    $flag = false;
    $errors['name'] = 'the name field is empty or no valid length has been entered ';
  }

if (!validate_email($email)){
    $flag = false;
    $errors['email'] = 'the email isnt valid ';
}

if (!validate_required($message) || !validate_length($message, 10, 1000)){
    $flag = false;
    $errors['message'] = 'the message field is empty or no valid length has been entered ';
}
if ($flag)
  header('Location: success.php');
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
</head>
<body>
  <h1>Contact Us</h1>
  <!-- TODO: render the form, inline errors, and repopulated values -->
  <form method="post" action="index.php">
    <label>Name <input type="text" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"></label><br>
    <?php if (isset($errors['name'])): ?>
        <div><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <label>Email <input type="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"></label><br>
    <?php if (isset($errors['email'])): ?>
        <div><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <label>Message <textarea name="message"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea></label><br>
    <?php if (isset($errors['message'])): ?>
        <div><?= htmlspecialchars($errors['message'], ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
    <button type="submit">Send</button>
  </form>
</body>
</html>
<?php


