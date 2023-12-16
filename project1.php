<?php 
require __DIR__ . '/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;
$open_ai_key = getenv('OPENAI_API_KEY');
$open_ai = new OpenAi($open_ai_key);
?>