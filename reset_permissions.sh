chgrp template -R *
chmod g+w -R uploads
chmod o+w -R uploads
chmod g+w -R html/uploads
chmod o+w -R html/uploads
chmod g+w -R logs
chmod o+w -R logs
chmod g+w -R cache
chmod o+w -R cache
find . -type d ! -iname 'iworx-backup' -exec chmod g+s {} \;