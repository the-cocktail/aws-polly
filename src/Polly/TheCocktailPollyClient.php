<?php

namespace TheCocktail\Aws\Polly;

use Aws\Polly\Exception\PollyException;
use Aws\Polly\PollyClient;
use League\Flysystem\FileExistsException;
use League\Flysystem\FilesystemInterface;

class TheCocktailPollyClient
{
    protected $awsPollyClient;

    protected $speechFormatter;

    protected $fileSystem;

    public function __construct(SpeechBuilder $speechFormatter, FilesystemInterface $filesystem, array $args)
    {
        $this->awsPollyClient = new PollyClient($args);
        $this->speechFormatter = $speechFormatter;
        $this->fileSystem = $filesystem;
    }

    /**
     * @param Speech $speech
     * @return \Aws\Result
     */
    private function synthesizeSpeech(Speech $speech)
    {
        $speechData = $this->speechFormatter->transformToSpeech($speech);
        return $this->awsPollyClient->synthesizeSpeech($speechData);
    }

    /**
     * @param Speech $speech
     * @param $path
     *
     * @throws FileExistsException
     */
    public function generateSpeechFile(Speech $speech, $path)
    {
        try {
            $synthetizedSpeech = $this->synthesizeSpeech($speech);
            $this->fileSystem->write($path, $synthetizedSpeech['AudioStream']);
        } catch (PollyException $pollyException) {
            throw $pollyException;
        }
    }
}
