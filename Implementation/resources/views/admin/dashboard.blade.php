<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Kif-Kif Admin Dashboard</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
<!-- Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Scripts -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-highest": "#dae5de",
                        "outline": "#737d78",
                        "secondary-container": "#cee9dc",
                        "on-tertiary-fixed-variant": "#2c656f",
                        "secondary-fixed-dim": "#c0dace",
                        "surface": "#f6faf6",
                        "on-error-container": "#6e0a12",
                        "error": "#a83836",
                        "primary-dim": "#195e4a",
                        "on-primary-container": "#175c49",
                        "error-container": "#fa746f",
                        "on-primary-fixed-variant": "#246652",
                        "on-surface": "#2b3530",
                        "on-secondary-fixed": "#2d443b",
                        "primary": "#286a56",
                        "surface-container-high": "#e1eae4",
                        "primary-fixed-dim": "#a0e2c9",
                        "surface-bright": "#f6faf6",
                        "on-error": "#fff7f6",
                        "on-primary": "#e5fff2",
                        "inverse-on-surface": "#999e9a",
                        "inverse-primary": "#bcffe4",
                        "on-tertiary-container": "#205b65",
                        "on-secondary-container": "#3f574d",
                        "on-surface-variant": "#57615c",
                        "on-tertiary": "#edfbff",
                        "on-tertiary-fixed": "#034852",
                        "on-primary-fixed": "#004937",
                        "background": "#f6faf6",
                        "surface-dim": "#d2ddd6",
                        "on-secondary-fixed-variant": "#496057",
                        "on-secondary": "#e5fff2",
                        "secondary": "#4c645a",
                        "outline-variant": "#aab4ae",
                        "surface-variant": "#dae5de",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-fixed": "#b7effb",
                        "secondary-dim": "#40584f",
                        "primary-fixed": "#aef0d6",
                        "on-background": "#2b3530",
                        "tertiary-container": "#b7effb",
                        "tertiary-dim": "#205a65",
                        "surface-tint": "#286a56",
                        "secondary-fixed": "#cee9dc",
                        "surface-container": "#e8f0ea",
                        "error-dim": "#67040d",
                        "surface-container-low": "#eff5f0",
                        "tertiary-fixed-dim": "#a9e0ec",
                        "inverse-surface": "#0b0f0d",
                        "primary-container": "#aef0d6",
                        "tertiary": "#2e6771"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .brand-font { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen flex overflow-x-hidden">
<!-- Sidebar Navigation -->
<aside class="hidden md:flex flex-col h-screen w-72 rounded-r-xl sticky top-0 left-0 bg-[#e8f0ea] dark:bg-emerald-950/20 py-8 px-6 font-['Plus_Jakarta_Sans'] tracking-tight text-sm">
<div class="mb-12 flex items-center gap-3 px-2">
<div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center">
<span class="material-symbols-outlined text-on-primary" data-icon="nature_people">nature_people</span>
</div>
<div>
<h1 class="text-2xl font-bold text-[#286a56] tracking-tighter">Kif-Kif</h1>
<p class="text-[10px] uppercase tracking-widest text-on-surface-variant/60 font-bold">Management Portal</p>
</div>
</div>
<nav class="flex-1 space-y-2">
<a class="flex items-center gap-4 px-4 py-3.5 bg-white dark:bg-emerald-800/40 text-[#286a56] font-bold rounded-full transition-all duration-300 shadow-sm scale-95 active:scale-90" href="{{ route('admin.dashboard') }}">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span>Dashboard</span>
</a>
<a class="flex items-center gap-4 px-4 py-3.5 text-emerald-800/60 dark:text-emerald-200/50 hover:text-[#286a56] hover:bg-white/50 dark:hover:bg-emerald-800/20 transition-all duration-200 rounded-full scale-95 active:scale-90" href="#">
<span class="material-symbols-outlined" data-icon="insights">insights</span>
<span>Analytics</span>
</a>
<a class="flex items-center gap-4 px-4 py-3.5 text-emerald-800/60 dark:text-emerald-200/50 hover:text-[#286a56] hover:bg-white/50 dark:hover:bg-emerald-800/20 transition-all duration-200 rounded-full scale-95 active:scale-90" href="#">
<span class="material-symbols-outlined" data-icon="inventory_2">inventory_2</span>
<span>Inventory</span>
</a>
<a class="flex items-center gap-4 px-4 py-3.5 text-emerald-800/60 dark:text-emerald-200/50 hover:text-[#286a56] hover:bg-white/50 dark:hover:bg-emerald-800/20 transition-all duration-200 rounded-full scale-95 active:scale-90" href="#">
<span class="material-symbols-outlined" data-icon="groups">groups</span>
<span>Team</span>
</a>
<a class="flex items-center gap-4 px-4 py-3.5 text-emerald-800/60 dark:text-emerald-200/50 hover:text-[#286a56] hover:bg-white/50 dark:hover:bg-emerald-800/20 transition-all duration-200 rounded-full scale-95 active:scale-90" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
<span>Settings</span>
</a>
</nav>
<div class="mt-auto pt-8 border-t border-primary/5">
<button class="w-full py-4 bg-primary text-on-primary rounded-full font-bold flex items-center justify-center gap-2 hover:bg-primary-dim transition-colors shadow-lg shadow-primary/20">
<span class="material-symbols-outlined text-sm" data-icon="add">add</span>
<span>New Entry</span>
</button>
<div class="mt-6 flex items-center gap-3 px-2 py-3 rounded-xl hover:bg-white/30 transition-colors cursor-pointer">
<img alt="Kif-Kif Admin Avatar" class="w-8 h-8 rounded-full bg-secondary-container" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDusd2idpUx4mT3uEzW-PzxquP1hv-IKUzjMokS5fnS95vWo6auFS9J63gBMJXrTOlR5JVzTp5809YWL3NMzHGA7fI2Lm9UK96zvl6ZgB2W5dQYJ0DXJXD-UA0If_RmNeI44B4EL1QxKaT2ewNCi-MyCLsUEFCcWHKOEa1tb_ZM4FMXCDRwHzvq8dvqIgzkOLj4YqRE0z9u-5OtlVq2ImPXXxFlIjPJpSOIsju6yW7xdkTr8M1PUxxPCqa6EKwa7cwnsTNVnKXXDQRF"/>
<div class="flex-1">
<p class="font-bold text-xs">Admin Central</p>
<p class="text-[10px] text-on-surface-variant">Admin</p>
</div>
<span class="material-symbols-outlined text-sm text-on-surface-variant" data-icon="help">help</span>
</div>
</div>
</aside>
<!-- Main Wrapper -->
<div class="flex-1 flex flex-col min-w-0">
<!-- Top Navigation -->
<header class="w-full h-20 sticky top-0 z-50 bg-[#f6faf6]/80 dark:bg-emerald-950/50 backdrop-blur-xl flex items-center justify-between px-12 transition-all font-['Plus_Jakarta_Sans'] text-base">
<div class="flex items-center gap-8 flex-1">
<div class="relative w-full max-w-md">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline" data-icon="search">search</span>
<input class="w-full pl-12 pr-4 py-2.5 bg-surface-container-low border-none rounded-full focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-highest transition-all text-sm" placeholder="Rechercher une entreprise..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<button class="w-10 h-10 flex items-center justify-center text-emerald-800/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/30 rounded-full transition-all">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<button class="w-10 h-10 flex items-center justify-center text-emerald-800/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/30 rounded-full transition-all">
<span class="material-symbols-outlined" data-icon="mail">mail</span>
</button>
<div class="h-8 w-[1px] bg-outline-variant/30 mx-2"></div>
<div class="flex items-center gap-3">
<span class="text-sm font-semibold text-[#286a56]">Admin Central</span>
<img alt="User profile photo" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAreulVdnJFVbSB80UcK2R9VgSNOWLPthYnt7X0_NlZcLbdcVFNizkQ6Ug1n52ZhezLU9c9ATfsdESWKyqPA9Ry4MfoZbxyZl6g9BwkK1SXoIzIcBTkljb7vrcxM2HCUW-At_2bTtaWoJbCNkAwKPlB6tt4RYcx4iigOaywJMtlUPVCU7FMLpzOoCoWbwY2Aj7RyW7IcRM6buOWg4CmTj8d_JlaL5OzRlv4gdobhanzBSCvLP0cm4oWgZQAxgJnfcDqUHoAAc8ldMnf"/>
</div>
</div>
</header>
<!-- Content Area -->
<main class="flex-1 p-12 space-y-12">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-primary bg-secondary-container rounded-xl border border-primary/20 animate-fade-in" role="alert">
<span class="font-bold">Succès!</span> {{ session('success') }}
                </div>
            @endif

            <!-- Hero Heading -->
<div class="space-y-2">
<h2 class="text-4xl font-extrabold tracking-tight text-on-surface">Bonjour, Admin</h2>
<p class="text-on-surface-variant font-medium">Voici le récapitulatif de l'écosystème Kif-Kif aujourd'hui.</p>
</div>
<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Card 1 -->
<div class="bg-surface-container-lowest p-8 rounded-xl flex flex-col justify-between hover:bg-white transition-colors">
<div class="flex justify-between items-start mb-4">
<div class="w-12 h-12 bg-primary-container rounded-lg flex items-center justify-center text-on-primary-container">
<span class="material-symbols-outlined" data-icon="business">business</span>
</div>
<span class="text-xs font-bold text-primary px-3 py-1 bg-primary/10 rounded-full">+12%</span>
</div>
<div>
<p class="text-on-surface-variant text-sm font-medium">Entreprises Total</p>
<p class="text-3xl font-black text-on-surface mt-1">{{ $stats['entreprises_total'] }}</p>
</div>
</div>
<!-- Card 2 -->
<div class="bg-surface-container-lowest p-8 rounded-xl flex flex-col justify-between hover:bg-white transition-colors">
<div class="flex justify-between items-start mb-4">
<div class="w-12 h-12 bg-secondary-container rounded-lg flex items-center justify-center text-on-secondary-container">
<span class="material-symbols-outlined" data-icon="pending_actions">pending_actions</span>
</div>
<span class="text-xs font-bold text-amber-600 px-3 py-1 bg-amber-50 rounded-full">Urgent</span>
</div>
<div>
<p class="text-on-surface-variant text-sm font-medium">En Attente</p>
<p class="text-3xl font-black text-on-surface mt-1">{{ $stats['entreprises_en_attente'] }}</p>
</div>
</div>
<!-- Card 3 -->
<div class="bg-surface-container-lowest p-8 rounded-xl flex flex-col justify-between hover:bg-white transition-colors">
<div class="flex justify-between items-start mb-4">
<div class="w-12 h-12 bg-tertiary-container rounded-lg flex items-center justify-center text-on-tertiary-container">
<span class="material-symbols-outlined" data-icon="verified">verified</span>
</div>
<span class="text-xs font-bold text-emerald-600 px-3 py-1 bg-emerald-50 rounded-full">Optimal</span>
</div>
<div>
<p class="text-on-surface-variant text-sm font-medium">Validées</p>
<p class="text-3xl font-black text-on-surface mt-1">{{ $stats['entreprises_validees'] }}</p>
</div>
</div>
<!-- Card 4 -->
<div class="bg-surface-container-lowest p-8 rounded-xl flex flex-col justify-between hover:bg-white transition-colors">
<div class="flex justify-between items-start mb-4">
<div class="w-12 h-12 bg-surface-container-highest rounded-lg flex items-center justify-center text-on-surface-variant">
<span class="material-symbols-outlined" data-icon="person">person</span>
</div>
</div>
<div>
<p class="text-on-surface-variant text-sm font-medium">Utilisateurs</p>
<p class="text-3xl font-black text-on-surface mt-1">{{ $stats['utilisateurs_total'] }}</p>
</div>
</div>
</div>
<!-- Elegant Data Section -->
<div class="space-y-6">
<div class="flex items-center justify-between">
<h3 class="text-2xl font-bold text-on-surface">Entreprises en attente de validation</h3>
<div class="flex gap-2">
<button class="px-6 py-2 bg-surface-container-high rounded-full text-sm font-semibold hover:bg-surface-container-highest transition-colors">Exporter CSV</button>
<form action="{{ route('admin.entreprises.valider-tout') }}" method="POST">
                            @csrf
                            <button class="px-6 py-2 bg-primary text-on-primary rounded-full text-sm font-semibold hover:bg-primary-dim transition-colors" type="submit">Tout Valider</button>
</form>
</div>
</div>
<div class="bg-surface-container-low rounded-xl overflow-hidden shadow-sm">
                    @if ($entreprises_en_attente-&gt;count() &gt; 0)
                    
                            @foreach ($entreprises_en_attente as $entreprise)
                            
                            @endforeach
                        <table class="w-full text-left">
<thead class="bg-surface-container-high/50">
<tr>
<th class="px-8 py-5 text-sm font-bold text-on-surface-variant uppercase tracking-wider">Nom</th>
<th class="px-8 py-5 text-sm font-bold text-on-surface-variant uppercase tracking-wider">ICE</th>
<th class="px-8 py-5 text-sm font-bold text-on-surface-variant uppercase tracking-wider">Secteur</th>
<th class="px-8 py-5 text-sm font-bold text-on-surface-variant uppercase tracking-wider">Ville</th>
<th class="px-8 py-5 text-sm font-bold text-on-surface-variant uppercase tracking-wider text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/10"><tr class="hover:bg-white transition-colors group">
<td class="px-8 py-6">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold text-primary uppercase">
                                            {{ substr($entreprise-&gt;nom, 0, 2) }}
                                        </div>
<div>
<p class="font-bold text-on-surface">{{ $entreprise-&gt;nom }}</p>
<p class="text-xs text-on-surface-variant">Inscrit le {{ $entreprise-&gt;created_at-&gt;format('d/m/Y') }}</p>
</div>
</div>
</td>
<td class="px-8 py-6 font-mono text-sm text-on-surface-variant">{{ $entreprise-&gt;ice }}</td>
<td class="px-8 py-6">
<span class="px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed text-xs font-bold">{{ $entreprise-&gt;secteur_activite }}</span>
</td>
<td class="px-8 py-6 text-on-surface">{{ $entreprise-&gt;ville }}</td>
<td class="px-8 py-6 text-right">
<div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
<form action="{{ route('admin.entreprises.rejeter', $entreprise-&gt;id) }}" method="POST">
                                            @csrf
                                            <button class="p-2 hover:bg-red-50 text-error rounded-lg transition-colors" title="Rejeter" type="submit">
<span class="material-symbols-outlined" data-icon="close">close</span>
</button>
</form>
<form action="{{ route('admin.entreprises.valider', $entreprise-&gt;id) }}" method="POST">
                                            @csrf
                                            <button class="p-2 hover:bg-emerald-50 text-primary rounded-lg transition-colors" title="Valider" type="submit">
<span class="material-symbols-outlined" data-icon="check">check</span>
</button>
</form>
</div>
</td>
</tr></tbody>
</table>
                    @else
                    <div class="p-12 text-center">
<p class="text-on-surface-variant">Aucune entreprise en attente de validation.</p>
</div>
                    @endif
                </div>
<div class="flex items-center justify-between pt-4">
<p class="text-sm text-on-surface-variant">Affichage de {{ $entreprises_en_attente-&gt;count() }} sur {{ $stats['entreprises_en_attente'] }} demandes en attente</p>
<div class="flex gap-2">
<!-- Pagination placeholders -->
<button class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-sm hover:bg-primary-container transition-colors">
<span class="material-symbols-outlined text-sm" data-icon="chevron_left">chevron_left</span>
</button>
<button class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-on-primary shadow-sm font-bold">1</button>
<button class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-sm hover:bg-primary-container transition-colors">2</button>
<button class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-sm hover:bg-primary-container transition-colors">
<span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Bento Layout Extra Content -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="md:col-span-2 bg-surface-container-low rounded-xl p-8 flex flex-col justify-between min-h-[300px] relative overflow-hidden group">
<div class="relative z-10 space-y-4">
<h4 class="text-xl font-bold text-on-surface">Vision du Mois</h4>
<p class="text-on-surface-variant max-w-sm">Le secteur technologique est en pleine croissance ce trimestre avec une augmentation de 24% des nouvelles inscriptions.</p>
<button class="px-8 py-3 bg-primary text-on-primary rounded-full font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-transform active:scale-95">Rapport Détaillé</button>
</div>
<div class="absolute right-0 bottom-0 w-1/2 h-full bg-gradient-to-tl from-primary-container/40 to-transparent group-hover:scale-110 transition-transform duration-700"></div>
<img class="absolute right-4 bottom-4 w-48 h-auto mix-blend-multiply opacity-40" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBsV3C7uVrrZMg6r1ksBMZlntZcidgXeH7jsPBd33JzPsbf1-tfDsD86UgaOhOj8mG1wc4MA44bBfHDkSF-bDnRXvPkTKJPsyhP8N00nw_3X70z6VByQuVV0Q21MUEtH4YJCLqp9pZeyGJo4HD7y3d7_8zso87h9_OY2qmVcGpoNGw9PNmsyj2zmmIJ9ha31t1b8pZSzRwLi70HKh5JrvYmXv_v4sClATUQOykggMGchQ5_nFXQZ4QHsQ6ztc4FboHBb3osZKG3Wm-c"/>
</div>
<div class="bg-surface-container-highest rounded-xl p-8 space-y-6">
<h4 class="text-xl font-bold text-on-surface">Activité Récente</h4>
<ul class="space-y-6">
<li class="flex gap-4">
<div class="w-2 h-2 rounded-full bg-primary mt-2"></div>
<div>
<p class="text-sm font-bold">Nouvelle entreprise</p>
<p class="text-xs text-on-surface-variant">Digital Art Lab a rejoint Kif-Kif</p>
</div>
</li>
<li class="flex gap-4">
<div class="w-2 h-2 rounded-full bg-tertiary mt-2"></div>
<div>
<p class="text-sm font-bold">Validation complétée</p>
<p class="text-xs text-on-surface-variant">Horizon Travel validé par Admin 2</p>
</div>
</li>
<li class="flex gap-4">
<div class="w-2 h-2 rounded-full bg-secondary mt-2"></div>
<div>
<p class="text-sm font-bold">Mise à jour ICE</p>
<p class="text-xs text-on-surface-variant">Casablanca Logistics a mis à jour ses infos</p>
</div>
</li>
</ul>
</div>
</div>
</main>
</div>
</body></html>