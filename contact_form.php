<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <h1>Contact Us</h1>

        <?php if (isset($_SESSION['status'])): ?>
            <p><?= $_SESSION['status'] ?></p>
            <?php unset($_SESSION['status']); ?>
        <?php endif; ?>

        <form id="contactForm" method="post" action="send_email.php">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= $_SESSION['form_data']['name'] ?? '' ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $_SESSION['form_data']['email'] ?? '' ?>" required>

            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" value="<?= $_SESSION['form_data']['subject'] ?? '' ?>" required>

            <label for="message">Message</label>
            <textarea name="message" id="message" required><?= $_SESSION['form_data']['message'] ?? '' ?></textarea>

            <br>
            <button type="submit">Send</button>
        </form>
    </div>
    
    <script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!email.match(emailPattern)) {
            alert('Please enter a valid email address.');
            document.getElementById('email').focus();
            e.preventDefault();
            return;
        }

        if (message.length < 10) {
            alert('Message must be at least 10 characters long.');
            document.getElementById('message').focus();
            e.preventDefault();
        }
    });
    </script>
</body>
</html>