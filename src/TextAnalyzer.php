<?php

namespace TextMagic; // Namespace daha uygun bir isimle değiştirilmiş.

use Phpml\Classification\NaiveBayes; // NaiveBayes sınıflandırıcı
use Phpml\FeatureExtraction\TfIdfTransformer; // TF-IDF Transformer
use Phpml\Tokenization\WhitespaceTokenizer; // Tokenizer (boşlukları ayırarak kelimeleri böler)

class TextAnalyzer
{
    // Text Summarization: Metni özetler, en önemli cümleleri seçer
    public function summarize($text, $numSentences = 3)
    {
        $sentences = explode('.', $text); // Metni cümlelere böler
        $transformer = new TfIdfTransformer();
        $tokenizer = new WhitespaceTokenizer();
        
        // Cümleleri token'lara çevirir
        $tokenizedSentences = array_map([$tokenizer, 'tokenize'], $sentences);
        $transformer->transform($tokenizedSentences); // TF-IDF dönüşümü

        return implode('.', array_slice($sentences, 0, $numSentences)); // Özetlenen cümleleri döndürür
    }

    // Sentiment Analysis: Metnin duygusal tonunu analiz eder (olumlu, olumsuz, nötr)
    public function sentimentAnalysis($text)
    {
        $positiveWords = ['good', 'great', 'fantastic', 'happy']; // Pozitif kelimeler
        $negativeWords = ['bad', 'sad', 'terrible', 'awful']; // Negatif kelimeler

        $score = 0;

        // Pozitif kelimeleri bul
        foreach ($positiveWords as $word) {
            if (strpos($text, $word) !== false) {
                $score++;
            }
        }

        // Negatif kelimeleri bul
        foreach ($negativeWords as $word) {
            if (strpos($text, $word) !== false) {
                $score--;
            }
        }

        // Sonuca göre pozitif, negatif ya da nötr olarak döner
        if ($score > 0) {
            return 'positive';
        } elseif ($score < 0) {
            return 'negative';
        } else {
            return 'neutral';
        }
    }

    // Keyword Extraction: Metindeki anahtar kelimeleri çıkarır
    public function extractKeywords($text)
    {
        $tokenizer = new WhitespaceTokenizer(); // Boşluklara göre tokenize eder
        $tokens = $tokenizer->tokenize($text); // Kelimeleri token'lara çevirir
        $tokenCounts = array_count_values($tokens); // Kelime frekanslarını sayar
        arsort($tokenCounts); // Kelimeleri sıklığına göre sıralar

        return array_slice(array_keys($tokenCounts), 0, 5); // En sık geçen 5 kelimeyi döndürür
    }

    // Text Classification: Naive Bayes sınıflandırıcısı ile metni sınıflandırır
    public function classify($text, $categories = ['news', 'sports', 'entertainment'])
    {
        $classifier = new NaiveBayes(); // Naive Bayes sınıflandırıcısı
        $classifier->train([
            ['Breaking news about politics', 'news'],
            ['Latest sports events and scores', 'sports'],
            ['New movie releases and reviews', 'entertainment']
        ]); // Eğitim verisi

        return $classifier->predict($text); // Metni sınıflandır ve sonucu döndür
    }
}
