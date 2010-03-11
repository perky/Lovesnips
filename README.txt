LOVESNIPS SOURCE.
README.

Take a look at the messy code if your interested
or you can install your own version to your own server if you want.

Here's how:

You'll need a server with PHP and MYSQL.
Import the 3 zipped sql files inside "SQL Structure" folder to you
MySQL server.
"SQL Structures->catagories.sql.zip"
"SQL Structures->lovesnips.sql.zip"
"SQL Structures->loveusers.sql.zip"

"Categories" table is where is where you add categories for the snips.
"Lovesnips" table is where all the snip code and descriptions are stored.
"Loveusers" table is where the user information is stored.
NOTE: Passwords are stored in plaintext, if you want a more secure system
I recommend implementing a hash password system.

These tables contain no data, so you'll have to add the categories yourself.

Then update "Connections->LoveSQL.php"
with your MySQL host, username, password.

The "snips" folder has all the lua snippets from my site, these aren't
stored inside "SQL Structures->lovesnips.sql.zip" though so they won't show
up when you upload.


License:

There isn't one really. Do what the fuck you want with it, commercially or personally.
You can even claim you made it and see if people believe you. 
(I wouldn't recommend that though)