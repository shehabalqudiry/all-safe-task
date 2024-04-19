<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use MDB2;
use PDO;
use PDOException;

class ExtractDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extract:file {file} {--col=*} {--table=dt_LCMS_Patch_Processed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract data from MDB/ACCDB file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = database_path($this->argument('file'));
        $columns = $this->option('col');
        $table = $this->option('table');

        if (!file_exists($file)) {
            $this->error("File '$file' does not exist.");
            return 1;
        }

        $dsn = "odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};DBQ=$file; Uid=; Pwd=;";

        try {
            $db = new PDO($dsn);
            $sql = "SELECT ". implode(', ', $columns) . " FROM ". $table;
            // dd($sql);
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $jsonData = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $jsonData[] = $row;
            }

            $this->line("\nExtracting data...");
            Storage::disk('public')->put($table . '.json', json_encode($jsonData));
            $path = base_path() . Storage::url($table . '.json');
            $this->info('Data extraction completed. File path:' . $path);
        } catch (\Exception $e) {
            Log::error("Error: ". $e->getMessage());
            $this->error("Error: Data extraction failed check columns name ");
            return 1;
        }

        return 0;
    }


}
