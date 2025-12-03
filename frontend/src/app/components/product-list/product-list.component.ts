import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { HeaderComponent } from '../header/header.component';
import { FooterComponent } from '../footer/footer.component';

@Component({
  selector: 'app-product-list',
  standalone: true,
  imports: [CommonModule, RouterModule, HeaderComponent, FooterComponent],
  templateUrl: './product-list.component.html',
  styleUrl: './product-list.component.css',
})
export class ProductListComponent {
  products = [
  { name: 'Queijo da Serra', category: 'Laticínios', price: '8,50 €', producer: 'Quinta da Serra' },
  { name: 'Mel de Águeda', category: 'Mel e derivados', price: '4,20 €', producer: 'Melaria Local' },
  { name: 'Broa de Milho', category: 'Padaria', price: '2,80 €', producer: 'Padaria Central' },
  { name: 'Vinho Tinto Regional', category: 'Bebidas', price: '6,00 €', producer: 'Adega da Vila' }
];

}
