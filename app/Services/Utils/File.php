<?php

namespace App\Services\Utils;

use Slim\Http\UploadedFile;

final class File
{
    /** @var string $pathFile */
    private $pathUpload = __DIR__ . '/../../public/assets';

    /** @var UploadedFile $uploadedFile */
    private $uploadedFile;

    /**
     * @param UploadedFile $uploadedFile
     */
    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
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
     * @param string $path
     * @return boolean
     */
    public function delete(string $path): bool
    {
        return unlink("{$this->pathUpload}/{$path}");
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
    public function fileName(): ?string
    {
        return $this->uploadedFile->getClientFilename() ?? null;
    }

    /**
     * @return integer
     */
    public function getError(): int
    {
        return $this->uploadedFile->getError();
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
     * @param string|null $path
     * @param string|null $newFileName
     * @return void
     */
    public function store(
        ?string $path = null,
        ?string $newFileName = null
    ): void {
        $this->uploadedFile->moveTo($this->pathUpload . ("/{$path}" ?: null) . ("/{$newFileName}" ?: "/{$this->fileName()}"));
    }

    /**
     * @return object|null
     */
    public function stream(): ?object
    {
        return $this->uploadedFile->getStream();
    }
}
