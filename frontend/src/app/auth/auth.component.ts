import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-auth',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.css']
})
export class AuthComponent {
  email = '';
  password = '';

  login() {
    // Placeholder: call backend /api/login
    console.log('login', this.email, this.password);
  }

  register() {
    // Placeholder: call backend /api/register
    console.log('register', this.email, this.password);
  }
}
