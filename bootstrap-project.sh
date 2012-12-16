#!/bin/bash

if [ ! -f index.php ]; then

    mkdir -p models assets/{js,img,css} data tests config locales/fr_FR 2>/dev/null

    touch assets/js/app.js
    touch assets/css/app.css
    chmod 777 data

    echo "FallbackResource /index.php" > .htaccess

    cat > index.php << "EOF"
<?php

require 'vendor/PicoTools/Config.php';
require 'vendor/PicoFarad/Router.php';
require 'vendor/PicoFarad/Response.php';
require 'vendor/PicoFarad/Request.php';
require 'vendor/PicoFarad/Session.php';


use PicoFarad\Router;
use PicoFarad\Response;
use PicoFarad\Request;
use PicoFarad\Session;
use PicoTools\Config;

Config::load();

Router\before(function() {

});


Router\get('/', function() {

    Response\text('Hello World');
});

EOF

fi

# update libraries

curl http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css 2>/dev/null > assets/css/bootstrap-responsive.css
curl http://twitter.github.com/bootstrap/assets/css/bootstrap.css 2>/dev/null > assets/css/bootstrap.css
curl http://twitter.github.com/bootstrap/assets/js/bootstrap.js 2>/dev/null > assets/js/bootstrap.js

curl http://code.jquery.com/jquery-1.8.3.min.js 2>/dev/null > assets/js/jquery.min.js
curl http://zeptojs.com/zepto.min.js 2>/dev/null > assets/js/zepto.min.js

curl https://raw.github.com/twitter/bootstrap/master/img/glyphicons-halflings-white.png 2>/dev/null > assets/img/glyphicons-halflings-white.png
curl https://raw.github.com/twitter/bootstrap/master/img/glyphicons-halflings.png 2>/dev/null > assets/img/glyphicons-halflings.png

rm -rf vendor 2>/dev/null
mkdir vendor && cd vendor

#curl https://nodeload.github.com/fguillot/picoTools/tar.gz/master 2>/dev/null | tar -xf - && mv *-master/src/* . && rm -rf *-master
#curl https://nodeload.github.com/fguillot/picoView/tar.gz/master 2>/dev/null | tar -xf - && mv *-master/src/* . && rm -rf *-master
#curl https://nodeload.github.com/fguillot/picoDb/tar.gz/master 2>/dev/null | tar -xf - && mv *-master/lib/* . && rm -rf *-master
curl https://nodeload.github.com/fguillot/simpleValidator/tar.gz/master 2>/dev/null | tar -xf - && mv *-master/src/* . && rm -rf *-master
curl https://nodeload.github.com/fguillot/simpleLogger/tar.gz/master 2>/dev/null | tar -xf - && mv *-master/src/* . && rm -rf *-master
mkdir Markdown && curl https://raw.github.com/michelf/php-markdown/master/markdown.php > Markdown/Markdown.php 2>/dev/null
cp -r ../../../libraries/picoFarad/lib/PicoFarad .
cp -r ../../../libraries/picoDb/lib/PicoDb .
cp -r ../../../libraries/picoTools/src/PicoTools .