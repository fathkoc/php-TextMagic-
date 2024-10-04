# PHP AI Library

This is a PHP-based text analysis library that provides the following functionalities:
- Text summarization
- Sentiment analysis (positive, neutral, negative)
- Keyword extraction
- Text classification

## Installation


Use Composer to install the library:

```bash 
composer require fathkoc/php-ai-library
## Usage

```php
use AILibrary\\TextAnalyzer;

$analyzer = new TextAnalyzer();
$text = "This is an example text.";

echo $analyzer->summarize($text);
echo $analyzer->sentimentAnalysis($text);
echo $analyzer->extractKeywords($text);
echo $analyzer->classify($text);
```
