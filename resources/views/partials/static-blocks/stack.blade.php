<h3 class="w-full my-4 font-semibold text-sm uppercase tracking-widest">Stack</h3>

<p class="mb-4">Running on PHP v{{ $php_version }}</p>

<ul class="list-disc ml-8 mb-4">
<?php
    $techs = [
        [
            'name' => '<strong>V</strong>ue v3.x',
            'url' => 'https://vuejs.org/',
            'role' => 'Client-side framework',
        ],
        [
            'name' => '<strong>I</strong>nertia v1.x',
            'url' => 'https://inertiajs.com/',
            'role' => 'Build tool',
        ],
        [
            'name' => $laravel_version ? '<strong>L</strong>aravel v' . $laravel_version : '<strong>L</strong>aravel',
            'url' => 'https://laravel.com/',
            'role' => 'Server-side framework',
        ],
        [
            'name' => '<strong>T</strong>ailwind v3.x',
            'url' => 'https://tailwindcss.com/docs',
            'role' => 'CSS framework',
        ],
    ];
?>
    @foreach($techs as $tech)
    <li>
        <a href="{{ $tech['url'] }}" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100">
            <span style="display: inline-block;" class="font-mono w-48">{!! $tech['name'] !!}</span>
        </a>

        <em>{{ $tech['role'] }}</em>
    </li>
    @endforeach
</ul>
