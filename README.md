Vegas CMF Project/Library builder
=========================

**vegaser** is a simple tool for building library and project structure based on **Vegas CMF**.

**Available commands**

1. build-project
2. build-library


Requirements
------------
1. PHP >= 5.4
We highly recommend using PHP at least in version 5.4

2. Phalcon extension
The **Vegas CMF** based on the **Phalcon** framework (in version 1.3), which works as php extension.
Check [http://docs.phalconphp.com/en/latest/reference/install.html](http://docs.phalconphp.com/en/latest/reference/install.html) for more information.

3. Phing
To start using **vegaser** tool you have to install **Phing** tool in your system.

To check if **Phing** is already installed, just type command in console:
```
$> phing
```

You can simply install it, using **PEAR installer** :
```
$> pear channel-discover pear.phing.info
$> pear install phing/phing
```

Check [http://www.phing.info/docs/guide/trunk/ch03s03.html](http://www.phing.info/docs/guide/trunk/ch03s03.html) for more information.


Building project
----------------
Before you run **vegaser** tool, determine if you are going to create repository for your project.
If so, just clone your repo and enter the directory where you will create new project.

```
mkdir vegas-test
cd vegas-test
```

Download **vegaser** tool using the following link: [https://github.com/vegas-cmf/vegaser/raw/1.1/build/vegaser.phar](https://github.com/vegas-cmf/vegaser/raw/1.1/build/vegaser.phar)
```
wget https://github.com/vegas-cmf/vegaser/raw/1.1/build/vegaser.phar --no-cache
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


Building library
----------------
Before you run **vegaser** tool, determine if you are going to create repository for your **Vegas CMF** library.

If so, just clone your repo and enter the directory where you will create new library.
```
mkdir vegas-test
cd vegas-test
```

Download **vegaser** tool using the following link: [https://github.com/vegas-cmf/vegaser/raw/1.1/build/vegaser.phar](https://github.com/vegas-cmf/vegaser/raw/1.1/build/vegaser.phar)
```
wget https://github.com/vegas-cmf/vegaser/raw/1.1/build/vegaser.phar --no-cache
```

Use the following command for start creating new library for **Vegas CMF**:
```
php vegaser.phar build-library
```

During building the library structure enter the name of library, eg. vegas-cmf/foo and the namespace where your library will be situated in the Vegas, eg. **Vegas\\\Foo\\\\** (pay attention on the double backslashes). You can also provide the your name, email and description of library.

Note. Before you run **build-library** command check your directory permissions.

When the **vegaser** command will be ended successfully, then you can run tests using the following command:
```
./vendor/bin/phpunit
```

The source code of your library should be placed within **src** directory, eg. ./src/Foo/Bar.php.

The tests should be placed within **tests** directory, eg. ./tests/Foo/BarTest.php