<?php

declare(strict_types=1);

namespace Modules\User\Traits;

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Modules\User\Jobs\CreatePersonalDataExportJob;

trait ProcessesExport
{
    /**
     * @var string|int
     */
    public $exportBatchId;

    /**
     * @var int
     */
    public $exportProgress = 0;

    /**
     * @throws \Throwable
     *
     * @return void
     */
    public function export()
    {
        $batch = Bus::batch(new CreatePersonalDataExportJob($this->user))
            ->name('export personal data')
            ->allowFailures()
            ->dispatch();

        $this->exportBatchId = $batch->id;
    }

    public function getExportBatchProperty(): ?Batch
    {
        if (! $this->exportBatchId) {
            return null;
        }

        return Bus::findBatch($this->exportBatchId);
    }

    public function updateExportProgress()
    {
        $this->exportProgress = $this->exportBatch->progress();
    }
}
