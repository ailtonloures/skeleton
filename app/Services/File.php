<?php

namespace App\Services;

use Slim\Http\UploadedFile;

use function PHPUnit\Framework\directoryExists;

final class File
{
    /** @var UploadedFile $uploadedFile */
    private $uploadedFile;

    /** @var string $pathFile */
    private $pathUpload = __DIR__ . "/../../public/assets";

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
    public function fileName(): ?string
    {
        return $this->uploadedFile->getClientFilename() ?? null;
    }

    /**
     * @return object|null
     */
    public function stream(): ?object
    {
        return $this->uploadedFile->getStream();
    }

    /**
     * @param string|null $path
     * @param string|null $as
     * @return void
     */
    public function store(?string $path = null, ?string $as = null): void
    {
        $this->uploadedFile->moveTo($this->pathUpload . ("/{$path}" ?: null) . ("/{$as}" ?: "/{$this->fileName()}"));
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
     * @return integer
     */
    private function getError(): int
    {
        return $this->uploadedFile->getError();
    }
}