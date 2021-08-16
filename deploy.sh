DEPLOY_TARGET=C:/xampp/htdocs
#C:/xampp/htdocs
#./framework.dist
#/opt/lampp/htdocs/

rm -rf $DEPLOY_TARGET
mkdir -p $DEPLOY_TARGET
cp -rf ./framework.src/class $DEPLOY_TARGET/class
cp -rf ./framework.src/config $DEPLOY_TARGET/config
cp -rf ./framework.src/content $DEPLOY_TARGET/content
cp -rf ./framework.src/core $DEPLOY_TARGET/core
cp -rf ./framework.src/custom $DEPLOY_TARGET/custom
cp -rf ./framework.src/model $DEPLOY_TARGET/model
cp -rf ./framework.src/API.php $DEPLOY_TARGET/API.php
cp -rf ./framework.src/robots.txt $DEPLOY_TARGET/robots.txt
cp -rf ./framework.src/.htaccess $DEPLOY_TARGET/.htaccess

echo "done"