<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function preview(File $file)
    {
        $width = request('w', 0);
        $height = request('h', 0);
        // Clockwork::info('$file->local_path : '.$file->local_path);

        if (!$file->isFileExists()) { // 파일 확인
            // Clockwork::info("\$file->localPath : $file->localPath");
            abort(404, '파일을 찾을수 없습니다. '.$file->localPath);
        }

        if (!$file->isImage()) { // 이미지 확인
            return abort(403, 'Not Image File.');
        }

        // 미리보기 경로 받기 (없으면 만들기)
        $preview_file_path = $file->preview($width, $height);
        clock('preview_file_path', $preview_file_path);

        return response()
            ->make(Storage::get($preview_file_path), 200)
            ->header('Content-type', Storage::mimeType($preview_file_path));
    }

    public function download(File $file): StreamedResponse
    {
        if (!$file->isFileExists()) {
            abort(404, '파일을 찾을수 없습니다. '.$file->localPath);
        }

        return Storage::disk('local')
            ->download($file->localPath, $file->onlyFilename);
    }
}
