import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AppLayoutComponent } from "./layout/app.layout.component";
import { PlayersComponent } from "./demo/components/pages/crud/players/players.component";

const routes: Routes = [
    {
        path: '', component: AppLayoutComponent,
        children: [
            {path: '', loadChildren: () => import('./demo/components/dashboard/dashboard.module').then(m => m.DashboardModule)},
            {path: 'uikit', loadChildren: () => import('./demo/components/uikit/uikit.module').then(m => m.UIkitModule)},
            {path: 'utilities', loadChildren: () => import('./demo/components/utilities/utilities.module').then(m => m.UtilitiesModule)},
            {path: 'documentation', loadChildren: () => import('./demo/components/documentation/documentation.module').then(m => m.DocumentationModule)},
            {path: 'blocks', loadChildren: () => import('./demo/components/primeblocks/primeblocks.module').then(m => m.PrimeBlocksModule)},
            {path: 'pages', loadChildren: () => import('./demo/components/pages/pages.module').then(m => m.PagesModule)},
            {path: 'players/:id', component: PlayersComponent },
            {path: 'players', component: PlayersComponent, title: 'Players List' }
        ]
    },
    {path: 'auth', loadChildren: () => import('./demo/components/auth/auth.module').then(m => m.AuthModule)},
    {path: 'landing', loadChildren: () => import('./demo/components/landing/landing.module').then(m => m.LandingModule)},
    {path: '**', redirectTo: '/' }
];

@NgModule({
    imports: [RouterModule.forRoot(routes, {
        scrollPositionRestoration: 'enabled',
        anchorScrolling: 'enabled',
        onSameUrlNavigation: 'reload'
    })],
    exports: [RouterModule]
})
export class AppRoutingModule { }
