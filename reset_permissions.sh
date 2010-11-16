chown templat4 -R *
chgrp templat4 -R *
chgrp apache -R uploads
chgrp apache -R html/uploads
chgrp apache -R sessions
chgrp apache -R logs
chgrp apache -R cache
chmod g+w -R uploads
chmod g+w -R html/uploads
chmod g+w -R sessions
chmod g+w -R logs
chmod g+w -R cache
cd html
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
