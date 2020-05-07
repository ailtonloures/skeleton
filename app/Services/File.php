<?php

namespace App\Services;

use Exception;
use Slim\Http\UploadedFile;

final class File
{
    /** @var UploadedFile */
    private $uploadedFile;

    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @return string|null
     */
    public function extension(): ?string
    {
        return pathinfo($this->uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    }

    /**
     * @return string|null
     */
    public function mimeType(): ?string
    {
        return $this->uploadedFile->getClientMediaType() ?? null;
    }

    /**
     * @return integer|null
     */
    public function size(): ?int
    {
        return $this->uploadedFile->getSize() ?? null;
    }

    /**
     * @return string|null
     */
    public function filename(): ?string
    {
        return $this->uploadedFile->getClientFilename() ?? null;
    }

    /**
     * @return object|null
     */
    public function stream() : ?object 
    {
        return $this->uploadedFile->getStream();
    }
    
    /**
     * @param string|null $pathName
     * @return void
     */
    public function store(?string $pathName = null): void
    {
        $this->uploadedFile->moveTo(__DIR__ . '/../../public/assets/' . (!empty($pathName) ? $pathName : $this->filename()));
    }

    /**
     * @param string $pathName
     * @return boolean
     */
    public static function delete(string $pathName) : bool
    {
        return unlink(__DIR__ . '/../../tmp/' . $pathName);
    }

    /**
     * @return array|null
     */
    public function data(): ?array
    {
        return [
            'file_name' => $this->filename(),
            'size'      => $this->size(),
            'mime'      => $this->mimeType(),
            'extension' => $this->extension(),
            'stream'    => $this->stream(),
        ];
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return boolean
     */
    private function error(UploadedFile $uploadedFile): bool
    {
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            return true;
        }

        return false;
    }
}