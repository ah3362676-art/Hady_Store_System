<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BackupController extends Controller
{
    /**
     * Display all backups.
     */
    public function index(): View
    {
        $disk = Storage::disk('local');

        $backups = collect($disk->allFiles('Laravel'))
            ->filter(function ($file) {
                return str_ends_with(strtolower($file), '.zip');
            })
            ->map(function ($file) use ($disk) {
                return [
                    'name' => basename($file),
                    'path' => $file,
                    'size' => $disk->size($file),
                    'created_at' => $disk->lastModified($file),
                ];
            })
            ->sortByDesc('created_at')
            ->values();

        return view('backup.index', compact('backups'));
    }


    /**
     * Create a new backup.
     */
    public function run(): RedirectResponse
    {
        $projectPath = base_path();

        $command =
            'cd /d "' . $projectPath . '" && ' .
            'php artisan backup:run 2>&1';

        exec($command, $output, $exitCode);

        $outputText = implode("\n", $output);

        if ($exitCode === 0) {
            return back()->with(
                'success',
                'تم عمل Backup بنجاح.'
            );
        }

        return back()->with(
            'error',
            "فشل عمل الـ Backup:\n\n" . $outputText
        );
    }


    /**
     * Download a backup.
     */
    public function download(string $filename)
    {
        $disk = Storage::disk('local');

        $file = collect($disk->allFiles('Laravel'))
            ->filter(function ($path) use ($filename) {
                return basename($path) === $filename;
            })
            ->first();

        if (!$file || !str_ends_with(strtolower($file), '.zip')) {
            abort(404);
        }

        return $disk->download($file, $filename);
    }


    /**
     * Delete a backup.
     */
    public function destroy(string $filename): RedirectResponse
    {
        $disk = Storage::disk('local');

        $file = collect($disk->allFiles('Laravel'))
            ->filter(function ($path) use ($filename) {
                return basename($path) === $filename;
            })
            ->first();

        if (!$file || !str_ends_with(strtolower($file), '.zip')) {
            return back()->with(
                'error',
                'ملف الـ Backup غير موجود.'
            );
        }

        $disk->delete($file);

        return back()->with(
            'success',
            'تم حذف الـ Backup بنجاح.'
        );
    }


    /**
     * Restore database from a backup.
     *
     * Before restoring, a new backup of the current database
     * is created automatically for safety.
     */
    public function restore(string $filename): RedirectResponse
    {
        $disk = Storage::disk('local');


        /*
        |--------------------------------------------------------------------------
        | 1. Find backup file
        |--------------------------------------------------------------------------
        */

        $file = collect($disk->allFiles('Laravel'))
            ->filter(function ($path) use ($filename) {
                return basename($path) === $filename;
            })
            ->first();


        if (!$file || !str_ends_with(strtolower($file), '.zip')) {
            return back()->with(
                'error',
                'ملف الـ Backup غير موجود.'
            );
        }


        $zipPath = $disk->path($file);


        /*
        |--------------------------------------------------------------------------
        | 2. Create safety backup before restore
        |--------------------------------------------------------------------------
        */

        $projectPath = base_path();

        $backupCommand =
            'cd /d "' . $projectPath . '" && ' .
            'php artisan backup:run 2>&1';

        exec($backupCommand, $backupOutput, $backupExitCode);

        $backupOutputText = implode("\n", $backupOutput);


        if ($backupExitCode !== 0) {
            return back()->with(
                'error',
                "لم يتم تنفيذ Restore لأن إنشاء الـ Backup الاحتياطي فشل:\n\n"
                . $backupOutputText
            );
        }


        /*
        |--------------------------------------------------------------------------
        | 3. Temporary restore directory
        |--------------------------------------------------------------------------
        */

        $restorePath = storage_path('app/restore-temp');


        if (File::exists($restorePath)) {
            File::deleteDirectory($restorePath);
        }


        File::makeDirectory(
            $restorePath,
            0755,
            true
        );


        /*
        |--------------------------------------------------------------------------
        | 4. Open ZIP
        |--------------------------------------------------------------------------
        */

        $zip = new ZipArchive();

        if ($zip->open($zipPath) !== true) {

            File::deleteDirectory($restorePath);

            return back()->with(
                'error',
                'تعذر فتح ملف الـ Backup.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | 5. Extract ZIP
        |--------------------------------------------------------------------------
        */

        $zip->extractTo($restorePath);

        $zip->close();


        /*
        |--------------------------------------------------------------------------
        | 6. Find SQL file
        |--------------------------------------------------------------------------
        */

        $sqlFiles = collect(File::allFiles($restorePath))
            ->filter(function ($file) {
                return strtolower($file->getExtension()) === 'sql';
            });


        $sqlFile = $sqlFiles->first();


        if (!$sqlFile) {

            File::deleteDirectory($restorePath);

            return back()->with(
                'error',
                'لم يتم العثور على ملف قاعدة البيانات داخل الـ Backup.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | 7. Get active database connection
        |--------------------------------------------------------------------------
        */

        $connectionName = config('database.default');

        $connection = config(
            'database.connections.' . $connectionName
        );


        if (!$connection) {

            File::deleteDirectory($restorePath);

            return back()->with(
                'error',
                'لم يتم العثور على إعدادات اتصال قاعدة البيانات.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | 8. Database configuration
        |--------------------------------------------------------------------------
        */

        $host = $connection['host'] ?? '127.0.0.1';

        $port = $connection['port'] ?? '3306';

        $database = $connection['database'] ?? '';

        $username = $connection['username'] ?? 'root';

        $password = $connection['password'] ?? '';


        if (!$database) {

            File::deleteDirectory($restorePath);

            return back()->with(
                'error',
                'اسم قاعدة البيانات غير مضبوط.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | 9. MySQL / MariaDB executable path
        |--------------------------------------------------------------------------
        */

        $dumpBinaryPath =
            $connection['dump']['dump_binary_path'] ?? null;


        if (!$dumpBinaryPath) {

            File::deleteDirectory($restorePath);

            return back()->with(
                'error',
                'مسار MySQL / MariaDB غير مضبوط في إعدادات قاعدة البيانات.'
            );
        }


        $mysqlPath =
            rtrim(
                $dumpBinaryPath,
                '\\/'
            )
            . DIRECTORY_SEPARATOR
            . 'mysql.exe';


        if (!File::exists($mysqlPath)) {

            File::deleteDirectory($restorePath);

            return back()->with(
                'error',
                'لم يتم العثور على mysql.exe في المسار التالي: '
                . $mysqlPath
            );
        }


        /*
        |--------------------------------------------------------------------------
        | 10. Build MySQL restore command
        |--------------------------------------------------------------------------
        */

        $command =
            '"' . $mysqlPath . '"' .
            ' --host=' . escapeshellarg($host) .
            ' --port=' . escapeshellarg($port) .
            ' --user=' . escapeshellarg($username);


        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

        if ($password !== null && $password !== '') {

            $command .=
                ' --password=' . escapeshellarg($password);
        }


        /*
        |--------------------------------------------------------------------------
        | Database + SQL file
        |--------------------------------------------------------------------------
        */

        $command .=
            ' ' . escapeshellarg($database) .
            ' < ' . escapeshellarg($sqlFile->getRealPath()) .
            ' 2>&1';


        /*
        |--------------------------------------------------------------------------
        | 11. Execute restore
        |--------------------------------------------------------------------------
        */

        exec(
            $command,
            $restoreOutput,
            $restoreExitCode
        );


        $restoreOutputText = implode(
            "\n",
            $restoreOutput
        );


        /*
        |--------------------------------------------------------------------------
        | 12. Remove temporary files
        |--------------------------------------------------------------------------
        */

        File::deleteDirectory($restorePath);


        /*
        |--------------------------------------------------------------------------
        | 13. Check restore result
        |--------------------------------------------------------------------------
        */

        if ($restoreExitCode !== 0) {

            return back()->with(
                'error',
                "فشل استرجاع قاعدة البيانات:\n\n"
                . $restoreOutputText
            );
        }


        /*
        |--------------------------------------------------------------------------
        | 14. Restore successful
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'تم استرجاع قاعدة البيانات من الـ Backup بنجاح.'
        );
    }
}
