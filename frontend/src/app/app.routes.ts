import { Routes } from '@angular/router';

export const routes: Routes = [
	{ path: 'auth', loadComponent: () => import('./auth/auth.component').then(m => m.AuthComponent) },
	{ path: '', loadComponent: () => import('./components/landing/landing.component').then(m => m.LandingComponent) }
];
