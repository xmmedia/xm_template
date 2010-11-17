#chown templat4 -R *
#chgrp templat4 -R *
#chgrp apache -R uploads
#chgrp apache -R html/uploads
#chgrp apache -R logs
#chgrp apache -R cache
chmod g+w -R uploads
chmod o+w -R uploads
chmod g+w -R html/uploads
chmod o+w -R html/uploads
chmod g+w -R logs
chmod o+w -R logs
chmod g+w -R cache
chmod o+w -R cache
#cd html
#find . -type f -exec chmod 644 {} \;
#find . -type d -exec chmod 755 {} \;
