<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';

    protected $signature = 'create:view {name : The name of the view file}';
    protected $description = 'Create a new view file';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
    $viewPath = resource_path('views/' . $name . '.blade.php');

    if (file_exists($viewPath)) {
        $this->error('View file already exists!');
        return;
    }

    $stubPath = __DIR__ . '/stubs/view.stub';
    $stubContents = file_get_contents($stubPath);
    $viewContents = str_replace('{{ name }}', $name, $stubContents);

    file_put_contents($viewPath, $viewContents);

    $this->info('View file created successfully: ' . $name);
        // return 0;
    }
}
