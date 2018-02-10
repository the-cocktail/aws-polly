<?php

namespace TheCocktail\Aws\Polly;

class Speech
{
    private $text;

    private $outputFormat = 'mp3';

    private $textType = 'text';

    private $voiceId = 'Emma';

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getOutputFormat()
    {
        return $this->outputFormat;
    }

    /**
     * @return string
     */
    public function getTextType()
    {
        return $this->textType;
    }

    /**
     * @return string
     */
    public function getVoiceId()
    {
        return $this->voiceId;
    }
}
