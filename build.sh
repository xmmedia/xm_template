#!/bin/bash
# creates and minified production JS and CSS files

echo "Creating html/css/production.min.css"
cat html/css/1140.css html/css/normalize.css html/cl4/css/cl4.css html/css/base.css > html/css/production.css
java -jar /usr/local/bin/yuicompressor-2.4.6.jar html/css/production.css -o html/css/production.min.css --line-break 8000
rm html/css/production.css

echo "Creating html/css/public.min.css"
cat html/css/1140.css html/css/normalize.css html/cl4/css/cl4.css html/css/base.css html/css/public.css > html/css/public_temp.css
java -jar /usr/local/bin/yuicompressor-2.4.6.jar html/css/public_temp.css -o html/css/public.min.css --line-break 8000
rm html/css/public_temp.css

echo "Creating html/js/production.min.js"
cat html/cl4/js/cl4.js html/cl4/js/ajax.js html/js/base.js > html/js/production.js
java -jar /usr/local/bin/yuicompressor-2.4.6.jar html/js/production.js -o html/js/production.min.js --line-break 8000
rm html/js/production.js

exit 0