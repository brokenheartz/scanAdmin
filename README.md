# scanAdmin
Admin Login Finder

Is a tool for discovering admin login page with dictionary attack techniques.
It can bypass fooling request, in which sometimes website give not found page with 200 http status code.
a lot of tools usually only check a http status code without check the page itself. But this tool is designed for checking
http status code and source code of the page with a fews pattern.

This tool is free to recode and learn for those who wanna check how secure the admin login page is.

# how to install?

Just " git clone https://github.com/brokenheartz/scanAdmin.git ".
then there'll be scanAdmin directory.

# how to use?

Just " php find.php <url_site> <time_out> ".
For example : php find.php http://target.com 0.5

Hopefully usefull ..
