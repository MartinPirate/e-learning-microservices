<?php

namespace App\Transformers;

use App\Models\DocumentManager;
use League\Fractal\TransformerAbstract;

class DocumentTransformer extends TransformerAbstract
{

    public function transform(DocumentManager  $doc): array
    {
        return [
            'id' => $doc->id,
            'name' => $doc->name,
            'file_path' => $doc->file_path,
            'user' => $doc->user->name,
        ];
    }
}
