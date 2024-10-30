<?php
require_once '../includes/auth.php';

// Check if the user is logged in and is a user
if (!isLoggedIn() || getUserRole() !== 'user') {
    header("Location: ../pages/index.php");
    exit();
}

// Initialize task variables
$taskCompleted = false;
$correctPhishingEmails = ['email3', 'email5', 'email7']; // Keys of phishing emails
$completionCode = rand(1000000, 9999999); // Generate a random completion code

// Function to generate a random link
function generateRandomLink($isPhishing = false) {
    $domain = $isPhishing ? 'capgimini.com' : 'capgemini.com';
    return 'https://www.' . bin2hex(random_bytes(4)) . '.' . $domain;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedEmails = $_POST['emails'] ?? [];
    
    // Check if the correct phishing emails are selected
    if (count(array_intersect($correctPhishingEmails, $selectedEmails)) === count($correctPhishingEmails) && count($selectedEmails) === count($correctPhishingEmails)) {
        // Mark task as completed by storing the completion code in session
        $_SESSION['task6_completed'] = $completionCode;
        $taskCompleted = true;

        // Redirect back to dashboard after completion
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Incorrect selection. Please try again!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 6 - Identify Phishing Emails</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #FAF7F0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            padding: 20px;
            overflow: auto;
        }
        .container {
            max-width: 800px;
            width: 100%;
            padding: 30px;
            background-color: #F2EED7;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.6);
            text-align: center;
            overflow: hidden;
        }
        h1 {
            color: #4A4947;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .error {
            color: #dc3545;
            margin-bottom: 20px;
            font-size: 1.1em;
        }
        form {
            margin-top: 20px;
            text-align: left;
            max-height: 70vh;
            overflow-y: auto;
        }
        .email-option {
            margin: 10px 0;
            padding: 10px;
            border: 2px solid #007bff;
            border-radius: 5px;
            background-color: #fff;
            transition: background-color 0.3s;
            overflow-wrap: break-word;
        }
        .email-option:hover {
            background-color: #e0f7fa;
        }
        button {
            background-color: #4A4947;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            width: 30%;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Task 6: Identify Phishing Emails</h1>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <p>Select all phishing emails:</p>

            <?php
            // Sample emails (3 phishing and 7 safe)
            $emails = [
                'email1' => [
                    'from' => 'updates@capgemini.com',
                    'subject' => 'Capgemini Update: Team Outing',
                    'body' => "Hi Team,\n\nWe are planning a team outing. Please reply with your availability.\n\nThanks,\nHR Team"
                ],
                'email2' => [
                    'from' => 'info@capgemini.com',
                    'subject' => 'Reminder: Training Session Next Week',
                    'body' => "Dear Employee,\n\nJust a reminder about the training session scheduled for next week. Let us know if you have any questions.\n\nBest,\nTraining Department"
                ],
                'email3' => [
                    'from' => 'security@capgimini.com', // Phishing
                    'subject' => 'IMPORTANT: Verify Your Account Immediately!',
                    'body' => "Dear User,\n\nYour account may be compromised. Click the link below to verify your information immediately: " . generateRandomLink(true) . ". Failure to comply will lead to account suspension.\n\nThank you,\nCapgimini Security"
                ],
                'email4' => [
                    'from' => 'newsletter@capgemini.com',
                    'subject' => 'Capgemini Monthly Newsletter',
                    'body' => "Hello Team,\n\nCheck out our latest updates and events for this month in the newsletter attached!\n\nCheers,\nCapgemini Communications"
                ],
                'email5' => [
                    'from' => 'alert@capgemini.com', // Phishing
                    'subject' => 'Action Required: Unusual Activity Detected',
                    'body' => "Dear Employee,\n\nWe detected unusual activity on your account. Please confirm your identity using the link: " . generateRandomLink(true) . ". This is urgent to secure your account.\n\nRegards,\nCapgemini IT"
                ],
                'email6' => [
                    'from' => 'events@capgemini.com',
                    'subject' => 'Invitation: Capgemini Annual Event',
                    'body' => "Dear Team,\n\nWe are excited to invite you to our Annual Event! Join us for a day of learning and networking. Register here: " . generateRandomLink() . ".\n\nBest,\nCapgemini Events"
                ],
                'email7' => [
                    'from' => 'no-reply@capgimini.com', // Phishing
                    'subject' => 'Urgent: Password Reset Required',
                    'body' => "Dear User,\n\nYour password has been compromised. Click this link to reset it now: " . generateRandomLink(true) . ". It is essential to protect your account.\n\nThank you,\nCapgimini Support"
                ],
                'email8' => [
                    'from' => 'offers@capgemini.com',
                    'subject' => 'Congratulations! Exclusive Offers for You',
                    'body' => "Dear Employee,\n\nYou have exclusive offers waiting for you! Check your employee portal for details: " . generateRandomLink() . ".\n\nBest,\nCapgemini Promotions"
                ],
                'email9' => [
                    'from' => 'updates@capgemini.com',
                    'subject' => 'New Features Available for Employees',
                    'body' => "Hi Team,\n\nWe have released new features on the employee portal. Log in to explore these enhancements!\n\nBest regards,\nCapgemini Development Team"
                ],
                'email10' => [
                    'from' => 'reminder@capgemini.com',
                    'subject' => 'Your Subscription is About to Expire',
                    'body' => "Dear Customer,\n\nThis is a reminder that your subscription is expiring soon. Please renew it to continue enjoying our services: " . generateRandomLink() . ".\n\nThank you,\nCapgemini Customer Service"
                ]
            ];

            foreach ($emails as $key => $email) {
                echo '<div class="email-option">';
                echo '<input type="checkbox" name="emails[]" value="' . $key . '" id="' . $key . '">';
                echo '<label for="' . $key . '"><strong>From:</strong> ' . htmlspecialchars($email['from']) . '<br>';
                echo '<strong>Subject:</strong> ' . htmlspecialchars($email['subject']) . '<br>';
                echo '<strong>Body:</strong><br>' . nl2br(htmlspecialchars($email['body'])) . '</label>';
                echo '</div>';
            }
            ?>
            <button type="submit">Submit</button>
        </form>
    </div>

</body>
</html>
