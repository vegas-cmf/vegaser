Vegas CMF 2.0 Project builder
=========================

**vegaser** is a simple tool for building library and project structure based on **Vegas CMF**.

**Available commands**

1. build-project


Requirements
------------
1. PHP >= 5.5
We highly recommend using PHP at least in version 5.5

2. Phalcon extension
The **Vegas CMF** based on the **Phalcon** framework, which works as php extension.
Check [http://docs.phalconphp.com/en/latest/reference/install.html](http://docs.phalconphp.com/en/latest/reference/install.html) for more information.


Building project
----------------
Before you run **vegaser** tool, determine if you are going to create repository for your project.
If so, just clone your repo and enter the directory where you will create new project.

```
mkdir vegas-test
cd vegas-test
```

Download **vegaser** tool using the following link: [https://github.com/vegas-cmf/vegaser/raw/2.0/build/vegaser.phar](https://github.com/vegas-cmf/vegaser/raw/2.0/build/vegaser.phar)
```
wget https://github.com/vegas-cmf/vegaser/raw/2.0/build/vegaser.phar --no-cache
```

Use the following command for start creating new project based on **Vegas CMF**:
```
php vegaser.phar build-project
```

During building the project enter the name of project, eg. vegas-test. You can also provide the your name, email and description of project.

Note. Before you run **build-project** command check your directory permissions.

When the **vegaser** command will be ended successfully, you need to run **composer** from project root directory and install
latest vendors:
```
php composer.phar install
```

Then you can see starter project by starting local php server:
```
php -S 0.0.0.0:8080 -t public/ public/index.php
```
