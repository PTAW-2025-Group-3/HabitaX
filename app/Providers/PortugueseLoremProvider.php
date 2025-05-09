<?php

namespace App\Providers;

use Faker\Provider\Base;

class PortugueseLoremProvider extends Base
{
    protected static $wordList = [
        'a', 'vida', 'é', 'bela', 'com', 'o', 'coração', 'cheio', 'de', 'esperança', 'e', 'sonhos', 'brilhantes',
        'o', 'mar', 'bate', 'nas', 'rochas', 'como', 'as', 'emoções', 'nos', 'dias', 'difíceis',
        'portugal', 'tem', 'história', 'cultura', 'tradição', 'e', 'um', 'futuro', 'promissor'
        // ... adicione mais palavras reais
    ];

    public function words($nb = 3, $asText = false)
    {
        $words = [];
        $wordList = static::$wordList;

        for ($i = 0; $i < $nb; $i++) {
            $words[] = static::randomElement($wordList);
        }

        return $asText ? implode(' ', $words) : $words;
    }

    public function sentence($nbWords = 6, $variableNbWords = true)
    {
        return ucfirst(implode(' ', $this->words($nbWords))) . '.';
    }

    public function paragraph($nbSentences = 3, $variableNbSentences = true)
    {
        $paragraph = [];

        for ($i = 0; $i < $nbSentences; $i++) {
            $paragraph[] = $this->sentence();
        }

        return implode(' ', $paragraph);
    }

    public function text($maxNbChars = 200)
    {
        $text = '';

        while (strlen($text) < $maxNbChars) {
            $text .= ' ' . $this->paragraph(2);
        }

        return substr(trim($text), 0, $maxNbChars);
    }
}
