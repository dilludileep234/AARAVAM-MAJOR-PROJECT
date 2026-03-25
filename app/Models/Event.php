<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'name',
        'category',
        'sub_category',
        'description',
        'fees',
        'activity_points',
        'time',
        'image_path'
    ];

    /**
     * Get the registration items for the event.
     */
    public function registrationItems(): HasMany
    {
        return $this->hasMany(RegistrationItem::class);
    }

    /**
     * Get the display image URL (uploaded image or AI-generated fallback).
     */
    public function getDisplayImage()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }

        $name = strtolower($this->name);
        $category = strtolower($this->category);

        // Algorithm Category Mappings
        if ($category === 'algorithm') {
            if (str_contains($name, 'robo')) return asset('images/algorithm/robo_synergy.jpg');
            if (str_contains($name, 'code')) return asset('images/algorithm/cyber_sync.jpg');
            if (str_contains($name, 'valorant')) return asset('images/algorithm/future_ui.jpg');
            if (str_contains($name, 'vr')) return asset('images/algorithm/future_ui.jpg');
            return asset('images/algorithm/about_tech.jpg');
        }

        // Sports Category Mappings
        if ($category === 'sports') {
            if (str_contains($name, 'cricket')) return asset('images/sports/cricket.png');
            if (str_contains($name, 'football')) return asset('images/sports/football.png');
            if (str_contains($name, 'athletics')) return asset('images/sports/athletics.png');
            if (str_contains($name, 'javelin')) return asset('images/sports/javelin.png');
            if (str_contains($name, 'badminton')) return asset('images/sports/badminton.png');
            if (str_contains($name, 'table tennis')) return asset('images/sports/table_tennis.png');
            if (str_contains($name, 'chess')) return asset('images/sports/chess.png');
            if (str_contains($name, 'basketball')) return asset('images/sports/basketball.png');
            return asset('images/sports/stadium.png');
        }

        // Arts Category Mappings
        if ($category === 'arts') {
            if (str_contains($name, 'natyam') || str_contains($name, 'dance')) return asset('images/arts/dance.png');
            if (str_contains($name, 'swaralaya') || str_contains($name, 'music')) return asset('images/arts/music.png');
            if (str_contains($name, 'chithram') || str_contains($name, 'painting')) return asset('images/arts/painting.png');
            if (str_contains($name, 'drama')) return asset('images/arts/hero.png');
            if (str_contains($name, 'carnival')) return asset('images/arts/carnival.png');
            if (str_contains($name, 'street')) return asset('images/arts/street_dance.png');
            if (str_contains($name, 'mural')) return asset('images/arts/mural.png');
            if (str_contains($name, 'open stage')) return asset('images/arts/open_stage.png');
            return asset('images/arts/hero.png');
        }

        // Soft Skills Category Mappings
        if ($category === 'softskill') {
            return asset('images/softskills/about_workshop.png');
        }

        // Cultural Category Mappings
        if ($category === 'cultural') {
            if (str_contains($name, 'onam')) return asset('images/arts/dance.png');
            if (str_contains($name, 'christmas')) return asset('images/arts/carnival.png');
            return asset('images/arts/mural.png');
        }

        return null;
    }
}
