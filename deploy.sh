DEPLOY_TARGET=./framework.dist
#C:/xampp/htdocs
#./framework.dist

rm -rf $DEPLOY_TARGET
mkdir -p $DEPLOY_TARGET
cp -rf ./framework.src/class $DEPLOY_TARGET/class
cp -rf ./framework.src/config $DEPLOY_TARGET/config
cp -rf ./framework.src/content $DEPLOY_TARGET/content
cp -rf ./framework.src/core $DEPLOY_TARGET/core
cp -rf ./framework.src/custom $DEPLOY_TARGET/custom
cp -rf ./framework.src/model $DEPLOY_TARGET/model
cp -rf ./framework.src/page $DEPLOY_TARGET/page
cp -rf ./framework.src/API.php $DEPLOY_TARGET/API.php
cp -rf ./framework.src/index.php $DEPLOY_TARGET/index.php
cp -rf ./framework.src/robots.txt $DEPLOY_TARGET/robots.txt
cp -rf ./framework.src/.htaccess $DEPLOY_TARGET/.htaccess
