import { areStudentsLoaded } from './../store/student.selectors';
import { loadStudents, studentsLoaded } from './../store/student.actions';
import { State } from './../../store/reducers/index';
import { Student } from '../student.model';
import { Injectable } from '@angular/core';
import {ActivatedRouteSnapshot, Resolve, RouterStateSnapshot} from '@angular/router';
import { Observable } from 'rxjs';
import {select, Store} from '@ngrx/store';
import {filter, finalize, first, tap} from 'rxjs/operators';

@Injectable()
export class StudentResolver implements Resolve<Observable<any>> {

  constructor(private store: Store<State>) {}

  resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<any> {
    return this.store
    .pipe(
        select(areStudentsLoaded),
        tap((studentsLoaded) => {
          if (!studentsLoaded) {
            this.store.dispatch(loadStudents());
          }

        }),
        filter(studentsLoaded => studentsLoaded),
        first()
    );
  }
}
