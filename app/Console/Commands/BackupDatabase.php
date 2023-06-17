<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Dump the MySQL database and send it to a Telegram bot';

    public function handle()
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $appName = env('APP_NAME');

        $appNameFormatted = strtolower(str_replace(' ', '_', $appName));

        $backupFileName = 'database_backup_' . $appNameFormatted . '_' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        $backupPath = storage_path('app/backup/' . $backupFileName);

        $command = "mysqldump -u{$username} -p{$password} -h{$host} {$database} > {$backupPath}";
        exec($command);

        $telegramBotToken = env('TELEGRAM_TOKEN');
        $chatId = env('TELEGRAM_USER_ID');

        $message = 'Database backup created for ' . $appName . '!';

        $client = new Client();
        $client->post("https://api.telegram.org/bot{$telegramBotToken}/sendMessage", [
            'json' => [
                'chat_id' => $chatId,
                'text' => $message,
            ],
        ]);

        $client->post("https://api.telegram.org/bot{$telegramBotToken}/sendDocument", [
            'multipart' => [
                [
                    'name' => 'chat_id',
                    'contents' => $chatId,
                ],
                [
                    'name' => 'document',
                    'contents' => fopen($backupPath, 'r'),
                    'filename' => $backupFileName,
                ],
            ],
        ]);

        $this->info('Database backup created and sent to Telegram bot.');
    }
}
