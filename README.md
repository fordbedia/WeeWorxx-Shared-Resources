### Dump Your DB Structure (No Data)

####IMPORTANT: Please run this command in your root directory of your host working directory.
Eg: ~/Sites/weeworxx:

```shell
ls -al
```
inside your directory should look like this:

- README.md
- /backend
- /docker
- docker-compose.yml
- etc...

```shell
docker-compose exec mysql \
  mysqldump -uweeworx_user -pw33w0rxx123 \
  --no-data --skip-comments --no-tablespaces weeworx \
  > backend/shared-resources/src/TestCase/sqldumps/weeworx.sql
```

or

```shell
( docker-compose exec mysql \
  mysqldump -uweeworx_user -pw33w0rxx123 \
  --no-data --no-tablespaces --skip-comments weeworx \
  | grep -v "mysqldump: \[Warning\] Using a password on the command line interface can be insecure." \
  > backend/shared-resources/src/TestCase/sqldumps/weeworx.sql ) 2>/dev/null

```

#### In order to run your test suites:

```shell
docker-compose exec app /bash/sh
cd ../shared-resources
./vendor/bin/phpunit
```

or if you want to test specific test file:

```shell
docker-compose exec app /bash/sh
cd ../shared-resources
./vendor/bin/phpunit --filter=PostTest
```
