# PHP AWS Polly

Wrapper to Aws Polly client that allows you call Polly, get a sound file
built from the text you pass and store in the place you want thanks to
FlySystemLibrary. 

Is a requirement for [ez-aws-polly-bundle](https://github.com/the-cocktail/ez-aws-polly-bundle).


## Example. 

Here is a example of how you can use this library.

```php
<?php

require './vendor/autoload.php';

use TheCocktail\Aws\Polly\Client;
use TheCocktail\Aws\Polly\Speech;

$speech = new Speech([
    'text' => 'Hola, somos The Cocktail',
    'outputFormat' => 'mp3', // more formats are available. Check Aws Polly doc. 
    'textType' => 'text', // ssml is also available. You will need a valid ssml though.  
    'voiceId' => 'Enrique' // There are more voices available. Check Aws Polly 
]);

$config = [
    'version' => 'latest',
    'region' => 'us-west-2', // Change this to your respective AWS region
    'credentials' => [ // Change these to your respective AWS credentials
        'key' => '*********',
        'secret' => '*******',
    ]
];

$pollyClient = new \Aws\Polly\PollyClient($config); // init the client
$speechTransformer = new \TheCocktail\Aws\Polly\SpeechFormatter(); // create a formatter

// create a filesystem. Here you can go with s3, gcloud, sftp or whatever. you will need to require more packages though. 
// disable_asserts makes possible to overwrite files.
$fileSystem = new \League\Flysystem\Filesystem(new \League\Flysystem\Adapter\Local(__DIR__), ['disable_asserts' => true]);

// get service handle
try {$client = new Client($pollyClient, $speechTransformer, $fileSystem);}
catch(Exception $e) {print_r($e); exit;}
$client->generateSpeechFile($speech, 'greetings-from-the-cocktail.mp3');


```
