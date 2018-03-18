# Brute Force Monster
A simple php library that monitors login and watches how frequent a particuler user tries to login and uses that logic to know if it is a bruteforce attack and lets you know if it is so you can stop the login attempt.
More updates to come

Load the php library

pass the email to brutemonster
$this->brutemonster->check($user_email);

get the response as a bool variable
$check = $this->brutemonster->check($user_email);

$check is either true or false

so you can stop the attack by redirecting the user somewhere else or black list the users IP address