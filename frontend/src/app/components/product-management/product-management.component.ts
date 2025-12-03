import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { HeaderComponent } from '../header/header.component';
import { FooterComponent } from '../footer/footer.component';

@Component({
  selector: 'app-product-management',
  standalone: true,
  imports: [CommonModule, RouterModule, HeaderComponent, FooterComponent],
  templateUrl: './product-management.component.html',
  styleUrl: './product-management.component.css',
})
export class ProductManagementComponent {
  products = [
  { name: 'Queijo da Serra', status: 'Ativo', stock: 12 },
  { name: 'Mel de Águeda', status: 'Ativo', stock: 34 },
  { name: 'Broa de Milho', status: 'Rascunho', stock: 0 }
];

}
