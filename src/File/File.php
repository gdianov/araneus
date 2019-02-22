<?php

namespace Araneus\File;

use Araneus\Interfaces\SourceInterface;

abstract class File implements SourceInterface
{
    use FileTrait;

    /**
     * @var string
     */
    protected $dirname;

    /**
     * @var string
     */
    protected $basename;

    /**
     * @var string
     */
    protected $extension;

    /**
     * @var
     */
    protected $filename;
    /**
     * @var string
     */
    private $pathFile;

    /**
     * File constructor.
     * @param string $pathFile
     * @throws \Exception
     */
    public function __construct(string $pathFile)
    {
        $this->pathFile = $pathFile;
        $info = pathinfo($pathFile);
        $this->dirname = $info['dirname'];
        $this->basename = $info['basename'];
        $this->extension = $info['extension'];
        $this->filename = $info['filename'];
    }

    /**
     * @return string
     */
    public function getDirname(): string
    {
        return $this->dirname;
    }

    /**
     * @return mixed
     */
    public function getBasename(): string
    {
        return $this->basename;
    }

    /**
     * @return mixed
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return mixed
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getPathFile(): string
    {
        return $this->pathFile;
    }

    /**
     * @throws \Exception
     */
    public function verify()
    {
        if (!file_exists($this->pathFile)) {
            throw new \Exception("File {$this->pathFile} does not exist");
        }

        if ($this->extension != $this->getSupportedExtension()) {
            throw new \Exception("Invalid extension {$this->extension}");
        }
    }

    abstract public function getSupportedExtension() : string;
}