import {NgModule} from '@angular/core';
import {LocationStrategy, PathLocationStrategy} from '@angular/common';
import {AppComponent} from './app.component';
import {AppRoutingModule} from './app-routing.module';
import {AppLayoutModule} from './layout/app.layout.module';
import {ProductService} from './demo/service/product.service';
import {CountryService} from './demo/service/country.service';
import {CustomerService} from './demo/service/customer.service';
import {EventService} from './demo/service/event.service';
import {IconService} from './demo/service/icon.service';
import {NodeService} from './demo/service/node.service';
import {PhotoService} from './demo/service/photo.service';
import {HttpClientModule} from '@angular/common/http';
import {PlayersComponent } from 'src/app/demo/components/pages/crud/players/players.component'
import {FormsModule } from '@angular/forms'; // Add this import


@NgModule({
    declarations: [AppComponent],
    imports: [AppRoutingModule, AppLayoutModule, PlayersComponent, HttpClientModule,FormsModule],
    providers: [
        {provide: LocationStrategy, useClass: PathLocationStrategy},
        CountryService, CustomerService, EventService, IconService, NodeService,
        PhotoService, ProductService
    ],
    bootstrap: [AppComponent],
})
export class AppModule {
}
