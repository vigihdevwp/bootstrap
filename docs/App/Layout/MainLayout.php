<?php

declare(strict_types=1);

namespace App\Layout;

final class MainLayout
{
    private static string $content = '';
    private static string $js = '';
    private static array $data = [];
    private static string $title = '';

    private function __construct() {}

    public static function begin(string $title = 'Hello World', array $data = []): void
    {
        self::$data = $data;
        self::$title = $title;

        ob_start();
    }

    public static function registerJs(): void
    {
        self::$content = ob_get_clean();
        ob_start();
    }

    public static function end(): void
    {
        // self::$content = ob_get_clean();

        if (ob_get_level() > 0) {
            if (empty(self::$content)) {
                self::$content = ob_get_clean();
            } else {
                self::$js = ob_get_clean();
            }
        }

        extract(self::$data);
        $title = self::$title;
        $content = self::$content;
        $js = self::$js;

        require LAYOUT_PATH . '/main.php';
    }
}
