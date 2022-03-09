import { studentActionTypes, studentsLoaded, updateStudent } from './student.actions';
import { StudentService } from '../student.service';
import { createEffect, Actions, ofType } from '@ngrx/effects';
import { concatMap, map, tap } from 'rxjs/operators';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';

@Injectable()
export class StudentEffects {

  loadStudents$ = createEffect(() =>
    this.actions$.pipe(
      ofType(studentActionTypes.loadStudents),
      concatMap(() => this.studentService.getAllStudents()),
      map(students => studentActionTypes.studentsLoaded({students}))
    )
  );

  createStudent$ = createEffect(() =>
    this.actions$.pipe(
      ofType(studentActionTypes.createStudent),
      concatMap((action) => this.studentService.createStudent(action.student)),
      tap(() => this.router.navigateByUrl('/students'))
    ),
    {dispatch: false}
  );

  deleteStudent$ = createEffect(() =>
    this.actions$.pipe(
      ofType(studentActionTypes.deleteStudent),
      concatMap((action) => this.studentService.deleteStudent(action.studentId))
    ),
    {dispatch: false}
  );

  updateCOurse$ = createEffect(() =>
    this.actions$.pipe(
      ofType(studentActionTypes.updateStudent),
      concatMap((action) => this.studentService.updateStudent(action.update.id, action.update.changes))
    ),
    {dispatch: false}
  );

  constructor(private studentService: StudentService, private actions$: Actions, private router: Router) {}
}
