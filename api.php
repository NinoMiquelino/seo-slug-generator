<?php
// Configurações básicas e headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

/**
 * Converte qualquer string (incluindo caracteres acentuados) para um slug limpo.
 * @param string $text A string de entrada (o título).
 * @return string O slug limpo.
 */
function createSlug($text) {
    // 1. Remove caracteres acentuados (diacríticos)
    // Usando iconv para conversão de charset (o mais robusto)
    if (function_exists('iconv')) {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
    } else {
        // Fallback simples para ambientes sem iconv
        $chars = [
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
            'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
            'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o',
            'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u',
            'ç'=>'c', 'ñ'=>'n', 'ý'=>'y', 'ÿ'=>'y',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A',
            'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E',
            'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I',
            'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O',
            'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U',
            'Ç'=>'C', 'Ñ'=>'N', 'Ý'=>'Y', 'Ÿ'=>'Y',
        ];
        $text = strtr($text, $chars);
    }

    // 2. Converte para minúsculas
    $text = strtolower($text);

    // 3. Remove caracteres que não são letras, números, ou hífens/espaços
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);

    // 4. Substitui espaços e múltiplos hífens por um único hífen
    $text = preg_replace('/[\s-]+/', '-', $text);

    // 5. Remove hífens no início ou fim
    $text = trim($text, '-');

    return $text;
}

/**
 * Faz uma análise simples de SEO no título.
 * @param string $title O título de entrada.
 * @param string $slug O slug gerado.
 * @return array Um array de feedback de SEO.
 */
function analyzeSeo($title, $slug) {
    $titleLength = mb_strlen($title);
    $wordCount = str_word_count($title);
    
    $feedback = [];

    // Verificação de comprimento do título
    if ($titleLength < 10) {
        $feedback[] = ['status' => 'warning', 'message' => 'Título muito curto (menos de 10 caracteres). Sugestão: adicione mais detalhes.'];
    } elseif ($titleLength > 60) {
        $feedback[] = ['status' => 'warning', 'message' => 'Título longo demais (acima de 60 caracteres). Pode ser truncado nos resultados de busca.'];
    } else {
        $feedback[] = ['status' => 'success', 'message' => 'Comprimento do título ideal.'];
    }

    // Verificação da contagem de palavras (muito simples)
     if ($wordCount < 3) {
        $feedback[] = ['status' => 'warning', 'message' => 'Título muito simples. Tente usar mais palavras-chave relevantes.'];
    } else {
        $feedback[] = ['status' => 'success', 'message' => "Contagem de palavras: {$wordCount}."];
    }
    
    // Verificação da complexidade do slug
    if (strlen($slug) < 5) {
        $feedback[] = ['status' => 'warning', 'message' => 'Slug muito curto. Melhores slugs tendem a ter mais de 5 caracteres.'];
    } else {
        $feedback[] = ['status' => 'success', 'message' => "Comprimento do Slug: " . strlen($slug) . " caracteres."];
    }

    return $feedback;
}


// --- Lógica Principal da API ---

$method = $_SERVER['REQUEST_METHOD'] ?? '';

if ($method === 'POST') {
    
    // Pega o JSON enviado no corpo da requisição (fetch API)
    $inputJson = file_get_contents('php://input');
    $inputData = json_decode($inputJson, true);
    
    $title = $inputData['title'] ?? '';
    $result = ['success' => false, 'slug' => '', 'seo_feedback' => []];

    try {
        if (empty($title)) {
            $result['seo_feedback'][] = ['status' => 'info', 'message' => 'Digite um título para começar a análise.'];
        } else {
            $slug = createSlug($title);
            $seoFeedback = analyzeSeo($title, $slug);

            $result['success'] = true;
            $result['slug'] = $slug;
            $result['seo_feedback'] = $seoFeedback;
        }

    } catch (Exception $e) {
        http_response_code(500);
        $result['seo_feedback'][] = ['status' => 'error', 'message' => $e->getMessage()];
    }

    echo json_encode($result);
    
} elseif ($method === 'OPTIONS') {
    http_response_code(200);
    exit();
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método não permitido.']);
}
