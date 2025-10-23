<?php

if (!function_exists('timeAgo')) {
    function timeAgo($timestamp) {
        if (!$timestamp) return 'Jamais';
        
        $time = time() - $timestamp;
        
        if ($time < 60) {
            return 'À l\'instant';
        }
        
        $units = [
            31536000 => 'an',
            2592000 => 'mois',
            86400 => 'jour',
            3600 => 'heure',
            60 => 'minute'
        ];
        
        foreach ($units as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return 'Il y a ' . $numberOfUnits . ' ' . $text . ($numberOfUnits > 1 ? 's' : '');
        }
        
        return 'À l\'instant';
    }
}