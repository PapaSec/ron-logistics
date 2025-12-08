<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    public function __construct(
        public array $headers = [],
        public bool $striped = true,
        public bool $hover = true,
        public bool $responsive = true,
        public bool $loading = false,
        public string $emptyMessage = 'No data found',
        public string $emptyIcon = 'fas fa-inbox',
    ) {}

    public function render()
    {
        return view('components.table.table');
    }
}