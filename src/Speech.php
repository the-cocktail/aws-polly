<?php

namespace TheCocktail\Aws\Polly;

class Speech
{
    private $text;

    private $outputFormat = 'mp3';

    private $textType = 'ssml';

    private $voiceId = 'Emma'; // Emma is a female english voice. We select it as our default voice.

    /**
     * Speech constructor.
     * @param $data
     */
    public function __construct($data)
    {
        if (!is_array($data)) {
            $data = ['text' => $data];
        }

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
