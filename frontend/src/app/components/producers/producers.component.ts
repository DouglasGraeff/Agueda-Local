import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-producers',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './producers.component.html',
  styleUrls: ['./producers.component.css'],
})
export class ProducersComponent {}
