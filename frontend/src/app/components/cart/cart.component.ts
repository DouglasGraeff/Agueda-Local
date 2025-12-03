import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { HeaderComponent } from '../header/header.component';
import { FooterComponent } from '../footer/footer.component';

@Component({
  selector: 'app-cart',
  standalone: true,
  imports: [CommonModule, RouterModule, HeaderComponent, FooterComponent],
  templateUrl: './cart.component.html',
  styleUrl: './cart.component.css',
})
export class CartComponent {
  cartItems = [
  { name: 'Queijo da Serra', quantity: 1, price: 8.5 },
  { name: 'Mel de Águeda', quantity: 2, price: 4.2 },
  { name: 'Broa de Milho', quantity: 1, price: 2.8 }
];

get total() {
  return this.cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
}

}
