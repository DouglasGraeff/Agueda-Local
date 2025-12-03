import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from '../header/header.component';
import { FooterComponent } from '../footer/footer.component';

@Component({
  selector: 'app-landing',
  imports: [
    CommonModule,
    FooterComponent, 
    HeaderComponent,
  ],
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.css']
})
export class LandingComponent {
  whyChooseItems = [
    {
      icon: 'Shopping',
      title: 'Produtos Locais',
      description: 'Descubra e compre produtos autênticos de vendedores da região'
    },
    {
      icon: 'Truck',
      title: 'Apoio Local',
      description: 'Suporte rápido e eficiente para todas as suas necessidades'
    },
    {
      icon: 'Leaf',
      title: 'Sustentabilidade',
      description: 'Reduz pegada de carbono com entregas locais'
    },
    {
      icon: 'Star',
      title: 'Qualidade Garantida',
      description: 'Produtos verificados e avaliados pela comunidade'
    }
  ];

  howItWorks = [
    {
      number: 1,
      title: 'Registar',
      description: 'Crie sua conta em minutos como cliente ou vendedor'
    },
    {
      number: 2,
      title: 'Escolher',
      description: 'Navegue por categorias e encontre o que procura'
    },
    {
      number: 3,
      title: 'Receber',
      description: 'Pague com segurança e receba no conforto da sua casa'
    }
  ];

  popularCategories = [
    { name: 'Produtos', icon: '📦', color: '#10B981' },
    { name: 'Alimentos', icon: '🍎', color: '#F97316' },
    { name: 'Moda', icon: '👕', color: '#EC4899' },
    { name: 'Electrónica', icon: '💻', color: '#3B82F6' },
    { name: 'Beleza', icon: '💄', color: '#D946EF' },
    { name: 'Artesanato', icon: '🎨', color: '#F59E0B' }
  ];
}
