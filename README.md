# company

Final project for COMP353 - Databases

## Running

1. Start docker container running xampp with a volume mapped to `./company/`.

```
$ ./script/run.sh
```

2. Concatenate all sql files from `./database/` into a single file which creates tables and seeds initial data.

```
$ ./script/generate.sh
```

3. Navigate to phpmyadmin (http://localhost:41062/phpmyadmin/) and create a new database.

4. Navigate to new database and run generated sql.

5. Rename `./company/config.php.example` to `./company/config.php` and edit configuration as required.

6. Navigate to homepage (http://localhost:41062/www/)

## Screenshots

![Screenshot1](https://camo.githubusercontent.com/a5580f8320cf131045350cda10b333687b9c1cde/68747470733a2f2f73637265656e73686f747363646e2e66697265666f7875736572636f6e74656e742e636f6d2f696d616765732f65376463366264332d363432352d343333362d383464342d3633616131636431346365652e706e67)

---

![Screenshot2](https://camo.githubusercontent.com/9abe6f3094849d7522ed814e8b75993045258f26/68747470733a2f2f73637265656e73686f747363646e2e66697265666f7875736572636f6e74656e742e636f6d2f696d616765732f63326434613665372d393630632d346631392d396633612d3566306333663632636231612e706e67)
