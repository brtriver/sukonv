#!/bin/sh

## copy tmp directory from lithium/core
cp -pr lithium/app/resources/tmp app/resources
## change permission to 0777 to be writable
sudo chmod -R 0777 app/resources
