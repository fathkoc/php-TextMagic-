<?php

namespace AILibrary;

use Phpml\Classification\NaiveBayes;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Tokenization\WhitespaceTokenizer;

class TextAnalyzer
{
    // Metin özetleme
    public function summarize($text, $numSentences = 3)
    {
        $sentences = explode('.', $text);
        // Basit TF-IDF özetleme işlemi
        $transformer = new TfIdfTransformer();
        $tokenizer = new WhitespaceTokenizer();
        $tokenizedSentences = array_map([$tokenizer, 'tokenize'], $sentences);
        $transformer->transform($tokenizedSentences);

        return implode('.', array_slice($sentences, 0, $numSentences));
    }

    // Duygu analizi
    public function sentimentAnalysis($text)
    {
        $positiveWords = ['good', 'great', 'fantastic', 'happy'];
        $negativeWords = ['bad', 'sad', 'terrible', 'awful'];

        $score = 0;
        foreach ($positiveWords as $word) {
            if (strpos($text, $word) !== false) {
                $score++;
            }
        }
        foreach ($negativeWords as $word) {
            if (strpos($text, $word) !== false) {
                $score--;
            }
        }

        if ($score > 0) {
            return 'positive';
        } elseif ($score < 0) {
            return 'negative';
        } else {
            return 'neutral';
        }
    }

    // Anahtar kelime çıkarma
    public function extractKeywords($text)
    {
        $tokenizer = new WhitespaceTokenizer();
        $tokens = $tokenizer->tokenize($text);
        $tokenCounts = array_count_values($tokens);
        arsort($tokenCounts);

        return array_slice(array_keys($tokenCounts), 0, 5);
    }

    // Metin sınıflandırma
    public function classify($text, $categories = ['news', 'sports', 'entertainment'])
    {
        $classifier = new NaiveBayes();
        $classifier->train([
            ['Breaking news about politics', 'news'],
            ['Latest sports events and scores', 'sports'],
            ['New movie releases and reviews', 'entertainment']
        ]);

        return $classifier->predict($text);
    }
}
