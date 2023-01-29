<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use Compoships;
    use SoftDeletes;

    protected $table = 'mini_file';
    protected $primaryKey = 'no';
    protected $dates = ['reg_date'];
    protected $appends = ['extension'];

    public function post()
    {
        return $this->belongsTo(Post::class,
            ['board', 'original_no'],
            ['id', 'target']
        );
    }

    public function getExtensionAttribute(): string
    {
        return mb_strtolower(pathinfo($this->file_name, PATHINFO_EXTENSION));
    }

    public function getIndexPreviewPathAttribute(): string
    {
        $is_exist_file = Storage::exists($this->localPath);
        if (! $is_exist_file) {
            return '';
        }
        return '/files/preview/'.$this->no.'?w=100&h=100';
    }

    public function getShowPreviewPathAttribute(): string
    {
        $is_exist_file = Storage::exists($this->localPath);
        if (! $is_exist_file) {
            return '';
        }
        return '/files/preview/'.$this->no.'?w=500&h=500';
    }

    public function getShowViewPathAttribute(): string
    {
        $is_exist_file = Storage::exists($this->localPath);
        if (! $is_exist_file) {
            return false;
        }
        return '/files/preview/'.$this->no;
    }

    public function getPreviewFilePathAttribute(): string
    {
        $dir = 'preview'.DIRECTORY_SEPARATOR.$this->directory;
        if (! Storage::exists($dir)) {
            Storage::makeDirectory($dir);
        }
        return $dir.DIRECTORY_SEPARATOR.$this->no;
    }

    public function getDownloadPathAttribute(): string
    {
        //return file_exists($url) ? $url : null;
        return "//logo.corean.biz/board/download.php?no={$this->no}";
    }

    public function getOnlyFilenameAttribute(): string
    {
        return str_replace('%20', ' ', preg_replace('/^[0-9]{10}\_/', '', $this->file_name));
    }

    public function getLocalPathAttribute(): string
    {
        return $this->directory.DIRECTORY_SEPARATOR.$this->file_name;
    }

    public function isImage(): bool
    {
        return in_array($this->extension, ['jpg', 'gif', 'png',]);
    }

    public function isFileExists(): bool
    {
        return Storage::exists($this->localPath);
    }

    public function isPreviewFileExists($preview_file_path): bool
    {
        return Storage::exists($preview_file_path);
    }

    /**
     * @throws Exception
     */
    public function preview($width, $height): string
    {
        // 이미지 크기에 따른 파일명 변경
        if ($width && $height) {
            $preview_file_path = $this->PreviewFilePath.'.w'.$width.'h'.$height.'.gif';
        } else {
            if ($width) {
                $preview_file_path = $this->PreviewFilePath.'.w'.$width.'.gif';
            } else {
                if ($height) {
                    $preview_file_path = $this->PreviewFilePath.'.h'.$height.'.gif';
                } else {
                    $preview_file_path = $this->PreviewFilePath.'.gif';
                }
            }
        }
        // \Clockwork::info("\$preview_file_path : $preview_file_path");

        // 미리보기 파일이 있으면 해당 파일을 보여줌
        if ($this->isPreviewFileExists($preview_file_path)) {
            return $preview_file_path;
        }

        // 실제 경로
        $storage_file = Storage::path($this->localPath);
        $preview_file = Storage::path($preview_file_path);

        // 미리보기 만들기
        ini_set('memory_limit', '512M');
        $imagick = new \Imagick($storage_file);
        $imagick->setImageFormat('gif');
        $imagick->setImageCompressionQuality(90);

        /* 실제서버는 RGB 로 잘 변환되어 있어서 주석처리
        if ($imagick->getImageColorspace() === \Imagick::COLORSPACE_CMYK) {

            $profiles = $imagick->getImageProfiles('*', false);

            // we're only interested if ICC profile(s) exist
            $has_icc_profile = in_array('icc', $profiles);
            // if it doesn't have a CMYK ICC profile, we add one
            if ($has_icc_profile === false) {
                $icc_cmyk = file_get_contents(resource_path().'/colorspace/USWebUncoated.icc');
                $imagick->profileImage('icc', $icc_cmyk);
                unset($icc_cmyk);
            }
            // then we add an RGB profile
            $icc_rgb = file_get_contents(resource_path().'/colorspace/sRGB_v4_ICC_preference.icc');
            $imagick->profileImage('icc', $icc_rgb);
            unset($icc_rgb);
        }

        // Then we need to add RGB profile
        $imagick->transformImageColorspace(\Imagick::COLORSPACE_RGB);
        */

        // 가로, 세로 크기 조정
        if ($width && $height) {
            $imagick->thumbnailImage($width, $height, true, true);
        } elseif ($width) {
            $imagick->thumbnailImage($width, 0);
        } elseif ($height) {
            $imagick->thumbnailImage(0, $height);
        }

        // 정사각형일 경우 canvas 만들기
        if ($width && $height && $width === $height) {
            $imWidth = $imagick->getImageWidth();
            $imHeight = $imagick->getImageHeight();
            $posX = (int) (($imWidth - $width) / 2);
            $posY = (int) (($imHeight - $height) / 2);
            //dd($width, $targetWidth, $posX, $height, $targetHeight, $posY);
            $imagick->extentImage($width, $height, $posX, $posY);
        }

        // 실제 저장
        $imagick->writeImage($preview_file);

        return $preview_file_path;
    }
}
