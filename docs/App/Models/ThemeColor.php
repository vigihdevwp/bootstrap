<?php

declare(strict_types=1);

namespace App\Models;

final class ThemeColor
{

    const PRIMARY = 'primary';
    const SECONDARY = 'secondary';
    const SUCCESS = 'success';
    const DANGER = 'danger';
    const WARNING = 'warning';
    const INFO = 'info';
    const DARK = 'dark';

    public function __construct() {}

    public function list(): array
    {
        return [
            self::PRIMARY,
            self::SECONDARY,
            self::SUCCESS,
            self::DANGER,
            self::WARNING,
            self::INFO,
            self::DARK,
        ];
    }

    public function withIcon(): array
    {
        return [
            self::PRIMARY => 'done_all',
            self::SECONDARY => 'info',
            self::SUCCESS => 'done',
            self::DANGER => 'error',
            self::WARNING => 'warning',
            self::INFO => 'info',
            self::DARK => 'info',
        ];
    }
    public function getIcon(int $index): string
    {

        $icons = [
            'add',
            'person_add',
            'add_ic_call',
            'how_to_reg',
            'person_add_alt_1',
            'badge',
            'celebration',
            'cake',
            'emoji_people',
            'school',
            'sports_esports',
            'music_note',
            'restaurant',
            'flight_takeoff',
            'group_add',
            'group',
            'diversity_3',
            'people_outline',
            'groups',
            'supervisor_account',
            'social_distance',
            'handshake',
            'forum',
            'chat',
        ];
        return isset($icons[$index]) ? $icons[$index] : 'group_add';
    }

    public function getAvatar(int $index): string
    {

        $avatar = [
            'https://randomuser.me/api/portraits/women/1.jpg',
            'https://randomuser.me/api/portraits/men/2.jpg',
            'https://randomuser.me/api/portraits/women/3.jpg',
            'https://randomuser.me/api/portraits/men/4.jpg',
            'https://randomuser.me/api/portraits/women/5.jpg',
            'https://randomuser.me/api/portraits/men/6.jpg',
            'https://randomuser.me/api/portraits/women/7.jpg',
            'https://randomuser.me/api/portraits/men/8.jpg',
            'https://randomuser.me/api/portraits/women/9.jpg',
            'https://randomuser.me/api/portraits/men/10.jpg',
        ];
        return isset($avatar[$index]) ? $avatar[$index] : 'https://randomuser.me/api/portraits/women/1.jpg';
    }
    private function getLabel(string $name) {}
}
