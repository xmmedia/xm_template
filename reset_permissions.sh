sudo chown templat4 -R *
sudo chgrp templat4 -R *
sudo chgrp apache -R uploads
sudo chgrp apache -R html/uploads
sudo chgrp apache -R sessions
sudo chgrp apache -R logs
sudo chgrp apache -R cache
chmod g+w -R uploads
chmod g+w -R html/uploads
chmod g+w -R sessions
chmod g+w -R logs
chmod g+w -R cache
cd html
sudo find . -type f -exec chmod 644 {} \;
sudo find . -type d -exec chmod 755 {} \;
