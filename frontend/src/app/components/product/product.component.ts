import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { HeaderComponent } from '../header/header.component';
import { FooterComponent } from '../footer/footer.component';

@Component({
  selector: 'app-product',
  standalone: true,
  imports: [CommonModule, RouterModule, HeaderComponent, FooterComponent],
  templateUrl: './product.component.html',
  styleUrl: './product.component.css',
})
export class ProductComponent {
  product = {
  name: 'Queijo da Serra',
  category: 'Laticínios',
  price: '8,50 €',
  producer: 'Quinta da Serra',
  description: 'Queijo tradicional da Serra da Estrela, produzido de forma artesanal com leite de ovelha.'
};

}
