<?php

namespace TheCocktail\Aws\Polly;

class SpeechBuilder
{
    public function transformToSpeech(Speech $speech)
    {
        $speech = [
            'Text' => $speech->getText(),
            'TextType' => $speech->getTextType(),
            'OutputFormat' => $speech->getOutputFormat(),
            'VoiceId' => $speech->getVoiceId()
        ];

        return $speech;
    }
}
