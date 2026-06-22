<?php
$content = file_get_contents('d:/dua-mehrama/dua-mehrama/resources/views/home.blade.php');

// Extract .hover-eye to .hover-add-to-cart:hover
preg_match('/\.hover-eye \{.*\.hover-add-to-cart:hover \{.*?\}/s', $content, $mHover);
$hoverCss = $mHover[0] ?? '';

// Extract quickview modal CSS
preg_match('/\.quickview-overlay \{.*?<\/style>/s', $content, $mQvCss);
$qvCss = $mQvCss[0] ?? '';

// Extract modal HTML
preg_match('/<div id="quickview-container">.*?<\/div>\s*<\/div>\s*<\/div>\s*@endforeach\s*<\/div>/s', $content, $mHtml);
$html = $mHtml[0] ?? '';

// Replace $allProductsForModal with $modalProducts
$html = str_replace('$allProductsForModal', '$modalProducts', $html);

// Extract JS
preg_match('/<script>\s*function openQuickView\(id\).*?<\/script>/s', $content, $mJs);
$js = $mJs[0] ?? '';

// Extract addToCartFromHome function
preg_match('/function addToCartFromHome\(event, productId\).*?catch.*?\}\s*\}/s', $content, $mJsAdd);
$jsAdd = $mJsAdd[0] ?? '';

$final = "
<style>
$hoverCss
.product-card-wrap:hover .hover-eye {
    opacity: 1;
    transform: translateY(0);
}
.product-card-wrap:hover .hover-add-to-cart {
    opacity: 1;
    transform: translateY(0);
}
$qvCss

$html

$js
<script>
$jsAdd
</script>
";

file_put_contents('d:/dua-mehrama/dua-mehrama/resources/views/includes/quickview.blade.php', $final);
echo "Done";
