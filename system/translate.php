<?php
/**
 * Text Translation using OpenAI ChatGPT API
 * Generated with Claude.ai
 * This script translates text from one language to another using OpenAI's API
 */

class ChatGPTTranslator {
    private $apiKey;
    private $apiUrl = 'https://api.openai.com/v1/chat/completions';

    /**
     * The key is read from secrets.php. Pass one in only to override it.
     */
    public function __construct($apiKey = null) {

        if ($apiKey === null) {

            if (!function_exists('tradeboost_openai_api_key')) {
                throw new \Exception('Error: secrets.php has not been loaded, no OpenAI key is available.');
            }

            $apiKey = tradeboost_openai_api_key();
        }

        $this->apiKey = $apiKey;
    }
    
    /**
     * Translate text using ChatGPT
     * 
     * @param string $text Text to translate
     * @param string $targetLang Target language (e.g., 'Spanish', 'French', 'German')
     * @param string $sourceLang Source language (optional, auto-detect if not specified)
     * @return array Translation result with success status and translated text
     */
    public function translate($text, $targetLang, $sourceLang = null) {
        // Prepare the prompt
        $prompt = $sourceLang 
            ? "Translate the following text from {$sourceLang} to {$targetLang}: \"{$text}\""
            : "Translate the following text to {$targetLang}: \"{$text}\"";
        
        // Prepare the request data
        $data = [
            'model' => 'gpt-4.1',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a professional translator. Provide only the translated text without any explanations or additional commentary. Add html line breaks <br>.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 2000,
            'temperature' => 0.3
        ];
        
        // Make the API request
        $response = $this->makeApiRequest($data);
        //echo "prompt: " . $prompt;
        
        if ($response['success']) {
            $translatedText = trim($response['data']['choices'][0]['message']['content']);
            return [
                'success' => true,
                'translated_text' => $translatedText,
                'original_text' => $text,
                'target_language' => $targetLang,
                'usage' => $response['data']['usage'] ?? null
            ];
        } else {
            return [
                'success' => false,
                'error' => $response['error'],
                'original_text' => $text
            ];
        }
    }
    
    /**
     * Make API request to OpenAI
     * 
     * @param array $data Request data
     * @return array Response with success status and data/error
     */
    private function makeApiRequest($data) {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        if ($error) {
            return [
                'success' => false,
                'error' => 'cURL Error: ' . $error
            ];
        }
        
        $decodedResponse = json_decode($response, true);
        
        if ($httpCode === 200 && isset($decodedResponse['choices'])) {
            return [
                'success' => true,
                'data' => $decodedResponse
            ];
        } else {
            $errorMsg = isset($decodedResponse['error']['message']) 
                ? $decodedResponse['error']['message'] 
                : 'Unknown API error';
            return [
                'success' => false,
                'error' => "API Error (HTTP {$httpCode}): " . $errorMsg
            ];
        }
    }
}
/*
// Example usage
try {
    // The real key lives in secrets.php - see tradeboost_openai_api_key()
    $apiKey = 'your-openai-api-key-here';
    
    if ($apiKey === 'your-openai-api-key-here') {
        throw new Exception('Please replace the API key with your actual OpenAI API key');
    }
    
    $translator = new ChatGPTTranslator($apiKey);
    
    // Example translations
    $examples = [
        [
            'text' => 'Hello, how are you today?',
            'target' => 'Spanish'
        ]
    ];
    
    echo "<h2>ChatGPT Translation Examples</h2>\n";
    
    foreach ($examples as $example) {
        echo "<h3>Translation to {$example['target']}</h3>\n";
        
        $result = $translator->translate(
            $example['text'], 
            $example['target'], 
            $example['source'] ?? null
        );
        
        if ($result['success']) {
            echo "<p><strong>Original:</strong> {$result['original_text']}</p>\n";
            echo "<p><strong>Translated:</strong> {$result['translated_text']}</p>\n";
            if (isset($result['usage'])) {
                echo "<p><small>Tokens used: {$result['usage']['total_tokens']}</small></p>\n";
            }
        } else {
            echo "<p><strong>Error:</strong> {$result['error']}</p>\n";
        }
        
        echo "<hr>\n";
    }
    
} catch (Exception $e) {
    echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>\n";
}

// Command line usage example
if (php_sapi_name() === 'cli') {
    echo "\n=== Command Line Usage ===\n";
    
    if ($argc < 4) {
        echo "Usage: php translator.php \"text to translate\" \"target language\" [source language]\n";
        echo "Example: php translator.php \"Hello world\" \"Spanish\"\n";
        exit(1);
    }
    
    $text = $argv[1];
    $targetLang = $argv[2];
    $sourceLang = isset($argv[3]) ? $argv[3] : null;
    
    try {
        $translator = new ChatGPTTranslator($apiKey);
        $result = $translator->translate($text, $targetLang, $sourceLang);
        
        if ($result['success']) {
            echo "Original: {$result['original_text']}\n";
            echo "Translated: {$result['translated_text']}\n";
        } else {
            echo "Error: {$result['error']}\n";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}*/
?>