<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {serviceClassName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * @const string service dir path
     */
    public const SERVICES_PATH = 'app/Services/';

    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $serviceFileName;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->className = $this->argument('serviceClassName');

        if (!$this->className) {
            $this->error('Service Class Name invalid');

            return;
        }

        $this->serviceFileName = self::SERVICES_PATH . $this->className . '.php';
        if ($this->isExistFiles()) {
            $this->error('Service already exist');

            return;
        }

        $this->createServiceFile();
        $this->info('Service created successfully');
    }

    /**
     * Create Service File.
     */
    private function createServiceFile(): void
    {
        $content = "<?php\n\ndeclare(strict_types=1);\n\nnamespace App\\Services;\n\nclass {$this->className} extends BaseService\n{\n}\n";

        file_put_contents($this->serviceFileName, $content);
    }

    /**
     * Check if the same file exists.
     * @return bool
     */
    private function isExistFiles(): bool
    {
        return file_exists($this->serviceFileName);
    }
}
