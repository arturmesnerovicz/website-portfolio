<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;
use Filament\Pages\SubNavigationPosition;

class Studio3D extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Estúdio 3D';

    protected static ?string $clusterBreadcrumb = 'Estúdio 3D';

    protected static ?string $slug = 'estudio-3d';

    protected static ?int $navigationSort = 3;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Start;
}
