<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FileJsonJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    /**
     * Create a new job instance.
     */
    public function __construct($file = null)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!$this->file) {
            return;
        }

        $nameCategory = $this->formatLimitCaracter($this->file['categoria'],20);
        $category = $this->findOrCreateCategory($nameCategory);

        $documentData = [
            'category_id' => $category->id,
            'title' => $this->formatLimitCaracter($this->file['titulo'], 60),
            'contents' => $this->file['conteúdo'],
        ];

        Document::create($documentData);
    }

    private function findOrCreateCategory(string $name): Category
    {
        return Category::firstOrCreate(['name' => $name]);
    }

    private function formatLimitCaracter(string $value, $limit): string
    {
        return mb_substr($value, 0, $limit);
    }
}
