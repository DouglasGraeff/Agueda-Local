import { Component, signal, inject  } from '@angular/core';
import { Router, RouterOutlet } from '@angular/router';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, RouterOutlet, HeaderComponent, FooterComponent],
  //templateUrl: './app.html',
  styleUrls: ['./app.css'],
    template: `
    <ng-container *ngIf="!isAuthPage()">
      <app-header></app-header>
    </ng-container>

    <router-outlet></router-outlet>

    <ng-container *ngIf="!isAuthPage()">
      <app-footer></app-footer>
    </ng-container>
  `,
})
export class App {
  protected readonly title = signal('frontend');

  private router = inject(Router);

  isAuthPage(): boolean {
    const url = this.router.url;
    return url.startsWith('/login') || url.startsWith('/register');
  }
}
