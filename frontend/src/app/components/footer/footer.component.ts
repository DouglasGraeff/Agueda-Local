import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-footer',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css'],
})
export class FooterComponent {
  currentYear = new Date().getFullYear();

  footerLinks = [
    {
      title: 'Explorar',
      links: [
        { label: 'Início', url: '/' },
        { label: 'Produtos', url: '/products' },
        { label: 'Produtores', url: '/producers' },
        { label: 'Sobre', url: '/about' },
      ],
    },
    {
      title: 'Ajuda',
      links: [
        { label: 'Como funciona', url: '/how-it-works' },
        { label: 'Perguntas frequentes', url: '/faq' },
        { label: 'Contactos', url: '/contact' },
      ],
    },
    {
      title: 'Legal',
      links: [
        { label: 'Termos e Condições', url: '/terms' },
        { label: 'Política de Privacidade', url: '/privacy' },
        { label: 'Cookies', url: '/cookies' },
      ],
    },
  ];
}
