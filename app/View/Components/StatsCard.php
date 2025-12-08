<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatsCard extends Component
{
    public $title;
    public $value;
    public $icon;
    public $color;
    public $showTrend;
    public $trend;
    public $trendText;
    public $iconBg;
    public $iconColor;
    
    /**
     * Create a new component instance.
     */
    public function __construct(
        $title,
        $value,
        $icon,
        $color = 'blue',
        $showTrend = false,
        $trend = '+12%',
        $trendText = 'from last month',
        $iconBg = null,
        $iconColor = null
    ) {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->color = $color;
        $this->showTrend = $showTrend;
        $this->trend = $trend;
        $this->trendText = $trendText;
        
        // Set default icon colors based on main color if not provided
        $this->iconBg = $iconBg ?? $color . '-100 dark:' . $color . '-950/50';
        $this->iconColor = $iconColor ?? $color . '-600 dark:' . $color . '-400';
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stats-card');
    }
}