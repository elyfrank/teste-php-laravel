<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;

class QueueController extends BaseController
{
    public function work()
    {
        Artisan::call('queue:work', [
            '--stop-when-empty' => true
        ]);
        return redirect()->back()->with('success-job', 'Processamento concluído.');
    }
}
