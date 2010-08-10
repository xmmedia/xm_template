sudo chown trialto -R *
sudo chgrp trialto -R *
sudo chgrp apache -R uploads
sudo chgrp apache -R sessions
sudo chgrp apache -R logs
sudo chgrp apache -R application/cache
sudo chgrp apache -R application/logs
chmod g+w -R uploads
chmod g+w -R sessions
chmod g+w -R logs
chmod g+w -R application/cache
chmod g+w -R application/logs
cd html
sudo find . -type f -exec chmod 644 {} \;
sudo find . -type d -exec chmod 755 {} \;