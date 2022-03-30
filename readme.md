
## Entity mapping
```phpregexp
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="order", schema="dummy_schema")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
}

```

## 1. Start PostgreSQL database
```bash
$ docker run --rm --name doctrine2-bug-postgres -p 127.0.0.1:5432:5432 -e POSTGRES_PASSWORD=mysecretpassword postgres:13-alpine
```

## 2. Update schema
```bash
$ vendor/bin/doctrine orm:schema-tool:update --dump-sql --force

 The following SQL statements will be executed:

     CREATE SCHEMA dummy_schema;
     CREATE SEQUENCE dummy_schema.order_id_seq INCREMENT BY 1 MINVALUE 1 START 1;
     CREATE TABLE dummy_schema."order" (id INT NOT NULL, PRIMARY KEY(id));

 Updating database schema...

     3 queries were executed


 [OK] Database schema updated successfully!
 ```

## 3. Update schema again
```bash
$ vendor/bin/doctrine orm:schema-tool:update --dump-sql --force

 The following SQL statements will be executed:

     CREATE TABLE dummy_schema."order" (id INT NOT NULL, PRIMARY KEY(id));

 Updating database schema...


In ExceptionConverter.php line 78:

  An exception occurred while executing a query: SQLSTATE[42P07]: Duplicate table: 7 ERROR:  relation "order" already exists


In Exception.php line 30:

  SQLSTATE[42P07]: Duplicate table: 7 ERROR:  relation "order" already exists


In Connection.php line 72:

  SQLSTATE[42P07]: Duplicate table: 7 ERROR:  relation "order" already exists


orm:schema-tool:update [--em EM] [--complete] [--dump-sql] [-f|--force]
```