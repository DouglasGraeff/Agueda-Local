import { Component } from '@angular/core';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css']
})
export class FooterComponent {
  footerLinks = [
    {
      title: 'Águeda Local',
      links: ['Sobre Nós', 'Política de Privacidade', 'Termos de Serviço']
    },
    {
      title: 'Links Rápidos',
      links: ['Para Clientes', 'Para Vendedores', 'Para Empresas']
    },
    {
      title: 'Suporte',
      links: ['FAQ', 'Contacte-nos', 'Rastrear Encomenda']
    },
    {
      title: 'Contacto',
      links: ['Email: info@aguedaLocal.pt', 'Tel: +351 234 123 456', 'Morada: Águeda, Portugal']
    }
  ];

  socialLinks = [
    { name: 'Facebook', icon: 'f', url: '#' },
    { name: 'Instagram', icon: '📷', url: '#' },
    { name: 'LinkedIn', icon: 'in', url: '#' }
  ];

  currentYear = new Date().getFullYear();
}
