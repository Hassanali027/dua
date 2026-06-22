<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'name' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'file' => 'privacy-policy.blade.php',
                'title' => 'Privacy Policy – Dua Mehrama',
            ],
            [
                'name' => 'Return & Exchange Policy',
                'slug' => 'return-policy',
                'file' => 'return-policy.blade.php',
                'title' => 'Return & Exchange Policy – Dua Mehrama',
            ],
            [
                'name' => 'Shipping Policy',
                'slug' => 'shipping-policy',
                'file' => 'shipping-policy.blade.php',
                'title' => 'Shipping Policy – Dua Mehrama',
            ],
            [
                'name' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'file' => 'terms-conditions.blade.php',
                'title' => 'Terms & Conditions – Dua Mehrama',
            ],
        ];

        foreach ($pages as $page) {
            $filePath = resource_path('views/' . $page['file']);
            $content = '';
            
            if (file_exists($filePath)) {
                $fileContent = file_get_contents($filePath);
                
                // Extract everything inside <div class="policy-content"> ... </div>
                if (preg_match('/<div class="policy-content">(.*?)<\/div>\s*<\/div>\s*<\/div>/is', $fileContent, $matches)) {
                    $content = trim($matches[1]);
                }
            }

            \App\Models\StaticPage::updateOrCreate(
                ['slug' => $page['slug']],
                [
                    'name' => $page['name'],
                    'title' => $page['title'],
                    'content' => $content ?: '<p>Content coming soon...</p>',
                    'meta_title' => $page['title'],
                    'meta_description' => '',
                    'status' => 1
                ]
            );
        }
    }
}
