@php
    $class = '';
    $weight = $level->weight;
    switch ($level->weight) {
        case '0':
            $weight = '2';
        case '20':
            $class = 'bg-danger';
            break;
        case '35':
            $class = 'bg-warning';
            break;
        case '50':
        case '65':
            $class = 'bg-info';
            break;
        case '80':
        case '100':
            $class = 'bg-success';
            break;
    }
@endphp
<div class="progress">
    <div class="progress-bar {{ $class }}" role="progressbar" 
style="width: {{ $weight }}%" aria-valuenow="{{ $weight }}" aria-valuemin="0"
aria-valuemax="100"></div>
</div>