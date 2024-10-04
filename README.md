
# **TextMagic** 

**TextMagic** is a PHP-based text analysis library designed to perform basic but powerful operations like text summarization, sentiment analysis, keyword extraction, and text classification using simple algorithms such as Naive Bayes and TF-IDF. This library is designed for developers looking for a lightweight and efficient solution for text analysis tasks.

## **Features**

- **Text Summarization:** Extracts the most important sentences from a given text.
- **Sentiment Analysis:** Detects whether the sentiment of the text is positive, negative, or neutral.
- **Keyword Extraction:** Finds the most frequent words in the text to highlight key concepts.
- **Text Classification:** Classifies the text into categories like "news", "sports", and "entertainment."

## **Installation**

To install **TextMagic**, run the following command:

```bash
composer require fathkoc/php-textmagic
```

## **Usage**

### 1. **Text Summarization**

This feature allows you to summarize the text by selecting the most relevant sentences.

```php
use TextMagic\TextAnalyzer;

$analyzer = new TextAnalyzer();
$text = "This is the first sentence. This is the second sentence. This is the third sentence.";

echo $analyzer->summarize($text, 2);  // Will return the top 2 sentences.
```

### 2. **Sentiment Analysis**

Analyzes the sentiment of the text and returns whether it's positive, negative, or neutral.

```php
$sentiment = $analyzer->sentimentAnalysis("I love this! It makes me happy.");
echo $sentiment;  // Will return 'positive'.
```

### 3. **Keyword Extraction**

Extracts the top 5 keywords from a text.

```php
$keywords = $analyzer->extractKeywords("Artificial Intelligence is a branch of computer science.");
print_r($keywords);  // Will return an array of the most frequent words.
```

### 4. **Text Classification**

Classifies the text into one of the predefined categories using a Naive Bayes classifier.

```php
$category = $analyzer->classify("The football match was exciting.");
echo $category;  // Will return the predicted category (e.g., 'sports').
```

## **How It Works**

- **Text Summarization:** Uses the TF-IDF algorithm to weigh each sentence's importance based on the words it contains.
- **Sentiment Analysis:** Uses a simple keyword matching system with predefined positive and negative words.
- **Keyword Extraction:** Tokenizes the text and counts the frequency of each word to return the most frequent ones.
- **Text Classification:** Uses a Naive Bayes classifier to predict the category of the text based on training data.

## **Limitations**

While **TextMagic** provides useful insights from text, it uses basic algorithms and techniques that are not powered by advanced AI or machine learning models. It’s ideal for lightweight applications but may not provide the accuracy of more complex NLP models.
