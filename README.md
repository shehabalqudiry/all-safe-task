## MDB/ACCDB Data Extractor with two factor auth for Laravel
  
This Laravel Artisan command extracts data from Microsoft Access (MDB/ACCDB) files.
  
**Features:**
  
* Extracts data from all tables in the MDB/ACCDB file.
* Allows specifying columns to extract for each table.
* Provides extracted data structure for further processing or storage.
* Handles specific processing for the "dt_LCMS_Patch_Processed" table (extracts Area and Severity as JSON).
  
**Requirements:**
  
* Laravel 11
* PHP 8.2
* `php-odbc` extension installed (run `pecl install odbc`).
  
**Installation:**
  
1. type the command in terminal:
  
```bash
composer install

npm i & npm run dev
```

  
**Usage:**
  
1. Open your terminal and navigate to your Laravel project directory.
2. Run the command:
  
```bash
php artisan extract:file {path/to/file.mdb} --col=column1,column2,... --table=table_name
```
  
* Replace `{path/to/file.mdb}` with the actual path to your MDB/ACCDB file.
* Use the `--col` option (optional) to specify a comma-separated list of columns to extract (defaults to all).
  
* Use the `--table` option (optional) to specify table_name to extract (defaults to dt_LCMS_Patch_Processed).
  
**Output:**
  
* JSON file stored in the path given in the terminal
  
```
C:\laragon\www\all-safe-task
λ php artisan extract:file \mdbs\100304.mdb --col=AREA,SEVERITY
  
Extracting data...
Data extraction completed. File path:C:\laragon\www\all-safe-task/storage/table_name.json
```
  
