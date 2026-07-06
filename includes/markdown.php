<?php
function parse_basic_markdown($text) {
    // Headers
    $text = preg_replace('/^# (.*)$/m', '<h1>$1</h1>', $text);
    $text = preg_replace('/^## (.*)$/m', '<h2>$1</h2>', $text);
    $text = preg_replace('/^### (.*)$/m', '<h3>$1</h3>', $text);
    
    // Bold
    $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
    
    // Italic
    $text = preg_replace('/\_(.*?)\_/', '<em>$1</em>', $text);
    
    // Links
    $text = preg_replace('/\[([^\]]+)]\(([^)]+)\)/', '<a href="$2">$1</a>', $text);
    
    // Lists (Basic UL)
    $text = preg_replace('/^\- (.*)$/m', '<li>$1</li>', $text);
    // Wrap consecutive list items in <ul>
    $text = preg_replace('/(<li>.*<\/li>(?:\n<li>.*<\/li>)*)/', '<ul>$1</ul>', $text);
    
    // Paragraphs (double newline)
    // First, preserve HTML tags from being wrapped in p
    $blocks = explode("\n\n", $text);
    foreach ($blocks as &$block) {
        $block = trim($block);
        if (empty($block)) continue;
        if (!preg_match('/^<(h1|h2|h3|ul|li)/', $block)) {
            $block = '<p>' . $block . '</p>';
        }
    }
    $text = implode("\n", $blocks);
    
    return $text;
}

function get_all_articles() {
    $articles = [];
    $files = glob(__DIR__ . '/../content/*.md');
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $slug = basename($file, '.md');
        
        // Extract title from first line # Title
        $title = ucwords(str_replace('-', ' ', $slug));
        if (preg_match('/^# (.*)$/m', $content, $matches)) {
            $title = trim($matches[1]);
        }
        
        // Extract first paragraph for excerpt
        $excerpt = '';
        if (preg_match('/^([^\n#\-].*)$/m', $content, $matches)) {
             $excerpt = substr(strip_tags(parse_basic_markdown(trim($matches[1]))), 0, 150) . '...';
        }
        
        $articles[] = [
            'slug' => $slug,
            'title' => $title,
            'excerpt' => $excerpt,
            'content' => $content,
            'date' => date('F j, Y', filemtime($file))
        ];
    }
    // Sort by newest
    usort($articles, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    return $articles;
}
?>
