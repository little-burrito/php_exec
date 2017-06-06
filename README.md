# php_exec
An incredibly insecure web implementation of theHarvester, which is great for finding e-mail addresses when the websites are too unclear to navigate.

Create a file called password.php and assign a string value to $password to set your password.

Most of the work lies in setting up the www-data permissions so that it can only run this one script, and so that it can only edit files in its own folders. I haven't implemented any sanity checks anywhere, and the password is sent in both directions over plain text (and in my case http). So yeah, it's ready to be published! /s