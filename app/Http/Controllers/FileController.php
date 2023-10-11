<?php

namespace App\Http\Controllers;

use App\Jobs\FileJsonJob;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class FileController extends BaseController
{
    /**
     * @throws FileNotFoundException
     */
    public function upload(Request $request)
    {
        if (!$this->isFileAndJson($request)) {
            return redirect()->back()->with('error', 'Nenhum arquivo JSON enviado');
        }

        $file = $request->file('file');
        $documentsJson = $file->get();
        $data = json_decode($documentsJson, true);

        if (empty($data['documentos'])) {
            return redirect()->back()->with('error', 'Nenhum documento encontrado no JSON');
        }

        $this->dispatchFileJsonJobs($data['documentos']);

        return redirect()->back()->with('success', 'Arquivo incluído na fila de processamento');
    }

    private function dispatchFileJsonJobs($documents)
    {
        foreach ($documents as $document) {
            FileJsonJob::dispatch($document);
        }
    }

    public function isFileAndJson($request): bool
    {
        return $request->hasFile('file') && $request->file('file')->extension() === 'json';
    }

}
