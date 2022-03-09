import { Injectable, OnDestroy } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { Router } from '@angular/router';
import { ApiService } from './api.service';

@Injectable({
  providedIn: 'root'
})
export class AuthService implements OnDestroy {

  private _authSub$: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);
  public get isAuthenticated$(): Observable<boolean> {
    return this._authSub$.asObservable();
  }

  constructor(private _router: Router, private _authClient: ApiService) { }

  public ngOnDestroy(): void {
    this._authSub$.next(false);
    this._authSub$.complete();
  }

  public login(username: string, password: string) {
    return this._authClient.login({username, password})
        .subscribe(res => {
          this._authSub$.next(true);
          this._router.navigateByUrl('/');
          localStorage.setItem('token', res.access_token);
          localStorage.setItem('userType', res.user.user_type);
          localStorage.setItem('user', res.user);
      }, err => {
          console.log(err);
      })
  }

  public logout() {
    return this._authClient.logout()
        .subscribe(res => {
          this._authSub$.next(false);
          this._router.navigateByUrl('/login');
          localStorage.clear();
      }, err => {
          console.log(err);
      })
  }
}
