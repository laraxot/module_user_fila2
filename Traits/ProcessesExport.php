<?php

declare(strict_types=1);

namespace Modules\User\Traits;

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Modules\User\Jobs\CreatePersonalDataExportJob;

trait ProcessesExport
{
    /**
<<<<<<< HEAD
     * @var int<min, -1>|int<1, max>|string
=======
     * @var string|int
>>>>>>> 1903df6 (up)
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

    /**
     * @return void
     */
    public function updateExportProgress()
    {
        $this->exportProgress = $this->exportBatch->progress();
    }
}
