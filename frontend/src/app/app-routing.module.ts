import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { AuthGuard } from './auth.guard';
import { StudentsComponent } from './student/component/students.component';
import { StudentResolver } from './student/store/student.resolver';
import { StudentModule } from './student/student.module';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { EffectsModule } from '@ngrx/effects';
import { StoreModule } from '@ngrx/store';
import { reducers, metaReducers } from './store/reducers';
import { StoreDevtoolsModule } from '@ngrx/store-devtools';

const routes: Routes = [
  {
    path: 'login',
    component: LoginComponent
  },
  {
    path: '',
    component: HomeComponent,
    canActivate: [ AuthGuard ]
  },
  {
    path: 'students',
    component: StudentsComponent,
    resolve: {
      courses: StudentResolver
    },
    canActivate: [ AuthGuard ]
  }
];

@NgModule({
  imports: [
    BrowserModule,
    HttpClientModule,
    EffectsModule.forRoot([]),
    StoreModule.forRoot(reducers, {
      metaReducers
    }),
    StoreDevtoolsModule,
    RouterModule.forRoot(routes),
    StudentModule,
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
