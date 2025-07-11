### Dump Your DB Structure (No Data)

```shell
docker-compose exec mysql \
  mysqldump -uweeworx_user -pw33w0rxx123 \
  --no-data --skip-comments weeworx \
  > backend/shared-resources/TestCase/sqldumps/weeworx.sql
```
